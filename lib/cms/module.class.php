<?php
namespace cms;
class Module extends Item
{
	
	protected $path		= 'path/';
	private $template	= 'module.html.php';
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function model()
	{
		/*
		include(MODEL_DIR.'model.class.php');
		return true;
		/**/
		return false;
	}
	
	//asset('css', 'lien vers le fichier', 'file')
	//$mode = 'file', 'code', 'external'
	public function addAsset($type, $value=null, $mode='code')
	{
		if($mode=='file')
			$value = BASE_DIR.MODULE_DIR.$this->path.$value;
	
		parent::addAsset($type, $value, $mode);
	}
	
	// coté admin
	public function set($id, $oModule, $culture, $values=array()) {}
	
	// coté front
	public function get($oModule, $culture)
	{
		$data = $oModule->datas;
		
		/*
		if($this->model)
			$oModuleItem = $this->
		/**/
		
		//require('.html.php');
		require(ROOTPATH.MODULE_DIR.$this->path.$this->template);
	}
	
	// Parcours le dossier pour voir si un élément n'est pas installé
	public static function getNotInstalled()
	{
		$return = array();
		
		$dir = opendir(ROOTPATH.MODULE_DIR);
		while($f = readdir($dir))
		{
			if( in_array($f, array(".", "..")) )
				continue;
						
			// Test si le module est en base
			if( !\classes\model\Module::isInstalled($f) )
				$return[] = $f;
		}
		closedir($dir);
		
		return $return;
	}
	
	public static function install($module)
	{
		include_once(__DIR__.\cms\Moteur::MODULE_DIR.$module.'/module.class.php');
		$class = 'Module'.$module;
		
		// Insert dans la base
		\classes\model\Module::insert(array(
			'title'		=> $class::TITLE, 
			'folder'	=> $module, 
			'manager'	=> $class::MANAGER, 
			'status'	=> \classes\model\Module::STATUS_ONLINE
		));
		
		if($class::MODEL)
			new \helpers\ImportSqlFile(__DIR__.\cms\Moteur::MODULE_DIR.$module.'/model/script.sql');
				
		return array('valid' => 'Le module '.$module.' a été installé');
	}
	
}