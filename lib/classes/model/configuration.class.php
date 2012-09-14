<?php
namespace classes\model;
use \MyPDO as MyPDO;

class Configuration extends Common
{
		
	public static function set($values)
	{
		self::update(1, $values);
	}
	
	public static function update($id, $values)
	{
		extract($values);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE configuration SET font_family = :font_family, font_size = :font_size, font_color = :font_color, h1_size = :h1_size, h2_size = :h2_size, h3_size = :h3_size, h4_size = :h4_size, h5_size = :h5_size, background = :background, color1 = :color1, color2 = :color2, google_analytics_id = :google_analytics_id WHERE id = :id;');
		$query->execute(array( 'font_family' => $font_family, 'font_size' => $font_size, 'font_color' => $font_color, 'h1_size' => $h1_size, 'h2_size' => $h2_size, 'h3_size' => $h3_size, 'h4_size' => $h4_size, 'h5_size' => $h5_size, 'background' => $background, 'color1' => $color1, 'color2' => $color2, 'google_analytics_id' => $google_analytics_id, 'id' => $id ));
		$pdo->catchError($query);
		
		// Update des trads
		foreach(Culture::getAll(1) as $culture)
		{
			$lang = $culture->id;
			$status[$lang] = 1;
			
			if(self::issetTranslation($lang))
				$query = $pdo->prepare('UPDATE configuration_translation SET title = :title, meta_description = :meta_description, meta_keywords = :meta_keywords, book_link = :book_link, status = :status WHERE id = :id AND culture = :culture;');
			else
				$query = $pdo->prepare('INSERT INTO configuration_translation(id, culture, title, meta_description, meta_keywords, book_link, status) 
										VALUES (:id, :culture, :title, :meta_description, :meta_keywords, :book_link, :status);');
			$query->execute(array( 'culture' => $lang, 'title' => $title[$lang], 'meta_description' => $meta_description[$lang], 'meta_keywords' => $meta_keywords[$lang], 'book_link' => $book_link[$lang], 'status' => $status[$lang], 'id' => $id ));
			$pdo->catchError($query);
		} 
	}
	
	public static function get($lang='fr')
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT c.id, c.font_family, c.font_size, c.font_color, c.h1_size, c.h2_size, c.h3_size, c.h4_size, c.h5_size, c.background, c.color1, c.color2, c.google_analytics_id,
										ct.culture, ct.title, ct.book_link, ct.meta_description, ct.meta_keywords, ct.status
								FROM configuration c 
									LEFT JOIN configuration_translation ct ON c.id = ct.id AND culture = :lang
								WHERE c.id = 1;', 
								array( 'lang' => $lang ));
	}
	
	public static function issetTranslation($lang='fr')
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, culture
								FROM configuration_translation
								WHERE id = 1
									AND culture = :lang;',
								array( 'lang' => $lang ));
	}
	
}