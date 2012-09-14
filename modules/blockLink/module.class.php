<?php
class ModuleBlockLink extends \cms\Module
{
	
	const TITLE			= 'Lien';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= false;
	
	protected $path			= 'blockLink/';
	
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
		$oModule = \classes\model\ModuleItem::get($id);
		$data		= json_decode($oModule->datas);
		$content	= is_object($data)? $data->content:'';
		
		$return = array();
		$return[$id] = array();
		if($values && $values['id']==$id && count($values)>0)
		{
			$datas = array();
						
			// Gestion des url
			$values['content'][$id]['external_url']				= isset($values['content'][$id]['external_url'])? $values['content'][$id]['external_url']:0;
			$values['content'][$id]['url']			= ($values['content'][$id]['external_url']==1)? $values['content'][$id]['url_externe']:'';
			$values['content'][$id]['id_page_dest']	= ($values['content'][$id]['external_url']==0)? $values['content'][$id]['url_interne']:'';
			
			$values['content'][$id]['button']	= isset($values['content'][$id]['button'])? $values['content'][$id]['button']:0;
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
		$url		= $element->external_url==1? $element->url:\classes\model\Page::getPageUrl($element->id_page_dest, $culture);
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}