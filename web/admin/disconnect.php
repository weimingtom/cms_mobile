<?php
$cd = '../';
include($cd.'inc/header.min.php');
include($cd.'classes/user.class.php');

$user = new \classes\model\User();
$user->sessionClose();

header('Location: index.php');