<?php
class Module_blockslider extends \classes\model\Common
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
		$query = $pdo->prepare('INSERT INTO module_blockslider(fk_module_item, control) VALUES (:fk_module_item, :control);');
		$query->execute(array( 'fk_module_item' => $fk_module_item, 'control' => $control ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockslider SET fk_module_item = :fk_module_item, control = :control WHERE id = :id;');
		$query->execute(array( 'fk_module_item' => $fk_module_item, 'control' => $control, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateControl($fk_module_item, $control)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockslider SET control = :control WHERE fk_module_item = :fk_module_item;');
		$query->execute(array( 'fk_module_item' => $fk_module_item, 'control' => $control ));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, fk_module_item, control FROM module_blockslider WHERE id = :id;', array( 'id' => $id ));
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
		
		return $pdo->selectAll('SELECT id, fk_module_item, control FROM module_blockslider WHERE '.$where.';', $values);
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM module_blockslider WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
}