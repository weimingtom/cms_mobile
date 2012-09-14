<?php
require_once(__DIR__.'/../../lib/classes/user.class.php');
require_once(__DIR__.'/../../lib/classes/myPDO.class.php');

class UserTest extends PHPUnit_Framework_TestCase {
	
	public function setUp() {
	}
	public function tearDown() {
	}
	
	function testExiteUser() {
		//exiteUser($login, $password)
		$this->assertFalse(User::exiteUser('test', 'test'));
		$this->assertTrue(User::exiteUser('admin', 'admin'));
	}
	
	/*function testConnectUser() {
		//connectUser($login, $password, $boolCookie=null)
		$this->assertFalse(User::connectUser('test', 'test'));
		$this->assertTrue(User::connectUser('admin', 'admin'));
	}*/
	function testDisconnectUser() {
		//disconnectUser($id_user)
		$this->assertNull(User::disconnectUser(1));
	}
	
	// Session \\
	function testSessionOpen() {
		//sessionOpen($id_user)
		$this->assertTrue(User::sessionOpen(1));
	}
		
	function testSessionClose() {
		//sessionClose()
		$this->assertNull(User::sessionClose());
	}
	
	// Cookies \\
	function testCookieOpen() {
		//cookieOpen($id_user)
		$this->assertNull(User::cookieOpen(1));
	}
	function testCookieClose() {
		//cookieClose()
		$this->assertNull(User::cookieClose());
	}
		
}