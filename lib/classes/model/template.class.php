<?php
namespace classes\model;
use \MyPDO as MyPDO;

class Template extends Common
{
		
	public static function set($id, $values)
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
		$query = $pdo->prepare('INSERT INTO template(title, folder, status) VALUES (:title, :folder, :status);');
		$query->execute(array( 'title' => $title, 'folder' => $folder, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE template SET title = :title, folder = :folder, status = :status WHERE id = :id;');
		$query->execute(array( 'title' => $title, 'folder' => $folder, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
		
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, title, folder, status FROM template WHERE id = :id;', array( 'id' => $id ));
	}
	
	public static function getAll($valid=0)
	{
		$pdo = MyPDO::getInstance();
		
		$where	= '1=1';
		$values	= array();
		if($valid) {
			$where	= 'status = :status';
			$values	= array('status' => self::STATUS_ONLINE);
		}
		
		return $pdo->selectAll('SELECT id, title, folder, status FROM template WHERE '.$where.';', $values);
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function isInstalled($title)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, title, folder, status FROM template WHERE folder = :folder;', array( 'folder' => $title ));
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM template WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
}