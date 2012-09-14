<?php
class ModuleBlockSlider extends \cms\Module
{
	
	const TITLE			= 'Block Slider';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= true;
		
	protected $path		= 'blockSlider/';
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->addAsset('css', CSS_DIR.'style.css', 'file');
		$this->addAsset('css', CSS_DIR.'rslides.css', 'file');
		$this->addAsset('js', JS_DIR.'responsiveslides.min.js', 'file');
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
		
		include_once('model/module_blockslider_element.class.php');
		$elements	= Module_blockslider_element::getValidByModule($id);
				
		// Delete élément
		if(isset($_GET['delete']) && $_GET['delete']=='block_slider' && $_GET['element'])
			Module_blockslider_element::del($_GET['element']);
		
		// traitement du formulaire
		if($values && $values['id']==$id && count($values)>0)
		{
			$control	= isset($values['content'][$id]['control'])? $values['content'][$id]['control']:0;
			if(!$elements)
			{
				include_once('model/module_blockslider.class.php');
				Module_blockslider::set(0, array('fk_module_item' => $id, 'control' => $control));
				
				$elements	= Module_blockslider_element::getModule($id);
			}
			elseif($elements[0]->control != $control)
			{
				include_once('model/module_blockslider.class.php');
				Module_blockslider::updateControl($id, $control);
			}
			
			if(!empty($_FILES['slider']['tmp_name'])) {
				//\classes\model\ModuleItem::set($id, $values['slider'][$id]);
				$values = array_merge($values, array(
					'fk_module_blockslider'	=> $elements[0]->fk_module_blockslider, 
					'infos'					=> null,
					'order'					=> 0,
					'status'				=> Module_blockslider_element::STATUS_ONLINE
				));
				Module_blockslider_element::set(0, $values, $_FILES['slider']);
			}
			
			$return[$id]['valid'] = VALID_TEXT;
		}
		
		// Récupère le contenu
		$elements	= Module_blockslider_element::getValidByModule($id);
		
		ob_start();
		require('admin.html.php');
		return ob_get_clean();
	}
	
	// coté front
	public function get($oModule, $culture)
	{
		include_once('model/module_blockslider_element.class.php');
		$elements	= Module_blockslider_element::getValidByModule($oModule->id);
		$nbElement	= count($elements);
			
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}