<?php
class ModuleBlockMenu extends \cms\Module
{
	
	const TITLE			= 'Menu';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= false;
	
	protected $path			= 'blockMenu/';
	
	const DISPLAY_INLINE_ALL_ON_BAR		= 1;
	const DISPLAY_INLINE_ONE_BY_ONE		= 2;
	const DISPLAY_INLINE_ALL_IN_TXT		= 3;
	const DISPLAY_BLOCK_ONE_BY_LIGN		= 4;

	public static function getDisplay($display) {
		$displayList = array(
			self::DISPLAY_INLINE_ALL_ON_BAR		=> 'Afficher en ligne dans une boite (mode classique)',
			self::DISPLAY_INLINE_ONE_BY_ONE		=> 'Afficher en ligne 1 par 1 (exemple page)',
			self::DISPLAY_INLINE_ALL_IN_TXT		=> 'Afficher en ligne en texte (exemple footer)',
			self::DISPLAY_BLOCK_ONE_BY_LIGN		=> 'Afficher 1 par ligne (exemple home)',
		);

		return $displayList[$display];
	}
	
	public function __construct()
	{
		parent::__construct();
		//$this->addAsset('css', CSS_DIR.'main.css', 'file');
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
		
		if($element->display == self::DISPLAY_INLINE_ONE_BY_ONE)
		{
			// Page home
			$homePage	= \classes\model\Page::getHome($culture);
			$homeUrl	= \classes\model\Page::getPageUrl($homePage->id, $culture);
		}
		
		$menuItem	= \classes\model\MenuItem::getValid($element->menu, $culture);
		$uri		= explode('/', $_SERVER['REQUEST_URI']);
		$filename	= $uri[count($uri)-1];
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}