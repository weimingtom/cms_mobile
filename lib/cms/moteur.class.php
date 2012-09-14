<?php
namespace cms;

class moteur
{
	
	const TEMPLATE_DIR				= '/../../templates/';
	const MODULE_DIR				= '/../../modules/';
	
	private $page						= 0;
	private $lang						= '';
	private $content					= array();
	private $header						= array();
	private $footer						= array();
	private $oConfigurationTranslate	= null;
	private $cultures					= null;
	private $oPage						= null;
	private $oTemplate					= null;
	
	private $css						= array();
	private $js							= array();
	
	
	public function __construct($page, $lang)
	{
		$this->page	= $page;
		$this->lang	= $lang;
		
		// Récupère la liste des langues valides
		$this->cultures = \classes\model\Culture::getValid();
		
		// Récupère la page
		$this->getPage();
		
		// récupère les infos générales du site
		$this->oConfigurationTranslate = \classes\model\Configuration::get($this->lang);
		
		// récupère le template
		$this->getTemplate($this->oPage->fk_template);
	}
	
	public function getPage() {
		// Si la langue demandée n'est pas valide alors on renvoie une page 404
		if(!\classes\model\Culture::isValid($this->lang))
			$this->oPage = \classes\model\Page::get404();
		
		// Si la page n'est pas identifié (id 0) alors on renvoie une page Home
		if(!$this->oPage && $this->page==0)
			$this->oPage = \classes\model\Page::getHome($this->lang);
		
		// Récupère la page demandé
		if(!$this->oPage)
		{
			$this->oPage = \classes\model\Page::get($this->page, $this->lang, 1);
			
			// Si la page est introuvable
			if(!$this->oPage)
				$this->oPage = \classes\model\Page::get404($this->lang);
		}
		
		if($this->oPage) {
			$this->content	= $this->getModules($this->oPage->id, $this->oPage->culture);
			$this->header	= $this->getModules(\classes\model\Page::HEADER_ID, $this->oPage->culture);
			$this->footer	= $this->getModules(\classes\model\Page::FOOTER_ID, $this->oPage->culture);
		}
		else
		{
			// Si aucune page n'est trouvée on renvoie une page 404
			include('404error.php');
			die;
		}
	}
	
	public function getModules($id, $culture) {
		$arrayModule = array();
		foreach(\classes\model\ModuleItem::getValid($id, $culture) as $oModule)
		{
			if(!file_exists(__DIR__.self::MODULE_DIR.$oModule->folder.'/module.class.php'))
				die($oModule->folder.' This module doesn\'t exist');
			include_once(__DIR__.self::MODULE_DIR.$oModule->folder.'/module.class.php');
			$class = 'Module'.$oModule->folder;
			$moduleItem = new $class();
			
			$module = $moduleItem->get($oModule, $culture);
			$arrayModule[] = $module;
			
			// Récupère les asset (css + js)
			$this->css	= array_merge($this->css,	$moduleItem->getAsset('css'));
			$this->js	= array_merge($this->js,	$moduleItem->getAsset('js'));
		}
		
		return $arrayModule;
	}
	
	public function getTemplate($id) {
		$template = \classes\model\Template::get($id);
		
		if(!file_exists(__DIR__.self::TEMPLATE_DIR.$template->folder.'/temp.class.php'))
			die($template->folder.' This template doesn\'t exist');
			
		include_once(__DIR__.self::TEMPLATE_DIR.$template->folder.'/temp.class.php');
		$class = 'Template'.$template->folder;
		$this->oTemplate = new $class();
		
		// Assigne le style
		$this->oTemplate->allocateStyle($this->oConfigurationTranslate);
		
		// Récupère les asset (css + js)
		$this->css	= array_merge($this->css,	$this->oTemplate->getAsset('css'));
		$this->js	= array_merge($this->js,	$this->oTemplate->getAsset('js'));
	}
	
	public function assetic($asset)
	{
		$assetic = array();
		foreach($this->$asset as $value)
		{
			if($value['type'] == 'css')
			{
				if($value['mode']=='external')
					$assetic[] = '<link href="'.$value['value'].'" rel="stylesheet" />';
				elseif($value['mode']=='file')
					$assetic[] = '<link href="'.BASE_DIR.$value['value'].'" rel="stylesheet" />';
				elseif($value['mode']=='custom')
					$assetic[] = "<link href='".BASE_DIR.$value['value']."' rel=\"stylesheet\" />";
				elseif($value['mode']=='code')
					$assetic[] = '<style>'.$value['value'].'</style>';
			}
			elseif($value['type'] == 'js')
			{
				if($value['mode']=='external')
					$assetic[] = '<script src="'.$value['value'].'"></script>';
				if($value['mode']=='file')
					$assetic[] = '<script src="'.BASE_DIR.$value['value'].'"></script>';
				elseif($value['mode']=='code')
					$assetic[] = '<script>'.$value['value'].'</script>';
			}
		}
		
		return implode("\n", $assetic);
	}
		
	public function toString()
	{
		$datas = array();
		$datas['page_header']			= implode("\n", $this->header);
		$datas['page_footer']			= implode("\n", $this->footer);
		$datas['page_content']			= implode("\n", $this->content);
		$datas['site_title']			= $this->oConfigurationTranslate->title;
		$datas['google_analytics_id']	= $this->oConfigurationTranslate->google_analytics_id;
		$datas['page_title']			= $this->oPage->title;
		$datas['meta_keywords']			= $this->oPage->meta_keywords? $this->oPage->meta_keywords:$this->oConfigurationTranslate->meta_keywords;
		$datas['meta_description']		= $this->oPage->meta_description? $this->oPage->meta_description:$this->oConfigurationTranslate->meta_description;
		$datas['css']					= $this->assetic('css');
		$datas['js']					= $this->assetic('js');
		$datas['cultures']				= $this->cultures;
		$datas['lang']					= $this->lang;
		
		// Menus
		$datas['menu']				= array();
		foreach(\classes\model\Menu::getAll() as $key => $oMenu)
			$datas['menu'][ucfirst($oMenu->title)]	= \classes\model\MenuItem::getValid($oMenu->id, $this->lang);
		
		$this->oTemplate->toString($datas);
	}
	
}