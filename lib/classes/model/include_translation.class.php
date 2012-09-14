<?php
namespace classes\model;
use \MyPDO as MyPDO;

class IncludeTranslation extends Common
{
	
	const STATUS_OFFLINE	= 0;
	const STATUS_ONLINE		= 1;
	
	public static function getStatus($status) {
		$statusList = array(
			self::STATUS_OFFLINE	=> 'Hors Ligne',
			self::STATUS_ONLINE		=> 'En Ligne',
		);
	
		return $statusList[$status];
	}
		
	public static function set($id, $values, $img=null)
	{
		$pdo = MyPDO::getInstance();
				
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
		$query = $pdo->prepare('INSERT INTO include_translation(culture, title, type, creat_date, last_modified, status) VALUES (:culture, :title, :type, :creat_date, :last_modified, :status);');
		$query->execute(array( 'culture' => $culture, 'title' => $title, 'type' => $type, 'creat_date' => $creat_date, 'last_modified' => $last_modified, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE include_translation SET culture = :culture, title = :title, type = :type, creat_date = :creat_date, last_modified = :last_modified, status = :status WHERE id = :id;');
		$query->execute(array( 'culture' => $culture, 'title' => $title, 'type' => $type, 'creat_date' => $creat_date, 'last_modified' => $last_modified, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, culture, title, type, creat_date, last_modified, status FROM include_translation WHERE id = :id;', array( 'id' => $id ));
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
		
		return $pdo->selectAll('SELECT id, culture, title, type, creat_date, last_modified, status FROM include_translation WHERE '.$where.';', $values);
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM include_translation WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
}