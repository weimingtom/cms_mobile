<?php
namespace cms;
class Template extends Item
{
	
	protected $path		= 'path/';
	private $template	= 'temp.html.php';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	//asset('css', 'lien vers le fichier', 'file')
	//$mode = 'file', 'custom', 'code', 'external'
	public function addAsset($type, $value=null, $mode='code')
	{
		if(in_array($mode, array('file', 'custom')))
			$value = BASE_DIR.TEMPLATE_DIR.$this->path.$value;
		
		parent::addAsset($type, $value, $mode);
	}
	
	public function toString($datas)
	{
		extract($datas);
		require(ROOTPATH.TEMPLATE_DIR.$this->path.$this->template);
	}
	
	// Parcours le dossier pour voir si un élément n'est pas installé
	public static function getNotInstalled()
	{
		$return = array();
	
		$dir = opendir(ROOTPATH.TEMPLATE_DIR);
		while($f = readdir($dir))
		{
			if( in_array($f, array(".", "..")) )
				continue;
	
			// Test si le module est en base
			if( !\classes\model\Template::isInstalled($f) )
			$return[] = $f;
		}
		closedir($dir);
	
		return $return;
	}
	
	public static function install($template)
	{
		include_once(__DIR__.\cms\Moteur::TEMPLATE_DIR.$template.'/temp.class.php');
		$class = 'Template'.$template;
		
		// Insert dans la base
		\classes\model\Template::insert(array(
			'title'		=> $class::TITLE,
			'folder'	=> $template,
			'status'	=> \classes\model\Template::STATUS_ONLINE
		));
		return array('valid' => 'Le template '.$template.' a été installé');
	}
	
	public function formatCustomStyle($oConfigurationTranslate)
	{
		return array(
			'font_family'	=> $oConfigurationTranslate->font_family,
			'font_size'		=> $oConfigurationTranslate->font_size,
			'font_color'	=> $oConfigurationTranslate->font_color,
			'h1_size'		=> $oConfigurationTranslate->h1_size,
			'h2_size'		=> $oConfigurationTranslate->h2_size,
			'h3_size'		=> $oConfigurationTranslate->h3_size,
			'h4_size'		=> $oConfigurationTranslate->h4_size,
			'h5_size'		=> $oConfigurationTranslate->h5_size,
			'background'	=> $oConfigurationTranslate->background,
			'color1'		=> array(
				'100'	=> $oConfigurationTranslate->color1,
				'80'	=> self::get_color($oConfigurationTranslate->color1, 80),
				'60'	=> self::get_color($oConfigurationTranslate->color1, 60),
				'50'	=> self::get_color($oConfigurationTranslate->color1, 50),
				'30'	=> self::get_color($oConfigurationTranslate->color1, 30)
			),
			'color2'		=> array(
				'100'	=> $oConfigurationTranslate->color2,
				'80'	=> self::get_color($oConfigurationTranslate->color2, 80),
				'60'	=> self::get_color($oConfigurationTranslate->color2, 60),
				'50'	=> self::get_color($oConfigurationTranslate->color2, 50),
				'30'	=> self::get_color($oConfigurationTranslate->color2, 30)
			)
		);
	}
	
	public static function get_color($source, $opacity, $back = "#FFFFFF")
	{
		// Gestion du #
		if(substr($source, 0, 1)=="#")	$source	= substr($source, 1, 6);
		if(substr($back, 0, 1)=="#")	$back	= substr($back, 1, 6);
	
		$tablo[0] = hexdec(substr($source, 0, 2));
		$tablo[1] = hexdec(substr($source, 2, 2));
		$tablo[2] = hexdec(substr($source, 4, 2));
	
		$tablo[0] = $tablo[0] + (((100-$opacity)/100)*(255-$tablo[0]));
		$tablo[1] = $tablo[1] + (((100-$opacity)/100)*(255-$tablo[1]));
		$tablo[2] = $tablo[2] + (((100-$opacity)/100)*(255-$tablo[2]));
	
		return /*'#'.*/str_pad(dechex( ($tablo[0]<<16)|($tablo[1]<<8)|$tablo[2] ), 6, '0', STR_PAD_LEFT);
	}
	
}