<?php
class ModuleBlockImage extends \cms\Module
{
	
	const TITLE			= 'Image';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= false;
	const UPLOAD_DIR	= 'uploads/blockImage/';
	
	protected $path			= 'blockImage/';
	
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
		
		// Delete élément
		$pageLink = 'edit_page_lang.php?id='.$_GET['id'].'&culture='.$culture;
		if(isset($_GET['delete']) && $_GET['delete']=='img' && isset($_GET['module']) && $_GET['module']==$id)
		{
			unlink(__DIR__.'/../../'.self::UPLOAD_DIR.$id.'/'.$content->img);
		}
		
		$return = array();
		$return[$id] = array();
		if($values && $values['id']==$id && count($values)>0)
		{
			$datas = array();
			
			// Gestion des url
			$values['content'][$id]['external_url']	= isset($values['content'][$id]['external_url'])? $values['content'][$id]['external_url']:0;
			$values['content'][$id]['url']			= ($values['content'][$id]['external_url']==1)? $values['content'][$id]['url_externe']:'';
			$values['content'][$id]['id_page_dest']	= ($values['content'][$id]['external_url']==0)? $values['content'][$id]['url_interne']:'';
						
			$values['content'][$id]['img']			= isset($content->img)? $content->img:'';
			$values['content'][$id]['responsive']	= isset($values['content'][$id]['responsive'])? $values['content'][$id]['responsive']:0;
			$values['content'][$id]['link']			= isset($values['content'][$id]['link'])? $values['content'][$id]['link']:0;
			$values['content'][$id]['center']		= isset($values['content'][$id]['center'])? $values['content'][$id]['center']:0;
			$datas['content']	= $values['content'][$id];
			
			// Traitement de l'image
			$img_link = "";
			if(isset($_FILES['img']) && $_FILES['img']['name']) {
				$upload = new \classes\Upload();
				$img_link = $upload->uploadFile($id, $_FILES['img'], '../'.self::UPLOAD_DIR);
				$datas['content']['img'] = $img_link;
			}
			
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