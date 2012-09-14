<?php
// Session
session_start();



// Fichier de configuration
if(!file_exists(__DIR__.'/../config/config.inc.php'))
{
	header('location:setup');
	exit();
}
include(__DIR__.'/../config/config.inc.php');



// Include
include('internationalisation.inc.php');
include(__DIR__.'/../lib/classes/myPDO.class.php');
include(__DIR__.'/../lib/classes/exception.class.php');
// Autoload
function __autoload($class_name) {
	// Class classics
	// ex: MyPDO		=> myPDO.class.php
	if(myAutoload($class_name))
		return true;
	
	// Class with "_"
	// ex: ModuleItem	=> module_item.class.php
	$class_name = preg_replace("/([A-Z])/", "_$1", $class_name); // Ajoute le '_' devant les maj
	$pos = strpos($class_name, '_'); // Supprime le 1er caractères '_'
	if($pos !== false)
		$class_name = substr($class_name, 0, $pos).substr($class_name, $pos+1);
	
	myAutoload($class_name);
}
// myAutoload
function myAutoload($class_name) {
	$path = __DIR__.'/../lib/'.str_replace('\\', DIRECTORY_SEPARATOR, strtolower($class_name)).'.class.php';
	//echo $path.'<br/>';
	if(!file_exists($path))
		return false;
	
	require_once($path);
	return true;
}



// Gestionnaire d'erreurs
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
	if (!(error_reporting() & $errno)) {
		// Ce code d'erreur n'est pas inclus dans error_reporting()
		return;
	}

	$email_body = '<p>Une erreur est survennue lors de l\'exécution du CMS :</p>';
	switch($errno) {
		case E_USER_ERROR:
			$email_body .= '<b>ERROR !!</b> ['.$errno.'] '.$errstr.'<br />';
			$email_body .= '  Fatal Error on ligne '.$errline.' in file '.$errfile;
			$email_body .= ', PHP '.PHP_VERSION.' ('.PHP_OS.')<br />';
			break;
		case E_USER_WARNING:
			$email_body .= '<b>WARNING</b> ['.$errno.'] '.$errstr.'<br />';
			break;
		case E_USER_NOTICE:
			$email_body .= '<b>NOTICE</b> ['.$errno.'] '.$errstr.'<br />';
			break;
		default:
			$email_body .= 'UNKNOW ERROR : ['.$errno.'] '.$errstr.'<br />';
			break;
	}
	
	// Envoi du mail
	include(__DIR__.'/../lib/classes/phpmailer.class.php');
	$mail = new phpmailer();
	$mail->IsHTML(true);
	$mail->Subject	= 'Mail Auto -> Error CMS Mobile '.$_SERVER['VIRTUAL_ROOT'].' !';
	$mail->AddAddress('yr@mmcreation.com');
	$mail->FromName	= 'CMS Mobile';
	$mail->From		= 'no-replay@cms-mobile.fr';
	$mail->Body		= $email_body;
	$mail->Send();
	
	// Ne pas exécuter le gestionnaire interne de PHP
	return true;
}
// Configuration du gestionnaire d'erreurs
//$old_error_handler = set_error_handler('myErrorHandler');

// Liste des includes dans toutes les pages
$page = array();
$page['js']		= array();
$page['css']	= array(
	'main'		=> 'main.css'
);
$page['header'] = array();