<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$Class = '\classes\model\\'.$_POST['class'];
if(isset($_POST['id']) && intval($_POST['id']) != '' && class_exists($Class))
	$Class::del(intval($_POST['id']));