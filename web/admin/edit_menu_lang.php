<?php
use \classes\model\MenuItem as MenuItem;

$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$id			= isset($_GET['id'])? $_GET['id']:0;
$menu		= isset($_GET['menu'])? $_GET['menu']:1;
$culture	= isset($_GET['culture'])? $_GET['culture']:'fr';
$return		= array();

// Delete image
if(isset($_GET['delete']) && $_GET['delete']=='img')
	MenuItem::delFile($id, $_GET['delete']);

// Traitenement du formulaire
if(isset($_POST['action']) && $_POST['action'] == 'MenuItem')
{
	$img			= isset($_FILES['img'])? $_FILES['img']:null;
	$_POST['blank'] = isset($_POST['blank'])? $_POST['blank']:0;
	$id = MenuItem::set($id, $_POST, $img);
	$return['valid']	= VALID_TEXT;
}

$oMenu		= \classes\model\Menu::get($menu);
if($id>0)
	$oMenuItem	= MenuItem::get($id);

include('inc/header.inc.php');
?>
<p id="fil_ariane">
	<a href="index.php">Back office</a> > <a href="menu.php">Editer les menus</a> > Menu <?php echo $oMenu->title ?> 
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Editer un élément du menu <?php echo $oMenu->title ?></h2>
		
		<a href="menu_lang.php?menu=<?php echo $oMenu->id ?>&culture=<?php echo $culture ?>" class="fright bouton icn-back">Retour</a>
		<div class="clear"></div>
			
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" id="action" value="MenuItem" />
			<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
			<input type="hidden" name="fk_menu" id="fk_menu" value="<?php echo $menu ?>" />
			<input type="hidden" name="culture" id="culture" value="<?php echo $culture ?>" />
			
			<?php echo \helpers\Helper::printReturn($return) ?>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="title">Titre</label>
					<input type="text" name="title" id="title" value="<?php echo isset($oMenuItem)? $oMenuItem->title:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="url">Url Destination</label>
					<div>
						Externe ? <input type="checkbox" name="external_url" id="external_url" value="1" <?php echo isset($oMenuItem) && $oMenuItem->external_url==1? 'checked="checked"':'' ?> />  
						<input type="text" name="url_externe" id="url_externe" value="<?php echo isset($oMenuItem)? $oMenuItem->url:'http://'; ?>" />
						<select name="url_interne" id="url_interne">
							<?php foreach(\classes\model\Page::getAll($culture) as $oPage): ?>
								<?php if($oPage->title==null) continue ?>
								<option value="<?php echo $oPage->id ?>" <?php echo isset($oMenuItem) && $oMenuItem->id_page_dest==$oPage->id? 'selected="selected"':'' ?>>
									<?php echo $oPage->title ?>
								</option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="w100">
				<div class="form_fields">
					<label for="img">Pictogramme</label>
					<input type="file" name="img" id="img" value="<?php echo isset($oMenuItem)? $oMenuItem->img:''; ?>" />
					<?php if(isset($oMenuItem) && !empty($oMenuItem->img)): ?>
						<img src="<?php echo $cd ?><?php echo MenuItem::UPLOAD_DIR ?><?php echo $oMenuItem->id ?>/<?php echo $oMenuItem->img ?>" alt="<?php echo $oMenuItem->img ?>" />
						<a href="<?php echo $_SERVER['REQUEST_URI'] ?>&delete=img" title="Delete this item"><img src="<?php echo $cd ?>img/admin/Delete.png" alt="Delete" /></a>
					<?php endif ?>
				</div>
			</div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="blank">Ouvrir dans une nouvelle fenêtre</label>
					<input type="checkbox" name="blank" id="blank" value="1" <?php echo (isset($oMenuItem) && $oMenuItem->blank==1)? 'checked="checked"':''; ?> />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="status">Statut</label>
					<select name="status" id="status">
						<option value="<?php echo MenuItem::STATUS_OFFLINE ?>" <?php echo (isset($oMenuItem) && $oMenuItem->status==MenuItem::STATUS_OFFLINE)? 'selected="selected"':'' ?>><?php echo MenuItem::getStatus(MenuItem::STATUS_OFFLINE) ?></option>
						<option value="<?php echo MenuItem::STATUS_ONLINE ?>" <?php echo (isset($oMenuItem) && $oMenuItem->status==MenuItem::STATUS_ONLINE)? 'selected="selected"':'' ?>><?php echo MenuItem::getStatus(MenuItem::STATUS_ONLINE) ?></option>
						<option value="<?php echo MenuItem::STATUS_ARCHIVED ?>" <?php echo (isset($oMenuItem) && $oMenuItem->status==MenuItem::STATUS_ARCHIVED)? 'selected="selected"':'' ?>><?php echo MenuItem::getStatus(MenuItem::STATUS_ARCHIVED) ?></option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
						
			<p class="w100 clearfix">
				<input type="submit" name="submit" id="submit" class="button btn_submit" value="Valider" />
			</p>
		</form>
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>

<script>
$("document").ready(function() {
	// Order by
	$("#orderItem").orderItem({
		"class":	'MenuItem'
	});

	// Delete
	$(".delete").deleteItem({
		name: 'Elément de menu',
		"class": 'MenuItem'
	});
	
	// Affiche ou masque les différents mode d'url
	$.fn.showHideUrl = function() {
		$("#url_externe, #url_interne").hide();
		if($(this).is(':checked'))
			$("#url_externe").show();
		else
			$("#url_interne").show();
	};
	$("#external_url").showHideUrl();
	$("#external_url").change(function() {
		$(this).showHideUrl();
	})
})
</script>

<?php
include('inc/footer.inc.php');