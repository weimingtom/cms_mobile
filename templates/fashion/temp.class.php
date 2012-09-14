<?php
class TemplateFashion extends \cms\Template
{
	
	const TITLE			= 'Fashion';
	const VERSION		= 1.0;
	
	protected $path = 'fashion/';
	
	public function __construct()
	{
		parent::__construct();
				
		//$this->addAsset('js', JS_DIR.'main.js', 'file');
	}
	
	// Default
	public static function getDefaultStyle()
	{
		return array(
			'font_family'	=> 'Helvetica',
			'font_size'		=> '12px',
			'font_color'	=> '555555',
			'h1_size'		=> '2.5em',
			'h2_size'		=> '2em',
			'h3_size'		=> '1.5em',
			'h4_size'		=> '1em',
			'h5_size'		=> '1em',
			'background'	=> 'F9F9F9',
			'color1'		=> array(
			'100'	=> '1B4493',
				'80'	=> self::get_color('1B4493', 80),
				'60'	=> self::get_color('1B4493', 60),
				'50'	=> self::get_color('1B4493', 50),
				'30'	=> self::get_color('1B4493', 30)
			),
			'color2'		=> array(
			'100'	=> '2489CE',
				'80'	=> self::get_color('2489CE', 80),
				'60'	=> self::get_color('2489CE', 60),
				'50'	=> self::get_color('2489CE', 50),
				'30'	=> self::get_color('2489CE', 30)
			)
		);
	}
	
	public function allocateStyle($oConfigurationTranslate)
	{
		$customStyle = self::formatCustomStyle($oConfigurationTranslate);
		
		// Si le style issu de la DB est vide alors affecte celui par default
		$defaultStyle = self::getDefaultStyle();
		foreach($customStyle as $key => $cStyle)
			$customStyle[$key] = !empty($cStyle)? $cStyle:$defaultStyle[$key];
		
		$this->addAsset('css', CSS_DIR.'main.css.php?values='.json_encode($customStyle), 'custom');
	}
	
}