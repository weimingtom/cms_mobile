<?php
$cd = '../';
$return = array();

if( isset($_POST['action']) && $_POST['action']=='setup' )
{
	extract($_POST);	
	
	// Init fichier config
	$fileSource	= __DIR__.'/config.ini.php';
	$fileDest	= __DIR__.'/../../config/config.inc.php';
	$config = file_get_contents($fileSource);
	$config = str_replace('[[DB_BASE]]',		'mysql',		$config);
	$config = str_replace('[[DB_HOST]]',		$host,			$config);
	$config = str_replace('[[DB_NAME]]',		$name,			$config);
	$config = str_replace('[[DB_USER]]',		$user,			$config);
	$config = str_replace('[[DB_PASSWORD]]',	$password,		$config);
	$config = str_replace('[[HTTP_HOST]]',		$virtualHost,	$config);
	$hd			= fopen($fileDest, "w") or die('Cannot open file');
	fwrite($hd, $config);
	fclose($hd);
	
	
	include($cd.'../inc/inc.php');
	// Execute script sql
	new \helpers\ImportSqlFile('script.sql');
	$return['valid'] = 'Votre configuration a bien été enregistrée';
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>CMS Mobile | SETUP</title>
		<meta charset="UTF-8">
		<meta name="robots" content="no-index,no-follow" />
		
		<script src="<?php echo $cd ?>js/jquery-1.7.min.js"></script>
		<script src="<?php echo $cd ?>js/modernizr.custom.72008.js"></script>
		
		<link rel="stylesheet" href="<?php echo $cd ?>css/admin.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<header>
				<img src="<?php echo $cd ?>img/logo_mmc.gif" alt="" />
			</header>
			
			<h1>Configuration Générale</h1>
			<?php if(isset($return['valid']) && !empty($return['valid'])): ?>
				<p>
					<?php echo \helpers\Helper::printReturn($return) ?>
					Vous pouvez maintenant accéder à votre site mobile.
				</p>
				<p>
					<a href="../" target="_blank">Accéder au site</a><br/>
					<a href="../admin/" target="_blank">Accéder à l'admin</a>
				</p>
			<?php else: ?>
				<p>Bienvenue sur notre CMS Mobile.</p>
				<?php if(isset($return['error']) && $return['error']>0): ?>
                	<?php echo \helpers\Helper::printReturn($return); ?>
                <?php endif; ?>
				<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
					<input type="hidden" name="action" id="action" value="setup" />
					
					<h2>Base de données</h2>
					<div class="fleft w50 first">
						<div class="form_fields">
							<label for="host">Hôte</label>
							<input type="text" name="host" id="host" value="<?php echo isset($host)? $host:'localhost'; ?>" />
						</div>
					</div>
					<?php $host = explode('/', $_SERVER['REQUEST_URI']); ?>
					<div class="fleft w50">
						<div class="form_fields">
							<label for="name">Nom</label>
							<input type="text" name="name" id="name" value="<?php echo isset($name)? $name:$host[1]; ?>" />
						</div>
					</div>
					<div class="clear"></div>
					
					<div class="fleft w50 first">
						<div class="form_fields">
							<label for="user">Utilisateur</label>
							<input type="text" name="user" id="user" value="<?php echo isset($user)? $user:''; ?>" />
						</div>
					</div>
					<div class="fleft w50">
						<div class="form_fields">
							<label for="password">Password</label>
							<input type="text" name="password" id="password" value="<?php echo isset($password)? $password:''; ?>" />
						</div>
					</div>
					<div class="clear"></div>
					
					<h2>Serveur</h2>
					<div class="w50 first">
						<div class="form_fields">
							<label for="virtualHost">Hôte</label>
							<input type="text" name="virtualHost" id="virtualHost" value="<?php echo isset($virtualHost)? $virtualHost:$host[1].'/'; ?>" />
						</div>
					</div>
					
					<p class="w100 clearfix">
						<input type="submit" name="submit" id="submit" class="button btn_submit" value="Valider" />
					</p>
				</form>
			<?php endif ?>
						
			<footer>
				&copy; Copyright [[CLIENT]]. Tous droits réservés- Design by <a target="_blank" href="http://www.mmcreation.com">MMCréation</a> <?php echo date("Y") ?>
			</footer>
		</div> <!-- END div #container -->
	</body>
</html>