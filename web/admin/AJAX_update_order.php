<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$class = '\classes\model\\'.$_POST['class'];
if(!class_exists($class))
	die('This class doesn\'t exists');
if(!method_exists($class, 'updateOrder'))
	die('This method doesn\'t exists');

if(isset($_POST['action']) && $_POST['action'] == "updateListeOrder")
{
	foreach($_POST[$_POST['item']] as $order => $id)
		$class::updateOrder($id, $order);
}