<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$manager	= isset($_GET['manager'])?	$_GET['manager']:null;
if($manager==null)
	die("error: manager not found");

include_once(__DIR__.\cms\Moteur::MODULE_DIR.$manager.'/module.class.php');
$class = 'Module'.$manager;
$module = new $class();

include('inc/header.inc.php');
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > Manager > <?php echo $module::TITLE ?>
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Manager <?php echo $module::TITLE ?></h2>
		
		<?php echo $module->manager($_POST) ?>
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>
	
<?php
include('inc/footer.inc.php');