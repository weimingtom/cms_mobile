<?php
namespace classes\model;
use \MyPDO as MyPDO;

class Module extends Common
{
	
	const UPLOAD_DIR	= 'uploads/module/';
	
	const MANAGER_OFF	= 0;
	const MANAGER_ON	= 1;
	
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
		$query = $pdo->prepare('INSERT INTO module(title, folder, manager, status) VALUES (:title, :folder, :manager, :status);');
		$query->execute(array( 'title' => $title, 'folder' => $folder, 'manager' => $manager, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module SET title = :title, folder = :folder, manager = :manager, status = :status WHERE id = :id;');
		$query->execute(array( 'title' => $title, 'folder' => $folder, 'manager' => $manager, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
		
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, title, folder, manager, status FROM module WHERE id = :id;', array( 'id' => $id ));
	}
		
	public static function isInstalled($title)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, title, folder, manager, status FROM module WHERE folder = :folder;', array( 'folder' => $title ));
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
		
		return $pdo->selectAll('SELECT id, title, folder, manager, status FROM module WHERE '.$where.';', $values);
	}
	
	public static function getAllWithManager()
	{
		$pdo = MyPDO::getInstance();
	
		return $pdo->selectAll('SELECT id, title, folder, manager, status FROM module WHERE manager = :manager;', array('manager' => self::MANAGER_ON));
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM module WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
}