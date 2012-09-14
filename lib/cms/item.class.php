<?php
namespace cms;

abstract class Item
{
	
	protected $asset	= array();
	
	/*
	 * @author yoann
	 */
	public function __construct()
	{
		$this->asset['css'] = array();
		$this->asset['js'] = array();
	}
	
	//asset('css', 'lien vers le fichier', 'file')
	//$mode = 'file', 'code', 'external', 'custom'
	public function addAsset($type, $value=null, $mode='code')
	{
		$this->asset[$type][] = array(
			'value' => $value,
			'type'	=> $type,
			'mode'	=> $mode
		);
	}
	
	/*
	 * Return asset
	 */
	public function getAsset($type)
	{
		return $this->asset[$type];
	}
	
	public static function getNotInstalled()
	{
		
	}
	
	public static function install($module)
	{
	
	}
	
	function randomString($nbcar)
	{
		$chaine = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
	
		srand((double)microtime()*1000000);
	
		$variable='';
	
		for($i=0; $i<$nbcar; $i++) $variable .= $chaine{rand()%strlen($chaine)};
		return $variable;
	}
	
}