<?php
namespace classes\model;
use \MyPDO as MyPDO;

class Page extends Common {
	
	const URL_MAPPING	= '[[ID]]-page-[[SLUG]]';
	
	const HEADER_ID		= 1;
	const FOOTER_ID		= 2;
	
	const IS_HEADER		= 1;
	const ISNOT_HEADER	= 0;
	const IS_FOOTER		= 1;
	const ISNOT_FOOTER	= 0;
	
	public static function getIncludeTitle($id) {
		$includeList = array(
			self::HEADER_ID	=> 'Header',
			self::FOOTER_ID	=> 'Footer'
		);
	
		return $includeList[$id];
	}
	
	public static function set($id, $values) {
		if($id == 0)
			$id = self::insert($values);
		else
			self::update($id, $values);
		
		return $id;
	}
	
	public static function setTranslation($id, $values)
	{
		if(self::get($id, $values['culture']))
			self::updateTranslation($id, $values);
		else
			self::insertTranslation($id, $values);
	}
	
	public static function insert($values) {
		extract($values);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO page(fk_template, label, header, footer, is_home, is_404) VALUES (:fk_template, :label, :header, :footer, :is_home, :is_404);');
		$query->execute(array( 'fk_template' => $fk_template, 'label' => $label, 'header' => $header, 'footer' => $footer, 'is_home' => $is_home, 'is_404' => $is_404 ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	public static function insertTranslation($id, $values) {
		extract($values);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO page_translation(id, culture, title, meta_description, meta_keywords, creat_date, last_modified, status) VALUES 
								(:id, :culture, :title, :meta_description, :meta_keywords, NOW(), NOW(), :status);');
		$query->execute(array( 'id' => $id, 'culture' => $culture, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'status' => $status ));
		$pdo->catchError($query);
	}
	
	public static function update($id, $values) {
		extract($values);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE page SET fk_template = :fk_template, label = :label, header = :header, footer = :footer, is_home = :is_home, is_404 = :is_404 WHERE id = :id;');
		$query->execute(array( 'fk_template' => $fk_template, 'label' => $label, 'header' => $header, 'footer' => $footer, 'is_home' => $is_home, 'is_404' => $is_404, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateTranslation($id, $values) {
		extract($values);
	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE page_translation SET title = :title, meta_description = :meta_description, meta_keywords = :meta_keywords, last_modified = NOW(), status = :status WHERE id = :id AND culture = :culture;');
		$query->execute(array( 'culture' => $culture, 'title' => $title, 'meta_description' => $meta_description, 'meta_keywords' => $meta_keywords, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
			
	public static function get($id, $culture='', $valid='') {
		$pdo = MyPDO::getInstance();
		
		if($culture == '')
		{
			return $pdo->selectOne('SELECT	p.id, p.fk_template, p.label, p.header, p.footer, p.is_home, p.is_404
									FROM page p 
									WHERE p.id = :id;', 
									array( 'id' => $id ));
		}
		else
		{ 
			$where	= '';
			$values	= array();
			if($valid) {
				$where	= ' AND status = :status';
				$values	= array('status' => self::STATUS_ONLINE);
			}
			
			return $pdo->selectOne('SELECT	p.id, p.fk_template, p.label, p.header, p.footer, p.is_home, p.is_404,
											pt.culture, pt.title, pt.meta_description, pt.meta_keywords, pt.creat_date, pt.last_modified, pt.status
									FROM page p
										INNER JOIN page_translation pt ON p.id = pt.id AND pt.culture = :culture
									WHERE p.id = :id'.$where.';',
									array_merge(array( 'id' => $id, 'culture' => $culture ), $values));
		}
	}
	
	public static function getByType($type, $culture)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT	p.id, p.fk_template, p.label, p.header, p.footer, p.is_home, p.is_404,
										pt.culture, pt.title, pt.meta_description, pt.meta_keywords, pt.creat_date, pt.last_modified, pt.status
								FROM page p
									INNER JOIN page_translation pt ON p.id = pt.id AND pt.culture = :culture
								WHERE p.'.$type.' = 1
								ORDER BY p.id
								LIMIT 1;',
		array( 'culture' => $culture ));
	}
		
	public static function get404($culture='fr')
	{
		return self::getByType('is_404', $culture);
	}
	
	public static function getHome($culture)
	{
		return self::getByType('is_home', $culture);
	}
	
	public static function getAll($culture='fr', $valid=0) {
		$pdo = MyPDO::getInstance();
		if($valid==0)
			return $pdo->selectAll('SELECT p.id, p.fk_template, p.label, p.header, p.footer, p.is_home, p.is_404, pt.title
									FROM page p
										LEFT JOIN page_translation pt ON p.id = pt.id AND pt.culture = :culture
									WHERE p.is_header	= :header
										AND p.is_footer	= :footer
									ORDER BY p.label;',
									array(
										'culture'	=> $culture,
										'header'	=> self::ISNOT_HEADER, 
										'footer'	=> self::ISNOT_FOOTER
									)
			);
		else
			return $pdo->selectAll('SELECT p.id, p.fk_template, p.label, p.header, p.footer, p.is_home, p.is_404, pt.title
									FROM page p
										LEFT JOIN page_translation pt ON p.id = pt.id AND pt.culture = :culture
									WHERE p.is_header	= :header
										AND p.is_footer	= :footer
										AND pt.status	= :status
									ORDER BY p.label;',
									array(
										'culture'	=> $culture, 
										'header'	=> self::ISNOT_HEADER, 
										'footer'	=> self::ISNOT_FOOTER, 
										'status'	=> self::STATUS_ONLINE
									)
			);
	}
	
	public static function getValid($lang='fr') {
		return self::getAll($lang, 1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		
		// Supprime les slider qui lui sont associés
		Element::delByPage($id);
		Slider::delByPage($id);
		
		$query = $pdo->prepare('DELETE FROM page WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function generateTranslation($id, $cultures)
	{
		$pdo = MyPDO::getInstance();
		
		foreach($cultures as $culture)
		{
			$res = $pdo->selectOne('SELECT id FROM page_translation WHERE id = :id AND culture = :culture;', array( 'id' => $id, 'culture' => $culture->id ));
			if(!$res)
			{
				$query = $pdo->prepare('INSERT INTO page_translation(id, culture, creat_date, last_modified) VALUES (:id, :culture, NOW(), NOW());');
				$query->execute(array( 'id' => $id, 'culture' => $culture->id ));
				$pdo->catchError($query);
			}
		}
	}
	
	public static function getTitleById($id, $culture)
	{
		$pdo = MyPDO::getInstance();
		
		return $pdo->selectOne('SELECT title
								FROM page_translation
								WHERE id = :id
									AND culture = :culture;',
			array(
				'id'		=> $id,
				'culture'	=> $culture,
			)
		)->title;
	}
	
	
	
	public static function getPageUrl($id, $lang)
	{
		$oPage = self::get($id, $lang);
		
		return self::formatPageUrl($oPage->id, $oPage->title);
	}
	public static function formatPageUrl($id, $title)
	{
		$url = self::URL_MAPPING;
		$url = str_replace('[[ID]]', $id, $url);
		$url = str_replace('[[SLUG]]', self::getSlug($title), $url);
	
		return $url;
	}
	public static function getSlug($string)
	{
		//$string = strtr($string,' "!@#$%?&*()+*','--------------'); // enlever caractere speciaux
		//$string = strtr($string,"'",'-'); // enlever guillement simple
		
		// enlever les accents
		//$string =  strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
		$string = \Helpers\helper::my_basename($string);
		$string = \Helpers\helper::nettoyer_chaine($string);
		$string = strtolower($string);
		
		return $string;
	}
	
}