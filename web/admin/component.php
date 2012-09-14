<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

include('inc/header.inc.php');

$return = array();

// Install
if(isset($_GET['title']) && $_GET['title']!='' && isset($_GET['component']) && in_array($_GET['component'], array('module', 'template')))
{
	if($_GET['component'] == 'module')
		$return['module']	= \cms\Module::install($_GET['title']);
	else
		$return['template']	= \cms\Template::install($_GET['title']);
	
	//print_r($return);
}

$newModules		= \cms\Module::getNotInstalled();
$newTemplates	= \cms\Template::getNotInstalled();
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > Composants
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Gestion des composants (modules / templates)</h2>	
		
		<h3>Modules</h3>
		<?php if(isset($return['module'])): ?>
			<?php echo \helpers\Helper::printReturn($return['module']) ?>
		<?php endif ?>
		<table class="table_admin">
			<tr>
				<th>Titre</th>
				<th>Actions</th>
			</tr>
			<?php foreach($newModules as $key => $module): ?>
				<tr class="lign<?php echo $key%2 ?>">
					<td><?php echo $module ?></td>
					<td>
						<a href="component.php?title=<?php echo $module ?>&component=module" class="icones icn-install" title="Installer">Installer</a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
		
		<h3>Templates</h3>
		<?php if(isset($return['template'])): ?>
			<?php echo \helpers\Helper::printReturn($return['template']) ?>
		<?php endif ?>
		<table class="table_admin">
			<tr>
				<th>Titre</th>
				<th>Actions</th>
			</tr>
			<?php foreach($newTemplates as $key => $template): ?>
				<tr class="lign<?php echo $key%2 ?>">
					<td><?php echo $template ?></td>
					<td>
						<a href="component.php?title=<?php echo $template ?>&component=template" class="icones icn-install" title="Installer">Installer</a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>

<script type="text/javascript">
$(document).ready(function() {
	$(".delete").deleteItem({
		name: 'Page',
		"class": 'Page'
	});
});
</script>

<?php
include('inc/footer.inc.php');