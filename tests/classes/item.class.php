<?php
class Item extends Common {
	
	const UPLOAD_DIR	= 'uploads/voix_off/';
	const CD_DIR		= 'CD';
	
	public static function set($id, $values, $img, $son) {
		extract($values);
		$pdo = MyPDO::getInstance();
		
		$video = isset($video)? $video:null;
		
		if($id == 0)
			$id = self::insert($title, $subtitle, $type, $video, $status);
		else
			self::update($id, $title, $subtitle, $type, $video, $status);
		
		// Upload image
		$img_link = "";
		if($img['name']) {
			$img_link = Upload::uploadFile($id, $img, '../'.self::UPLOAD_DIR);
			Upload::createMiniature('../'.self::UPLOAD_DIR.$id.'/'.$img_link);
			self::updateImg($id, $img_link);
		}
		
		return $id;
	}
	
	public static function insert($title, $subtitle, $type, $video, $status) {
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO voix_off(title, subtitle, type, video, status) VALUES (:title, :subtitle, :type, :video, :status);');
		$query->execute(array( 'title' => $title, 'subtitle' => $subtitle, 'video' => $video, 'type' => $type, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $title, $subtitle, $type, $video, $status) {
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE voix_off SET title = :title, subtitle = :subtitle, video = :video, type = :type, status = :status WHERE id = :id;');
		$query->execute(array( 'title' => $title, 'subtitle' => $subtitle, 'video' => $video, 'type' => $type, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateImg($id, $img) {
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE voix_off SET img = :img WHERE id = :id;');
		$query->execute(array('img' => $img, 'id' => $id));
		$pdo->catchError($query);
	}
	
	public static function get($id) {
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, title, subtitle, type, img, son, video, status FROM voix_off WHERE id = :id;', array( 'id' => $id ));
	}
	
	public static function getAll($valid=0) {
		$pdo = MyPDO::getInstance();
		
		$where	= '1=1';
		$values	= array();
		if($valid) {
			$where	= 'status = :status';
			$values	= array('status' => self::STATUS_ONLINE);
		}
		
		$resultSet = $pdo->selectAll('SELECT id, title, subtitle, type, img, son, video, status FROM voix_off WHERE '.$where.';', $values);
		return parent::getResultSetGroupByType($resultSet, array('ecouter', 'voir'));
	}
	
	public static function getValid() {
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM voix_off WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
		
	public static function delFile($id, $delete) {
		$pdo	= MyPDO::getInstance();
		
		// Récupère le fichier a supprimer
		$file	= $pdo->selectOne('SELECT id, '.$delete.' FROM voix_off WHERE id = :id;', array('id' => $id));
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