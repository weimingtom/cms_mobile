<?php
namespace classes\model;
use \MyPDO as MyPDO;

class Culture extends Common {
	
	public static function set($values) {
		self::update($values);
	}
	
	public static function update($values) {
		extract($values);
		$pdo = MyPDO::getInstance();
		
		$status[$lang] = isset($status[$lang])? $status[$lang]:0;
		
		$query = $pdo->prepare('UPDATE culture SET status = :status WHERE id = :lang;');
		$query->execute(array( 'lang' => $lang, 'status' => $status[$lang] ));
		$pdo->catchError($query);
	}
	
	public static function updateStatus($id, $status=0) {
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE culture SET status = :status WHERE id = :id;');
		$query->execute(array( 'id' => $id, 'status' => $status ));
		$pdo->catchError($query);
	}
	
	public static function get($id) {
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, label, status FROM culture WHERE id = :id;', array( 'id' => $id ));
	}
	
	public static function getAll($valid=0) {
		$pdo = \MyPDO::getInstance();
		
		$where	= '1=1';
		$values	= array();
		if($valid) {
			$where	= 'status = :status';
			$values	= array('status' => self::STATUS_ONLINE);
		}
		
		return $pdo->selectAll('SELECT id, label, status FROM culture WHERE '.$where.' ORDER BY label;', $values);
	}
	
	public static function getValid() {
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM culture WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function isValid($lang)
	{
		$pdo = MyPDO::getInstance();
		$res = $pdo->selectOne('SELECT id FROM culture WHERE id = :id AND status = :status;', array( 'id' => $lang, 'status' => self::STATUS_ONLINE ));
		
		return $res? 1:0;
	}
		
}