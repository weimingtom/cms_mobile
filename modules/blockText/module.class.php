<?php
class ModuleBlockText extends \cms\Module
{
	
	const TITLE			= 'Block Texte 2';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= false;
		
	protected $path			= 'blockText/';
	private $modeleClass	= 'ModuleItem';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->addAsset('css', CSS_DIR.'style.css', 'file');
	}
	
	// coté admin
	/*
	 * $id		= id du module
	 * $datas	= données en DB
	 * $values	= $_POST ou $_GET
	*/
	public function set($id, $oModule, $culture, $values=array())
	{
		$return = array();
		
		$return[$id] = array();
		if($values && $values['id']==$id && count($values)>0 && $values['action']=='module')
		{
			$datas = array();
			$datas['content'] = $values['content'][$id];
			
			// traitement du formulaire
			\classes\model\ModuleItem::set($id, $datas);
			$return[$id]['valid'] = VALID_TEXT;
			
			$oModule = \classes\model\ModuleItem::get($id);
		}
		
		$data		= json_decode($oModule->datas);
		$id			= $oModule->id;
		$content	= is_object($data)? $data->content:'';
				
		ob_start();
		require('admin.html.php');
		return ob_get_clean();
	}
	
	// coté front
	public function get($oModule, $culture)
	{
		$data = json_decode($oModule->datas);
		$content = is_object($data)? $data->content:'';
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}