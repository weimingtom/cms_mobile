<?php
use \classes\model\Page as Page;

$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$culture	= isset($_GET['culture'])? $_GET['culture']:'fr';
$culture	= isset($_POST['culture'])? $_POST['culture']:$culture;
$id			= isset($_GET['id'])? $_GET['id']:\classes\model\Page::HEADER_ID;
$return		= array();

// crée les translations pour les ceux qui n'en ont pas
\classes\model\Page::generateTranslation($id, \classes\model\Culture::getAll());

$oPageTranslate		= \classes\model\Page::get($id, $culture);

include('inc/header.inc.php');
?>
<p id="fil_ariane">
	<a href="index.php">Back office</a> > <a href="page.php">Editer une page</a> > Editer le <?php echo \classes\model\Page::getIncludeTitle($id) ?> 
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Editer le <?php echo \classes\model\Page::getIncludeTitle($id) ?></h2>
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" id="action" value="pageTranslate" />
			<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
			<input type="hidden" name="culture" id="culture" value="<?php echo $culture ?>" />
			
			<?php echo \helpers\Helper::printReturn($return) ?>
			
			<div class="fleft w50">
				<div class="form_fields">
					<label for="culture">Langue</label>
					<select name="culture" id="culture">
						<?php foreach(\classes\model\Culture::getAll() as $cult): ?>
							<option value="<?php echo $cult->id ?>" <?php echo (isset($culture) && $culture==$cult->id)? 'selected="selected"':'' ?>>
								<?php echo $cult->label ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="clear"></div>
						
			<p class="w100 clearfix">
				<input type="submit" name="submit" id="submit" class="button btn_submit" value="Valider" />
			</p>
		</form>
		<hr/>
		
		<?php if(isset($culture) && !empty($culture) ): ?>
			<?php include('inc/module_editor.inc.php'); ?>
		<?php endif ?>		
	</section>
	
	<aside>
		<?php include('inc/apercu.inc.php'); ?>
	</aside>
</div>

<?php
include('inc/footer.inc.php');