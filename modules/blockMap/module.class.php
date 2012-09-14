<?php
class ModuleBlockMap extends \cms\Module
{
	
	const TITLE			= 'Block Map';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= true;
		
	protected $path		= 'blockMap/';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->addAsset('css', CSS_DIR.'style.css', 'file');
		$this->addAsset('js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js', 'external');
		$this->addAsset('js', 'http://maps.google.com/maps/api/js?sensor=true', 'external');
		$this->addAsset('js', JS_DIR.'jquery.ui.map.js', 'file');
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
		
		$pageLink = 'edit_page_lang.php?id='.$_GET['id'].'&culture='.$_GET['culture'];
		
		include_once('model/module_blockmap_element.class.php');
		$elements	= Module_blockmap_element::getByModule($id);
				
		// Delete élément
		if(isset($_GET['delete']) && $_GET['delete']=='block_map' && $_GET['element'])
			Module_blockmap_element::del($_GET['element']);
		
		// traitement du formulaire
		if($values && $values['fk_module_item']==$id && count($values)>0)
		{
			if(!$elements)
			{
				include_once('model/module_blockmap.class.php');
				Module_blockmap::set(0, array('fk_module_item' => $id));
				
				$elements	= Module_blockmap_element::getModule($id);
			}
			
			$values = array_merge($values, array(
				'fk_module_blockmap'	=> $elements[0]->fk_module_blockmap, 
				'order'					=> 0
			));
			Module_blockmap_element::set(isset($_GET['element'])? $_GET['element']:0, $values, $_FILES['img']);
			
			$return[$id]['valid'] = VALID_TEXT;
		}
				
		// Récupère l'élément a éditer
		if(isset($_GET['edit']) && $_GET['edit']=='block_map' && $_GET['element'])
			$elementToEdit	= Module_blockmap_element::get($_GET['element']);
		
		// Delete image
		if(isset($_GET['delete']) && $_GET['delete']=='img' && isset($_GET['module_name']) && $_GET['module_name']=='block_map')
			Module_blockmap_element::delFile($_GET['element'], $_GET['delete']);
		
		// Récupère le contenu
		$elements	= Module_blockmap_element::getByModule($id);
		
		ob_start();
		require('admin.html.php');
		return ob_get_clean();
	}
	
	// coté front
	public function get($oModule, $culture)
	{
		include_once('model/module_blockmap_element.class.php');
		$elements	= Module_blockmap_element::getValidByModule($oModule->id);
		$nbElement	= count($elements);
			
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}