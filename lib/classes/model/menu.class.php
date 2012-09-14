<?php
namespace classes\model;
use \MyPDO as MyPDO;

class Menu extends Common
{
	
	public static function set($id, $values, $img=null)
	{
		if($id == 0)
			$id = self::insert($values);
		else
			self::update($id, $values);
				
		return $id;
	}
	
	public static function insert($values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO menu(title) VALUES (:title);');
		$query->execute(array( 'title' => $title ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE menu SET title = :title WHERE id = :id;');
		$query->execute(array( 'title' => $title, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, title FROM menu WHERE id = :id;', array( 'id' => $id ));
	}
	
	public static function getAll()
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectAll('SELECT id, title FROM menu;');
	}
		
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM menu WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
}