<?php
class Configuration extends Common {
	
	const UPLOAD_DIR	= 'uploads/configuration/';
	
	public static function set($id, $values, $img=null) {
		$pdo = MyPDO::getInstance();
				
		if($id == 0)
			$id = self::insert($values);
		else
			self::update($id, $values);
		
		// Upload image
		$img_link = "";
		if($img!=null && $img['name']) {
			$img_link = Upload::uploadFile($id, $img, '../'.self::UPLOAD_DIR);
			Upload::createMiniature('../'.self::UPLOAD_DIR.$id.'/'.$img_link);
			self::updateImg($id, $img_link);
		}
		
		return $id;
	}
	
	public static function insert($values) {
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO configuration(font_family, font_size, font_color, h1_size, h2_size, h3_size, h4_size, h5_size, background, color1, color2) VALUES (:font_family, :font_size, :font_color, :h1_size, :h2_size, :h3_size, :h4_size, :h5_size, :background, :color1, :color2);');
		$query->execute(array( 'font_family' => $font_family, 'font_size' => $font_size, 'font_color' => $font_color, 'h1_size' => $h1_size, 'h2_size' => $h2_size, 'h3_size' => $h3_size, 'h4_size' => $h4_size, 'h5_size' => $h5_size, 'background' => $background, 'color1' => $color1, 'color2' => $color2 ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values) {
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE configuration SET font_family = :font_family, font_size = :font_size, font_color = :font_color, h1_size = :h1_size, h2_size = :h2_size, h3_size = :h3_size, h4_size = :h4_size, h5_size = :h5_size, background = :background, color1 = :color1, color2 = :color2 WHERE id = :id;');
		$query->execute(array( 'font_family' => $font_family, 'font_size' => $font_size, 'font_color' => $font_color, 'h1_size' => $h1_size, 'h2_size' => $h2_size, 'h3_size' => $h3_size, 'h4_size' => $h4_size, 'h5_size' => $h5_size, 'background' => $background, 'color1' => $color1, 'color2' => $color2, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateImg($id, $img) {
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE configuration SET img = :img WHERE id = :id;');
		$query->execute(array('img' => $img, 'id' => $id));
		$pdo->catchError($query);
	}
	
	public static function get($id) {
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, font_family, font_size, font_color, h1_size, h2_size, h3_size, h4_size, h5_size, background, color1, color2 FROM configuration WHERE id = :id;', array( 'id' => $id ));
	}
	
	public static function getAll($valid=0) {
		$pdo = MyPDO::getInstance();
		
		$where	= '1=1';
		$values	= array();
		if($valid) {
			$where	= 'status = :status';
			$values	= array('status' => self::STATUS_ONLINE);
		}
		
		$resultSet = $pdo->selectAll('SELECT id, font_family, font_size, font_color, h1_size, h2_size, h3_size, h4_size, h5_size, background, color1, color2 FROM configuration WHERE '.$where.';', $values);
		return parent::getResultSetGroupByType($resultSet, array('ecouter', 'voir'));
	}
	
	public static function getValid() {
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM configuration WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
		
	public static function delFile($id, $delete) {
		$pdo	= MyPDO::getInstance();
		
		// Récupère le fichier a supprimer
		$file	= $pdo->selectOne('SELECT id, '.$delete.' FROM configuration WHERE id = :id;', array('id' => $id));
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