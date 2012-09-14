<?php
switch($_SERVER['HTTP_HOST']) {
	case 'localhost':
		//DB data
		define('DB_BASE',		'[[DB_BASE]]');
		define('DB_HOST',		'[[DB_HOST]]');
		define('DB_NAME',		'[[DB_NAME]]');
		define('DB_USER',		'[[DB_USER]]');
		define('DB_PASSWORD',	'[[DB_PASSWORD]]');

		$_SERVER['VIRTUAL_ROOT'] = 'http://localhost/[[HTTP_HOST]]';
		break;

	case '[[HTTP_HOST]]':
	default:
		//DB data
		define('DB_BASE',		'[[DB_BASE]]');
		define('DB_HOST',		'[[DB_HOST]]');
		define('DB_NAME',		'[[DB_NAME]]');
		define('DB_USER',		'[[DB_USER]]');
		define('DB_PASSWORD',	'[[DB_PASSWORD]]');

		$_SERVER['VIRTUAL_ROOT'] = 'http://[[HTTP_HOST]]';
		break;
}

define('BASE_DIR', 		'../');
define('ROOTPATH', 		__DIR__.'/../');

define('JS_DIR', 		'js/');
define('CSS_DIR', 		'css/');
define('IMG_DIR',	 	'img/');
define('EXPOR_DIR',		'export/');
define('EMAIL_DIR',		'emails/');
define('UPLOAD_DIR',	'uploads/');

define('TEMPLATE_DIR',	'templates/');
define('MODULE_DIR',	'modules/');




define('VALID_TEXT',	'Vos modifications ont été prises en comptes.');