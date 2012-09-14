<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');


include('inc/header.inc.php');
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > Page
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Pages du site</h2>

		<a href="edit_page.php" class="fright bouton icn-add">Ajouter une Page</a>
		<div class="clear"></div>
		
		<table class="table_admin">
			<tr>
				<th>#</th>
				<th>Titre</th>
				<th>Home</th>
				<th>404</th>
				<th>Actions</th>
			</tr>
			<?php foreach(\classes\model\Page::getAll() as $key => $oPage): ?>
				<tr class="lign<?php echo $key%2 ?>" id="tr_<?php echo $oPage->id ?>">
					<td><?php echo $oPage->id ?></td>
					<td><?php echo $oPage->label ?></td>
					<td align="center"><?php echo $oPage->is_home? '<img src="'.BASE_DIR.'img/admin/icn-valid.png" alt="" />':'X' ?></td>
					<td align="center"><?php echo $oPage->is_404? '<img src="'.BASE_DIR.'img/admin/icn-valid.png" alt="" />':'X' ?></td>
					<td>
						<a href="edit_page.php?id=<?php echo $oPage->id ?>" class="icones icn-edit" title="Editer">Editer</a>
						<a href="javascript:void(0);" class="icones icn-del delete" rel="<?php echo $oPage->id ?>" title="Supprimer">Supprimer</a>
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