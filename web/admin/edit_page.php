<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$id		= isset($_GET['id'])? $_GET['id']:0;
$return = array();

if( isset($_POST['action']) && $_POST['action'] == 'page' ) {
	$_POST['header']	= isset($_POST['header'])? $_POST['header']:0;
	$_POST['footer']	= isset($_POST['footer'])? $_POST['footer']:0;
	$_POST['is_home']	= isset($_POST['is_home'])? $_POST['is_home']:0;
	$_POST['is_404']	= isset($_POST['is_404'])? $_POST['is_404']:0;
	
	$id = \classes\model\Page::set($id, $_POST);
	$return['valid'] = VALID_TEXT; 
}

if($id>0)
	$oPage = \classes\model\Page::get($id);

$templates = \classes\model\Template::getAll(1);

include('inc/header.inc.php');
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > <a href="page.php">Liste des pages</a> > Editer une page <?php echo $id>0? '(#'.$id.' - '.$oPage->label.')':'' ?> 
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Editer une page <?php echo $id>0? '(#'.$id.' - '.$oPage->label.')':'' ?></h2>
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" id="action" value="page" />
			<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
			
			<?php echo \helpers\Helper::printReturn($return) ?>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="label">Titre<?php echo \helpers\Helper::formatInfo('Titre de la page') ?></label>
					<input type="text" name="label" id="label" value="<?php echo isset($oPage)? $oPage->label:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="fk_template">Template</label>
					<select name="fk_template" id="fk_template">
						<?php foreach($templates as $oTemplate): ?>
							<option value="<?php echo $oTemplate->id ?>" title="<?php echo $oTemplate->title ?>"<?php echo (isset($oPage) && $oPage->fk_template==$oTemplate->id)? 'selected="selected"':''; ?>>
								<?php echo $oTemplate->title ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="header">Afficher le header</label>
					<input type="checkbox" name="header" id="header" value="1"<?php echo (isset($oPage) && $oPage->header==1)? ' checked="checked"':''; ?> />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="footer">Afficher le footer</label>
					<input type="checkbox" name="footer" id="footer" value="1"<?php echo (isset($oPage) && $oPage->footer==1)? ' checked="checked"':''; ?> />
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="is_home">Page home<?php echo \helpers\Helper::formatInfo('Cette page est-elle la home ?') ?></label>
					<input type="checkbox" name="is_home" id="is_home" value="1"<?php echo (isset($oPage) && $oPage->is_home==1)? ' checked="checked"':''; ?> />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="is_404">Page 404<?php echo \helpers\Helper::formatInfo('Cette page est-elle la page 404 ?') ?></label>
					<input type="checkbox" name="is_404" id="is_404" value="1"<?php echo (isset($oPage) && $oPage->is_404==1)? ' checked="checked"':''; ?> />
				</div>
			</div>
			<div class="clear"></div>
			
			<p class="w100 clearfix">
				<input type="submit" name="submit" id="submit" class="button btn_submit" value="Valider" />
			</p>
			
			<?php if($id > 0): ?>
				<hr/>
				<h3>Traductions disponibles</h3>
				<p class="acenter">
				
				<?php foreach(\classes\model\Culture::getAll(1) as $cult): ?>
					<a href="edit_page_lang.php?id=<?php echo $oPage->id ?>&culture=<?php echo $cult->id ?>" title="<?php echo $cult->label ?>">
						<img src="<?php echo BASE_DIR ?>img/flag/24/<?php echo $cult->id ?>.png" alt="<?php echo $cult->label ?>" />
					</a>
				<?php endforeach ?>
				</p><br/>
			<?php endif ?>
		</form>
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php') ?>
	</aside>
</div>
	
<?php
include('inc/footer.inc.php');