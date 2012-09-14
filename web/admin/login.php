<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/header.inc.php');

$return = array();
if( !empty($_POST['submit']) and !empty($_POST['submit']) ) {
	include(__DIR__.'/../../lib/classes/model/user.class.php');
	$user = new \classes\model\User();
	
	$remember_me = (isset($_POST['remember_me']))? $_POST['remember_me']:NULL;
	if( $user->connectUser($_POST['login'], $_POST['password'], $remember_me) )
		header('Location: index.php');
	else 
		$return['error'] = array('Le nom d\'utilisateur et/ou le mot de passe que vous avez saisi est incorrect.');
}
?>

<h2>Login</h2>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<?php if(isset($return)): ?>
		<?php echo \helpers\Helper::printReturn($return) ?>
	<?php endif ?>
		
	<div class="fleft w50 first">
		<div class="form_fields">
			<label for="login">Login</label>
			<input type="text" name="login" id="login" value="<?php echo isset($_POST['login'])? $_POST['login']:''; ?>" />
		</div>
	</div>
	<div class="fleft w50">
		<div class="form_fields">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" value="<?php echo isset($_POST['password'])? $_POST['password']:''; ?>" />
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="w50">
		<div class="form_fields">
			<label for="remember_me">Se souvenir de moi ?</label>
			<input type="checkbox" name="remember_me" id="remember_me" value="1"<?php echo (isset($_POST['remember_me']) && $_POST['remember_me']==1)? 'checked="checked"':''; ?> />
		</div>
	</div>
	<div class="clear"></div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit" class="button btn_submit" value="Valider" />
	</p>
</form>

<?php 
include('inc/footer.inc.php');