<?php
namespace classes\model;
use \MyPDO as MyPDO;

class User {

	function exiteUser($login, $password) {
		$myPDO = MyPDO::getInstance();
		$user = $myPDO->select("SELECT id FROM `user` WHERE login = :login AND password = :password;", array('login'=>$login, 'password'=>md5(sha1($password))));
		
		return (is_object($user))? $user->id:0;
	}
	function connectUser($login, $password, $boolCookie=null) {
		$user_id = $this->exiteUser($login, $password);
		if($user_id != 0) {
			$this->sessionOpen($user_id);
			if($boolCookie)
				$this->cookieOpen($user_id);
				
			return true;
		}
		else {
			return false;
		}
	}
	function disconnectUser($id_user) {
		sessionClose();
	}
	
// Session \\
	function sessionOpen($id_user) {
		$_SESSION['id_user'] = $id_user;

		return true;
	}
		
	function sessionClose() {
		session_destroy();
		session_start();
		$this->cookieClose();
	}
// Cookies \\
	function cookieOpen($id_user) {
		setcookie('user_id', $_SESSION['id_user'], (time() + 360000));
	}
	function cookieClose() {
		//setcookie("user_id", "0", 0, "/", "", 0);
		setcookie('user_id');
	}
	
}
?>