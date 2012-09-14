<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

include('inc/header.inc.php');

$menus		= \classes\model\Menu::getAll();
$cultures	= \classes\model\Culture::getAll(1);
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > Page
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Gestion des menus</h2>
		
		<table class="table_admin">
			<tr>
				<th>#</th>
				<th>Titre</th>
				<th>Langues</th>
			</tr>
			<?php foreach($menus as $key => $oMenu): ?>
				<tr class="lign<?php echo $key%2 ?>" id="tr_<?php echo $oMenu->id ?>">
					<td><?php echo $oMenu->id ?></td>
					<td><?php echo ucfirst($oMenu->title) ?></td>
					<td>
						<?php foreach($cultures as $oCulture): ?>
							<a href="menu_lang.php?menu=<?php echo $oMenu->id ?>&culture=<?php echo $oCulture->id ?>">
								<img src="<?php echo BASE_DIR ?>img/flag/24/<?php echo $oCulture->id ?>.png" alt="<?php echo $oCulture->id ?>" title="<?php echo $oCulture->label ?>" />
							</a>
						<?php endforeach ?>
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