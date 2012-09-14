<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include(__DIR__.'/../inc/inc.php');

$page	= isset($_GET['page'])? $_GET['page']:0;
$lang	= isset($_GET['lang'])? $_GET['lang']:'';

$moteurCMS = new cms\Moteur($page, $lang);
$moteurCMS->toString();