<?php
// Redirige vers la page de login si pas logé
if(empty($_SESSION['id_user']) && empty($_COOKIE['user_id']))
{
	header('Location: login.php');
	exit;
}

define('IS_ADMIN', 1);