<?php
class ModuleFormContact extends \cms\Module
{
	
	const TITLE			= 'Formulaire de contact';
	const VERSION		= 1.0;
	const MODEL			= true;
	const MANAGER		= false;
		
	protected $path			= 'formContact/';
	private $modeleClass	= 'contact.class.php';
	
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
		$_SESSION['Captcha'] = self::randomString(5);
		
		$return = array();
		if(isset($_POST['action']) && $_POST['action']=='contact')
		{
			$values = $_POST['content'][$oModule->id];
			
			// Validation champs
			$return['error'] = array();
			if(!\helpers\Helper::checkEmail($values['email']))					$return['error']['email']	= __('Your e-mail address is incorrect');
			if(strtoupper($values['captcha']) != $_POST['antispam_confirm']) 	$return['error']['captcha']	= __('Antispam incorrect !');
			
			
			if(count($return['error'])==0)
			{
				include('model/contact.class.php');
				Contact::set(0, $values);
				
				$data	= json_decode($oModule->datas);
				Contact::sendEmail($values, $data->content->dest);
				
				$return['valid'] = __('Thank you for your registration');
			}
		}
		
		$id			= $oModule->id;
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
}