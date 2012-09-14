<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$export	= isset($_GET['export'])?	$_GET['export']:null;
if($export==null)
	die("error: manager not found");


header("Content-Type: application/csv-tab-delimited-table; charset=iso-8859-1");
header("Content-disposition: filename=".date("Ymd")."_export.csv");

include_once(__DIR__.\cms\Moteur::MODULE_DIR.$export.'/module.class.php');
$class = 'Module'.$export;
$module = new $class();
echo $module->export();

exit;