<?php
class Module_blockslider_element extends \classes\model\Common
{
	
	const UPLOAD_DIR	= 'uploads/blockSlider/';
	
	public static function set($id, $values, $img=null)
	{
		if($id == 0)
			$id = self::insert($values);
		else
			self::update($id, $values);
		
		// Upload image
		$img_link = "";
		if($img!=null && $img['name']) {
			$upload = new \classes\Upload();
			$img_link = $upload->uploadFile($id, $img, '../'.self::UPLOAD_DIR);
			\classes\Upload::createMiniature('../'.self::UPLOAD_DIR.$id.'/'.$img_link);
			self::updateImg($id, $img_link);
		}
		
		return $id;
	}
	
	public static function insert($values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO module_blockslider_element(fk_module_blockslider, infos, `order`, status) VALUES (:fk_module_blockslider, :infos, :order, :status);');
		$query->execute(array( 'fk_module_blockslider' => $fk_module_blockslider, 'infos' => $infos, 'order' => $order, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockslider_element SET infos = :infos, `order` = :order, status = :status WHERE id = :id;');
		$query->execute(array( 'infos' => $infos, 'order' => $order, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateImg($id, $img)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockslider_element SET img = :img WHERE id = :id;');
		$query->execute(array('img' => $img, 'id' => $id));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, fk_module_blockslider, img, infos, `order`, status FROM module_blockslider_element WHERE id = :id;', array( 'id' => $id ));
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
		
		return $pdo->selectAll('SELECT id, fk_module_blockslider, img, infos, `order`, status FROM module_blockslider_element WHERE '.$where.';', $values);
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function getByModule($module_id, $valid=0)
	{
		$where	= '1=1';
		$values	= array('module' => $module_id);
		if($valid) {
			$where	.= ' AND status = :status';
			$values	= array_merge($values, array('status' => self::STATUS_ONLINE));
		}
		
		$pdo = MyPDO::getInstance();
		return $pdo->selectAll('SELECT se.id, se.fk_module_blockslider, se.img, se.infos, se.order, se.status,
										s.control 
								FROM module_blockslider_element se
									INNER JOIN module_blockslider s ON se.fk_module_blockslider = s.id AND s.fk_module_item = :module
								WHERE '.$where.'
								ORDER BY se.order;', $values);
	}
	
	public static function getModule($module_id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectAll('SELECT id fk_module_blockslider FROM module_blockslider WHERE fk_module_item = :module', array('module' => $module_id));
	}
	
	public static function getValidByModule($module_id)
	{
		return self::getByModule($module_id, 1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM module_blockslider_element WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function delFile($id, $delete)
	{
		$pdo	= MyPDO::getInstance();
		
		// Récupère le fichier a supprimer
		$file	= $pdo->selectOne('SELECT id, '.$delete.' FROM module_blockslider_element WHERE id = :id;', array('id' => $id));
		// Supprime du disque le fichier
		@unlink('../'.self::UPLOAD_DIR.$file->id.'/'.$file->$delete);
		@unlink('../'.self::UPLOAD_DIR.$file->id.'/mini-'.$file->$delete);
		// Supprime le fichier de la base
		if($delete=='img')
			self::updateImg($id, null);
		else
			self::updateSon($id, null);
	}
	
	public static function updateOrder($id, $order)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockslider_element SET `order` = :order WHERE id = :id;');
		$query->execute(array( 'order' => $order, 'id' => $id ));
		$pdo->catchError($query);
	}
	
}