<?php
require_once(__DIR__.'/../../lib/helpers/global.helper.php');

class GlobalTest extends PHPUnit_Framework_TestCase {
	
	public function setUp() {}
	public function tearDown() {}
	
    public function testCheckEmail() {
		$this->assertTrue(Helper::checkEmail('yr@mmcreation.com') !== false);
	}
	
	public function testGetPagination() {
		//getPagination($href, $nbPage, $current)
		$this->assertEquals(Helper::getPagination('test', 0, ''), '');
		$this->assertEquals(Helper::getPagination('test', 1, ''), '');
		$this->assertFalse(Helper::getPagination('test', 2, 2) == '');
	}
	
	public function testGetMilitedText() {
		//getMilitedText($text, $limit)
		$this->assertEquals(Helper::getMilitedText('testtesttesttesttesttesttesttesttesttesttesttesttest', 4), 'test ...');
	}
	
	// Retourne une chaine sans les caratères html
 	public function testGetFiltredText() {
 		//getFiltredText($string)
 		$this->assertEquals(Helper::getFiltredText('<script>test</script><balise>test<blaise>'), 'testtest');
	}
    
}