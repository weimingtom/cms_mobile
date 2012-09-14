<?php
namespace helpers;

class Helper {

    public static function checkEmail($email){
		// checks proper syntax
		$regexp = '/^[A-z0-9_\-]+(\.[A-z0-9_\-]+)*@[A-z0-9_\-]+(\.[A-z0-9_\-]+)*\.[A-z]{2,6}$/';
		if( !preg_match("$regexp", $email))
			return false;
		
		return true;
	}
	
	public static function getPagination($href, $nbPage, $current) {
		if($nbPage==0 OR $nbPage==1)
			return '';
		
		$res = '<div id="pagination">';
			if($current != 1)
				$res .= '<a href="'.$href.($current-1).'"> < </a>';
			/*else
				$res .= '<a class="disabled"> < </a>';*/
				
			$testAff = 0;
			for($i=1; $i<=$nbPage; $i++) {
				if( ($i%5==0 and $current-$i<5 and $current-$i>=0) or ($current<5 and $i==1) )
					$testAff = 1;
				
				if($i%10==0 or ($testAff>0 and $testAff<=5) or ($testAff>0 and $testAff==6 and $i%5==0)) {
					if($i==$current)
						$res .= '<a class="disabled" id="current">'.$i.'</a>';
					else
						$res .= '<a href="'.$href.$i.'">'.$i.'</a>';
				}
				
				if($testAff>0 and $testAff<=6)
					$testAff++;
			}
			
			if($nbPage != $current)
				$res .= '<a href="'.$href.($current+1).'"> > </a>';
			/*else
				$res .= '<a class="disabled"> > </a>';*/
		$res .= '</div>';
		
		return $res;
	}
	
	public static function getMilitedText($text, $limit) {
		return (substr($text, 0, $limit)).((strlen($text)>$limit)? ' ...':'');
	}
	
	// Retourne une chaine sans les caratères html
 	public static function getFiltredText($string) {
		return preg_replace( '/<[^>]*>/', '', $string);
	}
	
	public static function printReturn($return=null)
	{
		$print = '';
		if(isset($return))
		{
			if(isset($return['error']) && count($return['error'])>0)
			{
				$print .= '<div class="error_box">';
					foreach($return['error'] as $error)
						$print .= $error.'<br/>';
				$print .= '</div>';
			}
			elseif(isset($return['valid']) && $return['valid'] != '')
			{
				$print .= '<div class="valid_box">'.$return['valid'].'</div>';
			}
			if(isset($return['warning']) && $return['warning'] != '')
			{
				$print .= '<div class="warning_box">'.$return['warning'].'</div>';
			}
		}
		return $print;
	}
	
	// Retourne une infobulle
	public static function formatInfo($string) {
		return '<a href="javascript:void(0);" class="infobulle">
					<span>'.$string.'</span>
			    </a>'; 
	}
	
	public static function my_basename($filename) {
		return preg_replace( '/^.+[\\\\\\/]/', '', $filename );
	}
	
	public static function nettoyer_chaine($chaine) {
		$chaine = preg_replace('`\s+`', '_', trim($chaine));
		$chaine = str_replace("'", "_", $chaine);
		$chaine = preg_replace('`_+`', '_', trim($chaine));
		//$chaineNonValide = str_replace("©", "", $chaineNonValide);
		$normalizeChars = array(
			'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
			'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
			'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
			'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
			'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
			'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
			'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f'
		);
		$chaine = strtr($chaine, $normalizeChars);
		return $chaine;
	}
    
}