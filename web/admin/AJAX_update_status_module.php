<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

if(isset($_POST['id']) && intval($_POST['id']) != '')
	\classes\model\ModuleItem::updateStatus(intval($_POST['id']), intval($_POST['status']));