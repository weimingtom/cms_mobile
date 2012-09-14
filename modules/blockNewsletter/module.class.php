<?php
class ModuleBlockNewsletter extends \cms\Module
{
	
	const TITLE			= 'Block Newsletter';
	const VERSION		= 1.0;
	const MANAGER		= true;
	const MODEL			= true;
		
	protected $path			= 'blockNewsletter/';
	private $modeleClass	= 'ModuleItem';
	
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
		return 'Ce module n\'est pas administrable';
	}
	
	// coté front
	public function get($oModule, $culture)
	{
		$return = array();
		if(isset($_POST['action']) && $_POST['action']=='newsletter')
		{
			if(!\helpers\Helper::checkEmail($_POST['email']))
			{
				$return['error'] = array(__('Your e-mail address is incorrect'));
			}
			else {
				include('model/newsletter.class.php');
				Newsletter::set(0, $_POST);
				
				$return['valid'] = __('Thank you for your registration');
			}
		}
		
		ob_start();
		require('module.html.php');
		return ob_get_clean();
	}
	
	// Manager
	public function manager()
	{
		include('model/newsletter.class.php');
		$newsletters = Newsletter::getAll();
		
		ob_start();
		require('manager.html.php');
		return ob_get_clean();
	}
	
	// Manager
	public function export()
	{
		include('model/newsletter.class.php');
	
		// Crée un export csv
		$return = "id;email;langue;date inscription\n";
		foreach(Newsletter::getAll() as $oNewsletter)
			$return .= $oNewsletter->id.";".$oNewsletter->email.";".$oNewsletter->culture.";".$oNewsletter->date_inscription."\n";
		
		return $return;
	}
	
}