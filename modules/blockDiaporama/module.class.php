<?php
class ModuleBlockDiaporama extends \cms\Module
{
	
	const TITLE			= 'Block Diaporama';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= true;
		
	protected $path		= 'blockDiaporama/';
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->addAsset('css', CSS_DIR.'style.css', 'file');
		$this->addAsset('css', CSS_DIR.'style.css', 'file');
		$this->addAsset('js', JS_DIR.'jquery.tmpl.min.js', 'file');
		$this->addAsset('js', JS_DIR.'jquery.elastislide.js', 'file');
		$this->addAsset('js', JS_DIR.'gallery.js', 'file');
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
		
		include_once('model/module_blockdiaporama_element.class.php');
						
		// Delete élément
		if(isset($_GET['delete']) && $_GET['delete']=='block_diaporama' && $_GET['element'])
			Module_blockdiaporama_element::del($_GET['element']);
		
		// traitement du formulaire
		if($values && $values['id']==$id && count($values)>0)
		{
			$elements	= Module_blockdiaporama_element::getValidByModule($id);
			if(!$elements)
			{
				include_once('model/module_blockdiaporama.class.php');
				Module_blockdiaporama::set(0, array('fk_module_item' => $id));
				
				$elements	= Module_blockdiaporama_element::getModule($id);
			}
			
			if(!empty($_FILES['diaporama']['tmp_name'])) {
				//\classes\model\ModuleItem::set($id, $values['diaporama'][$id]);
				$values = array_merge($values, array(
					'fk_module_blockdiaporama'	=> $elements[0]->fk_module_blockdiaporama, 
					'infos'						=> null,
					'order'						=> 0,
					'status'					=> Module_blockdiaporama_element::STATUS_ONLINE
				));
				Module_blockdiaporama_element::set(0, $values, $_FILES['diaporama']);
			}
			
			$return[$id]['valid'] = VALID_TEXT;
		}
		
		// Récupère le contenu
		$elements	= Module_blockdiaporama_element::getValidByModule($id);
				
		ob_start();
		require('admin.html.php');
		return ob_get_clean();
	}
	
	// coté front
	public function get($oModule, $culture)
	{
		include_once('model/module_blockdiaporama_element.class.php');
		$elements	= Module_blockdiaporama_element::getValidByModule($oModule->id);
		$nbElement	= count($elements);
			
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}