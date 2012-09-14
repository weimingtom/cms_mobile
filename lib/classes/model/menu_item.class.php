<?php
namespace classes\model;
use \MyPDO as MyPDO;

class MenuItem extends Common
{
	
	const UPLOAD_DIR	= 'uploads/menu_item/';
	
	const EXTERNAL_URL	= 0;
	const INTERNAL_URL	= 1;
	
	public static function set($id, $values, $img=null)
	{
		extract($values);
		
		// Gestion des url
		$values['external_url']	= isset($values['external_url'])? $values['external_url']:0;
		$values['url']			= ($values['external_url']==1)? $values['url_externe']:'';
		$values['id_page_dest']	= ($values['external_url']==0)? $values['url_interne']:'';
		
		if($id == 0)
			$id = self::insert($values);
		else
			self::update($id, $values);
		
		// Upload image
		$img_link = "";
		if($img!=null && $img['name']) {
			$img_link = \classes\Upload::uploadFile($id, $img, '../'.self::UPLOAD_DIR);
			self::updateImg($id, $img_link);
		}
		
		return $id;
	}
	
	public static function insert($values)
	{
		extract($values);
		
		$order = self::getNextOrder($culture);
		
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('INSERT INTO menu_item(fk_menu, culture, title, blank, url, external_url, id_page_dest, `order`, status) VALUES (:fk_menu, :culture, :title, :blank, :url, :external_url, :id_page_dest, :order, :status);');
		$query->execute(array( 'fk_menu' => $fk_menu, 'culture' => $culture, 'title' => $title, 'blank' => $blank, 'url' => $url, 'external_url' => $external_url, 'id_page_dest' => $id_page_dest, 'order' => $order, 'status' => $status ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE menu_item SET fk_menu = :fk_menu, culture = :culture, title = :title, blank = :blank, url = :url, external_url = :external_url, id_page_dest = :id_page_dest, status = :status WHERE id = :id;');
		$query->execute(array( 'fk_menu' => $fk_menu, 'culture' => $culture, 'title' => $title, 'blank' => $blank, 'url' => $url, 'external_url' => $external_url, 'id_page_dest' => $id_page_dest, 'status' => $status, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function updateImg($id, $img)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE menu_item SET img = :img WHERE id = :id;');
		$query->execute(array('img' => $img, 'id' => $id));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, fk_menu, culture, title, img, blank, url, external_url, id_page_dest, status FROM menu_item WHERE id = :id ORDER BY `order`;', array( 'id' => $id ));
	}
	
	public static function getAll($menu, $culture, $valid=0)
	{
		$pdo = MyPDO::getInstance();
		
		$where	= 'fk_menu = :menu AND culture = :culture';
		$values	= array('menu' => $menu, 'culture' => $culture);
		if($valid) {
			$where	.= ' AND status = :status';
			$values['status']	= self::STATUS_ONLINE;
		}
		
		return $pdo->selectAll('SELECT id, fk_menu, culture, title, img, blank, url, external_url, id_page_dest, status FROM menu_item WHERE '.$where.' ORDER BY `order`;', $values);
	}
	
	public static function getValid($menu, $culture)
	{
		return self::getAll($menu, $culture, 1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM menu_item WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
		
	public static function delFile($id, $delete)
	{
		$pdo	= MyPDO::getInstance();
		
		// Récupère le fichier a supprimer
		$file	= $pdo->selectOne('SELECT id, '.$delete.' FROM menu_item WHERE id = :id;', array('id' => $id));
		// Supprime du disque le fichier
		@unlink('../'.self::UPLOAD_DIR.$file->id.'/'.$file->$delete);
		@unlink('../'.self::UPLOAD_DIR.$file->id.'/mini-'.$file->$delete);
		// Supprime le fichier de la base
		if($delete=='img')
			self::updateImg($id, null);
		else
			self::updateSon($id, null);
	}
	
	public static function getNextOrder($culture)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->selectOne('SELECT (MAX(`order`)+1) next_order FROM `menu_item` WHERE culture = :culture;', array( 'culture' => $culture ));
		
		return $query->next_order>0? $query->next_order:1;
	}
	public static function updateOrder($id, $order)
	{
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE menu_item SET `order` = :order WHERE id = :id;');
		$query->execute(array( 'order' => $order, 'id' => $id ));
		$pdo->catchError($query);
	}
	
}