<?php
class Module_blockmap_element extends \classes\model\Common
{
	
	const UPLOAD_DIR	= 'uploads/blockMap/';
	
	public static function set($id, $values, $img=null)
	{
		// Transforme les , en . pour éviter les erreurs
		$values['latitude']		= str_replace(',', '.', $values['latitude']);
		$values['longitude']	= str_replace(',', '.', $values['longitude']);
		
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
		$query = $pdo->prepare('INSERT INTO module_blockmap_element(fk_module_blockmap, title, infos, latitude, longitude, status) VALUES (:fk_module_blockmap, :title, :infos, :latitude, :longitude, :status);');
		$query->execute(array( 'fk_module_blockmap' => $fk_module_blockmap, 'title' => $title, 'infos' => $infos, 'latitude' => $latitude, 'longitude' => $longitude, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockmap_element SET title = :title, infos = :infos, latitude = :latitude, longitude = :longitude, status = :status WHERE id = :id;');
		$query->execute(array( 'title' => $title, 'infos' => $infos, 'latitude' => $latitude, 'longitude' => $longitude, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateImg($id, $img)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_blockmap_element SET img = :img WHERE id = :id;');
		$query->execute(array('img' => $img, 'id' => $id));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, fk_module_blockmap, img, title, infos, latitude, longitude, status FROM module_blockmap_element WHERE id = :id;', array( 'id' => $id ));
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
		
		return $pdo->selectAll('SELECT id, fk_module_blockmap, img, title, infos, latitude, longitude, status FROM module_blockmap_element WHERE '.$where.';', $values);
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
		return $pdo->selectAll('SELECT me.id, me.fk_module_blockmap, me.img, me.title, me.infos, me.latitude, me.longitude, me.status
			FROM module_blockmap_element	me
			INNER JOIN module_blockmap		m	ON me.fk_module_blockmap = m.id AND m.fk_module_item = :module
			WHERE '.$where.'
			ORDER BY me.title;', $values);
	}
	
	public static function getModule($module_id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectAll('SELECT id fk_module_blockmap FROM module_blockmap WHERE fk_module_item = :module', array('module' => $module_id));
	}
	
	public static function getValidByModule($module_id)
	{
		return self::getByModule($module_id, 1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM module_blockmap_element WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
		
	public static function delFile($id, $delete)
	{
		$pdo	= MyPDO::getInstance();
		
		// Récupère le fichier a supprimer
		$file	= $pdo->selectOne('SELECT id, '.$delete.' FROM module_blockmap_element WHERE id = :id;', array('id' => $id));
		// Supprime du disque le fichier
		@unlink('../'.self::UPLOAD_DIR.$file->id.'/'.$file->$delete);
		@unlink('../'.self::UPLOAD_DIR.$file->id.'/mini-'.$file->$delete);
		// Supprime le fichier de la base
		if($delete=='img')
			self::updateImg($id, null);
		else
			self::updateSon($id, null);
	}
	
}