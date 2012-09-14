<?php
use \classes\model\Page as Page;

$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$id			= isset($_GET['id'])? $_GET['id']:1;
$culture	= isset($_GET['culture'])? $_GET['culture']:'fr';
$return		= array();

// Update de la page
if( isset($_POST['action']) && $_POST['action'] == 'pageTranslate' )
	$return = \classes\model\Page::setTranslation($id, $_POST);

$oPage				= \classes\model\Page::get($id);
$oPageTranslate		= \classes\model\Page::get($id, $culture);

include('inc/header.inc.php');
?>
<p id="fil_ariane">
	<a href="index.php">Back office</a> > <a href="page.php">Liste des pages</a> > Editer une page <?php echo $id>0? '(#'.$id.' - '.$oPage->label.' '.$culture.')':'' ?> 
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Editer une page <?php echo $id>0? '(#'.$id.' - '.$oPage->label.' '.$culture.')':'' ?></h2>
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" id="action" value="pageTranslate" />
			<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
			<input type="hidden" name="culture" id="culture" value="<?php echo $culture ?>" />
			
			<?php echo \helpers\Helper::printReturn($return) ?>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="title">Titre</label>
					<input type="text" name="title" id="title" value="<?php echo $oPageTranslate? $oPageTranslate->title:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="meta_description">Meta Description</label>
					<input type="text" name="meta_description" id="meta_description" value="<?php echo $oPageTranslate? $oPageTranslate->meta_description:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="meta_keywords">Meta Keywords</label>
					<input type="text" name="meta_keywords" id="meta_keywords" value="<?php echo $oPageTranslate? $oPageTranslate->meta_keywords:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="status">Statut</label>
					<select name="status" id="status">
						<option value="<?php echo Page::STATUS_OFFLINE ?>" <?php echo ($oPageTranslate && $oPageTranslate->status==Page::STATUS_OFFLINE)? 'selected="selected"':'' ?>><?php echo Page::getStatus(Page::STATUS_OFFLINE) ?></option>
						<option value="<?php echo Page::STATUS_ONLINE ?>" <?php echo ($oPageTranslate && $oPageTranslate->status==Page::STATUS_ONLINE)? 'selected="selected"':'' ?>><?php echo Page::getStatus(Page::STATUS_ONLINE) ?></option>
						<option value="<?php echo Page::STATUS_ARCHIVED ?>" <?php echo ($oPageTranslate && $oPageTranslate->status==Page::STATUS_ARCHIVED)? 'selected="selected"':'' ?>><?php echo Page::getStatus(Page::STATUS_ARCHIVED) ?></option>
					</select>
				</div>
			</div>
			<div class="clear"></div>
						
			<p class="w100 clearfix">
				<input type="submit" name="submit" id="submit" class="button btn_submit" value="Valider" />
			</p>
		</form>
		<hr/>
		
		<?php include('inc/module_editor.inc.php'); ?>
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>

<?php
include('inc/footer.inc.php');