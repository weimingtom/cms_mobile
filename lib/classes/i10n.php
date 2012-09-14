<?php
//require_once(dirname(__FILE__).'/_dependency/gettext/gettext.inc');
require_once(dirname(__FILE__).'/_dependency/gettext/streams.php');
require_once(dirname(__FILE__).'/_dependency/gettext/gettext.php');

class i10n {
	
	static $l10n = array();
	
	static function Path($path=NULL)
	{
		return 'locales/';
	}
	static function Root()
	{
		return ROOTPATH.'locales/';
	}
	
	static function SetLocale($locale)
	{
		Error::Trace(t("Loading @locale/messages.mo",array('@locale'=>$locale)));
		$messages = new FileReader(self::Root().$locale.'/messages.mo');
		self::$l10n = new gettext_reader($messages, false);
	}
	
	static function translate($string, $args = array())
	{
		foreach ($args as $key => $value) {
			switch ($key[0]) {
				case '@':
					// Escaped only.
					$args[$key] = htmlentities($value,ENT_COMPAT,'UTF-8');
					break;
		
				case '%':
					default:
					// Escaped and highlighted.
					$args[$key] = '<em>'.htmlentities($value,ENT_COMPAT,'UTF-8').'</em>';
					break;
		
				case '!':
					// Pass-through.
			}
		}
		if(is_object(self::$l10n))
			return strtr(self::$l10n->translate($string), $args);
		else
			return strtr($string, $args);
	}
	
	static function format_plural($regular, $plural, $count)
	{
		if($count>1)
			return self::translate($plural,array('@count'=>$count));
		return self::translate($regular,array('@count'=>$count));
	}
}
?>