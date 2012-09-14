<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$menu		= isset($_GET['menu'])? $_GET['menu']:1;
$culture	= isset($_GET['culture'])? $_GET['culture']:'fr';
$return		= array();

$menu_items	= \classes\model\MenuItem::getAll($menu, $culture);
$oMenu		= \classes\model\Menu::get($menu);

include('inc/header.inc.php');
?>
<p id="fil_ariane">
	<a href="index.php">Back office</a> > <a href="menu.php">Editer les menus</a> > Menu <?php echo $oMenu->title ?> 
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Editer le menu <?php echo $oMenu->title ?></h2>
		
		<a href="edit_menu_lang.php?menu=<?php echo $oMenu->id ?>&culture=<?php echo $culture ?>" class="fright bouton icn-add">Ajouter un élément</a>
		<div class="clear"></div>
		
		<table class="table_admin orderItem">
			<tr>
				<th>Ordre</th>
				<th>#</th>
				<th>Titre</th>
				<th>Statut</th>
				<th>Actions</th>
			</tr>
			<?php foreach($menu_items as $key => $oMenuItem): ?>
				<tr class="lign<?php echo $key%2 ?>" id="tr_<?php echo $oMenuItem->id ?>">
					<td class="orderItemControl"></td>
		            <td><?php echo $oMenuItem->id ?></td>
					<td><?php echo $oMenuItem->title ?></td>
					<td><?php echo \classes\model\MenuItem::getStatus($oMenuItem->status) ?></td>
					<td>
						<a href="edit_menu_lang.php?menu=<?php echo $oMenu->id ?>&culture=<?php echo $culture ?>&id=<?php echo $oMenuItem->id ?>" class="icones icn-edit" title="Editer">Editer</a>
						<a href="javascript:void(0);" class="icones icn-del delete" rel="<?php echo $oMenuItem->id ?>" title="Supprimer">Supprimer</a>
					</td>
				</tr>
			<?php endforeach ?>
		</table>
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>

<script>
$("document").ready(function() {
	// Order by
	$(".orderItem tbody").orderItem({
		"class":	'MenuItem',
		'item':		'tr'
	});

	// Delete
	$(".delete").deleteItem({
		name: 'Elément de menu',
		"class": 'MenuItem'
	});
})
</script>

<?php
include('inc/footer.inc.php');