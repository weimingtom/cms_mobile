<?php
namespace classes\model;
use \MyPDO as MyPDO;

class ModuleItem extends Common
{
	
	const UPLOAD_DIR	= 'uploads/module_item/';
	
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
		
		$order = self::getLastOrder($fk_page_translation);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO module_item(`order`, datas, fk_module, fk_page_translation, culture, status) VALUES (:order, :datas, :fk_module, :fk_page_translation, :culture, :status);');
		$query->execute(array( 'order' => $order, 'datas' => $datas, 'fk_module' => $fk_module, 'fk_page_translation' => $fk_page_translation, 'culture' => $culture, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $datas)
	{
		$datas = json_encode($datas);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_item SET datas = :datas WHERE id = :id;');
		$query->execute(array( 'datas' => $datas, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateStatus($id, $status)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_item SET status = :status WHERE id = :id;');
		$query->execute(array( 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, `order`, datas, fk_module, fk_page_translation, culture, status FROM module_item WHERE id = :id;', array( 'id' => $id ));
	}
	
	public static function getAll($page, $culture, $valid=0)
	{
		$pdo = MyPDO::getInstance();
		
		$where	= 'fk_page_translation = :page AND mi.culture = :culture AND m.status = :mstatus';
		$values	= array(
			'page'		=> $page, 
			'culture'	=> $culture, 
			'mstatus'	=> self::STATUS_ONLINE
		);
		if($valid) {
			$where	.= ' AND mi.status = :mistatus';
			$values	= array_merge($values, array('mistatus' => self::STATUS_ONLINE));
		}
		
		return $pdo->selectAll('SELECT	mi.id, mi.order, mi.datas, mi.fk_module, mi.fk_page_translation, mi.status,
									 	m.folder, m.title
								FROM module_item mi
									INNER JOIN module m ON mi.fk_module = m.id
								WHERE '.$where.'
								ORDER BY mi.order;',
								$values);
	}
	
	public static function getValid($page, $culture)
	{
		return self::getAll($page, $culture, 1);
	}
	
	public static function getLastOrder($fk_page_translation)
	{
		$pdo = MyPDO::getInstance();
		echo 'SELECT MAX(`order`) `order` FROM module_item WHERE fk_page_translation = '.$fk_page_translation;
		$res = $pdo->selectOne('SELECT MAX(`order`) `order` FROM module_item WHERE fk_page_translation = :page_translation;', array( 'page_translation' => $fk_page_translation ));
	
		return $res? $res->order+1:1;
	}
	
	public static function updateOrder($id, $order)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_item SET `order` = :order WHERE id = :id;');
		$query->execute(array( 'order' => $order, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM module_item WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
}