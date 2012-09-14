<?php
class ModuleBlockVideo extends \cms\Module
{
	
	const TITLE			= 'Video';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= false;
	const UPLOAD_DIR	= 'uploads/blockVideo/';
	
	protected $path			= 'blockVideo/';
	
	public function __construct()
	{
		parent::__construct();
		$this->addAsset('js', JS_DIR.'jquery.fitvids.js', 'file');
	}
	
	// coté admin
	/*
	 * $id		= id du module
	 * $datas	= données en DB
	 * $values	= $_POST ou $_GET
	*/
	public function set($id, $oModule, $culture, $values=array())
	{
		$oModule = \classes\model\ModuleItem::get($id);
		$data		= json_decode($oModule->datas);
		$content	= is_object($data)? $data->content:'';
		
		
		$return = array();
		$return[$id] = array();
		if($values && $values['id']==$id && count($values)>0)
		{
			$datas = array();
			
			$values['content'][$id]['embed']		= isset($values['content'][$id]['embed'])? $values['content'][$id]['embed']:'';
			$values['content'][$id]['responsive']	= isset($values['content'][$id]['responsive'])? $values['content'][$id]['responsive']:0;
			$values['content'][$id]['center']		= isset($values['content'][$id]['center'])? $values['content'][$id]['center']:0;
			$datas['content']	= $values['content'][$id];
			
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
		$element = is_object($data)? $data->content:'';
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}