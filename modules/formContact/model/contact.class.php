<?php
class Contact extends \classes\model\Common
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
		$query = $pdo->prepare('INSERT INTO module_contact(culture, lastname, firstname, email, phone, company, object, content, date_inscription, status) VALUES (:culture, :lastname, :firstname, :email, :phone, :company, :object, :content, NOW(), :status);');
		$query->execute(array( 'culture' => $culture, 'lastname' => $lastname, 'firstname' => $firstname, 'email' => $email, 'phone' => $phone, 'company' => $company, 'object' => $object, 'content' => $content, 'status' => self::STATUS_OFFLINE ));
		$pdo->catchError($query);
		
		return $pdo->lastInsertId();
	}
	
	public static function update($id, $values)
	{
		extract($values);
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('UPDATE module_contact SET culture = :culture, email = :email, status = :status WHERE id = :id;');
		$query->execute(array( 'culture' => $culture, 'lastname' => $lastname, 'firstname' => $firstname, 'email' => $email, 'phone' => $phone, 'company' => $company, 'object' => $object, 'content' => $content, 'status' => self::STATUS_OFFLINE, 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function get($id)
	{
		$pdo = MyPDO::getInstance();
		return $pdo->selectOne('SELECT id, culture, lastname, firstname, email, phone, company, object, content, date_inscription, status FROM module_contact WHERE id = :id;', array( 'id' => $id ));
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
		
		return $pdo->selectAll('SELECT id, culture, lastname, firstname, email, phone, company, object, content, date_inscription, status FROM module_contact WHERE '.$where.';', $values);
	}
	
	public static function getValid()
	{
		return self::getAll(1);
	}
	
	public static function del($id)
	{	
		$pdo = MyPDO::getInstance();
		$query = $pdo->prepare('DELETE FROM module_contact WHERE id = :id;');
		$query->execute(array( 'id' => $id ));
		$pdo->catchError($query);
	}
	
	public static function sendEmail($values, $dest)
	{
		extract($values);
		$email_body       = file_get_contents(__DIR__.'/../email/contact.mail.html');
		$email_body       = str_replace('[[FIRSTNAME]]',	$firstname,				$email_body);		
		$email_body       = str_replace('[[LASTNAME]]',		$lastname,				$email_body);
		$email_body       = str_replace('[[CULTURE]]',		$culture,				$email_body);
		$email_body       = str_replace('[[EMAIL]]',		$email,					$email_body);
		$email_body       = str_replace('[[PHONE]]',		$phone,					$email_body);
		$email_body       = str_replace('[[COMPANY]]',		$company,				$email_body);
		$email_body       = str_replace('[[OBJECT]]',		$object,				$email_body);
		$email_body       = str_replace('[[CONTENT]]',		$content,				$email_body);
		
		// Envoi du mail de contact
		include(__DIR__.'/../../../lib/classes/phpmailer.class.php');
		$mail = new phpmailer();
		$mail->IsHTML(true);
		$mail->Subject	= 'mail contact site mobile';
		$mail->AddAddress($dest);
		$mail->FromName	= $firstname;
		$mail->From		= $email;
		$mail->Body		= $email_body;
		$mail->Send();
	}
	
}