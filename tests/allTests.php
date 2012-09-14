<?php
require_once 'PHPUnit/TextUI/TestRunner.php';
require_once 'userTest.class.php';

if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'AllTests::main');
}

class AllTests
{
    public static function main()
    {
        PHPUnit_TextUI_TestRunner::run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit_Framework_TestSuite('All Tests');
        $suite->addTest(UserTest::main());
    }
}

if (PHPUnit_MAIN_METHOD == 'AllTests::main') {
   AllTests::main();
}