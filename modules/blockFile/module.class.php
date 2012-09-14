<?php
class ModuleBlockFile extends \cms\Module
{
	
	const TITLE			= 'Fichier';
	const VERSION		= 1.0;
	const MANAGER		= false;
	const MODEL			= false;
	const UPLOAD_DIR	= 'uploads/blockFile/';
	
	protected $path			= 'blockFile/';
	
	public function __construct()
	{
		parent::__construct();
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
		if(isset($_GET['delete']) && $_GET['delete']=='file' && isset($_GET['module']) && $_GET['module']==$id)
		{
			unlink(__DIR__.'/../../'.self::UPLOAD_DIR.$id.'/'.$content->file);
		}
		
		$return = array();
		$return[$id] = array();
		if($values && $values['id']==$id && count($values)>0)
		{
			$datas = array();
						
			$values['content'][$id]['button']	= isset($values['content'][$id]['button'])? $values['content'][$id]['button']:0;
			$datas['content']	= $values['content'][$id];
			
			// Traitement de l'image
			$img_link = "";
			if(isset($_FILES['file']) && $_FILES['file']['name']) {
				$upload = new \classes\Upload();
				$file_link = $upload->uploadFile($id, $_FILES['file'], '../'.self::UPLOAD_DIR);
				$datas['content']['file'] = $file_link;
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
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}