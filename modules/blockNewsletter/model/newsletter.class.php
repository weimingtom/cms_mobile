<?php
class Newsletter extends \classes\model\Common
{
	
	public static function set($id, $values)
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
		$query = $pdo->prepare('INSERT INTO newsletter(culture, email, date_inscription, status) VALUES (:culture, :email, NOW(), :status);');
		$query->execute(array( 'culture' => $culture, 'email' => $email, 'status' => self::STATUS_OFFLINE ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE newsletter SET culture = :culture, email = :email, status = :status WHERE id = :id;');
		$query->execute(array( 'culture' => $culture, 'email' => $email, 'status' => self::STATUS_OFFLINE, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, culture, email, date_inscription, status FROM newsletter WHERE id = :id;', array( 'id' => $id ));
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
		
		return $pdo->selectAll('SELECT id, culture, email, date_inscription, status FROM newsletter WHERE '.$where.';', $values);
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM newsletter WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
	
}