<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

include('inc/header.inc.php');

$newModules		= \cms\Module::getNotInstalled();
$newTemplates	= \cms\Template::getNotInstalled();
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > <span>Page d'accueil</span>
</p>

<div id="content" class="clearfix">
	<section>
		<h2>PAGE D'ACCUEIL</h2>
		<p>
			Bienvenue dans votre espace d'administration de votre site mobile.
		</p>
		
		<?php
		if(count($newModules)>0)
			echo \helpers\Helper::printReturn(array('warning' => 'Des modules ne demandent qu\'à être installés<br/><a href="component.php">cliquez ici</a>'));
		
		if(count($newTemplates)>0)
			echo \helpers\Helper::printReturn(array('warning' => 'Des templates ne demandent qu\'à être installés<br/><a href="component.php">cliquez ici</a>'));
		?>
	</section>
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>

<?php
include('inc/footer.inc.php');