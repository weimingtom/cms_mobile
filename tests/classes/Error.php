<?php
class Error  {
	// editable var
	static $noLog = false;
	static $flushOnHalt = true;
	
	// internal var "do not touch"
	static $startTime = NULL;
	static $messageLog = array();
	static $firstFlush = true;
	
	static function Init()
	{
		self::$startTime = microtime(true);
	}
	
	static function addMessage($type,$message)
	{
		// on peux désactiver le système de log une fois en production
		if(self::$noLog)
			return false;
			
		$debug = debug_backtrace();
		if(isset($debug[2]))
		{
			if($debug['2']['class']!='')
				$d['call'] = $debug[2]['class'].'::'.$debug[2]['function'].'()';
			else if($debug['2']['function']!='')
				$d['call'] = $debug[2]['function'].'()';
			else
				$d['call'] = '';
		}
		$d['file'] = $debug[1]['file'];
		$d['line'] = $debug[1]['line'];

		self::$messageLog[] = array('type'=>$type,'µt'=>microtime(true),'msg'=>$message,'debug'=>$d);
	}
	static function Warning($message)
	{
		self::addMessage('WARN',$message);
	}
	static function Trace($message)
	{
		self::addMessage('TRACE',$message);
	}
	static function Info($message)
	{
		self::addMessage('INFO',$message);
	}
	static function Halt($message=NULL)
	{
		if($message!==NULL)
			self::addMessage('HALT',$message);
		if(self::$flushOnHalt)
			self::Flush();
		die();
	}
	static function Flush($type=NULL)
	{
		$uid = md5(microtime());
		
		$ut = 1000*round(microtime(true)-self::$startTime,6);
		$ut = explode('.',''.$ut);
		$ut[0] = str_pad($ut[0],4,' ',STR_PAD_LEFT);
		$ut[1] = str_pad($ut[1],3,'0',STR_PAD_RIGHT);
		
		if(self::$firstFlush)
		{
			?>
			<style type="text/css">
			#Error_Flush_Container { border:1px solid #666; }
			#Error_Flush_Container h2 { margin:0; padding:3px; font-family:Georgia, "Times New Roman", Times, serif; font-size:14px; background:#ddd; }
			#Error_Flush_Container dl { margin:0; padding:0 3px; }
			#Error_Flush_Container dt { margin:0; padding:3px 0 ; border-top:1px dotted #aaa; white-space:pre; color:#999; font-family:"Lucida Console", Monaco, monospace; font-size:9px; }
			#Error_Flush_Container dt.first { border:none; }
			#Error_Flush_Container dd { margin:0 0 3px; padding:0; white-space:pre; font-family:Arial, Helvetica, sans-serif; }
			#Error_Flush_Container dd.call { color:#999; font-size:10px; }
			#Error_Flush_Container dd.message { color:#000; font-size:10px; }
			#Error_Flush_Container .Error_Type_INFO strong { color:#9C0; }
			#Error_Flush_Container .Error_Type_TRACE strong { color:#09C; }
			#Error_Flush_Container .Error_Type_WARN strong { color:#F90; }
			#Error_Flush_Container .Error_Type_HALT strong { color:#C00; }
			</style>
			<?php
		}
		self::$firstFlush = false;
		?>
		<div id="Error_Flush_Container" rel="<?=$uid;?>">
			<h2>CMS Debug Log - <strong>Execution Time : <?=implode('.',$ut).' ms  ';?></strong></h2>
			<dl id="log-<?=$uid;?>">
				<?php
				if(!self::$noLog)
				{
					$i=0;
					foreach(self::$messageLog as $msg)
					{
						$ut = 1000*round($msg['µt']-self::$startTime,6);
						$ut = explode('.',''.$ut);
						$ut[0] = str_pad($ut[0],4,' ',STR_PAD_LEFT);
						$ut[1] = str_pad($ut[1],3,'0',STR_PAD_RIGHT);
						
						echo '<dt class="Error_Type_'.$msg['type'].' '.($i==0 ? 'first':'').'"><strong>'.str_pad($msg['type'],5,' ',STR_PAD_RIGHT).'</strong> : '.implode('.',$ut).' ms  '.$msg['debug']['file'].' Line '.$msg['debug']['line'].'</dt>';
						if(!empty($msg['debug']['call']))
							echo '<dd class="call">'.$msg['debug']['call'].'</dd>';
						echo '<dd class="message">'.$msg['msg'].'</dd>';
						$i++;
					}
				}
				?>
			</dl>
		</div>
		<?php
		self::$messageLog = array();
	}
	function FlushJS($type=NULL)
	{
		$uid = md5(microtime());
		
		$ut = 1000*round(microtime(true)-self::$startTime,6);
		$ut = explode('.',''.$ut);
		$ut[0] = str_pad($ut[0],4,' ',STR_PAD_LEFT);
		$ut[1] = str_pad($ut[1],3,'0',STR_PAD_RIGHT);
		?>
		<script type="text/javascript">
		$(function(){
			if(console && console.log)
			{
				console.log("CMS Debug Log","Execution Time : <?=implode('.',$ut).' ms  ';?>");
				<?php
				if(!self::$noLog)
				{
					$i=0;
					foreach(self::$messageLog as $msg)
					{
						$ut = 1000*round($msg['µt']-self::$startTime,6);
						$ut = explode('.',''.$ut);
						$ut[0] = str_pad($ut[0],4,' ',STR_PAD_LEFT);
						$ut[1] = str_pad($ut[1],3,'0',STR_PAD_RIGHT);
						echo 'console.log("'.$msg['type'].'","'.implode('.',$ut).' ms  '.$msg['debug']['file'].' Line'.$msg['debug']['line'].'\n'.implode('\n',explode("\n",addslashes($msg['msg']))).'");'."\n";
						$i++;
					}
				}
				?>
			}
		});
		</script>
		<?php
		self::$messageLog = array();
	}
}
?>