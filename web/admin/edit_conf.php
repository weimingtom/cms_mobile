<?php
$cd = '../';
include(__DIR__.'/../../inc/inc.php');
include('inc/inc.php');

$id		= 1;
$return = array();

if( isset($_POST['action']) && $_POST['action'] == 'lang' ) {
	foreach(\classes\model\Culture::getAll() as $lang)
	{
		$status = (isset($_POST['status']) && isset($_POST['status'][$lang->id]))? $_POST['status'][$lang->id]:0;
		\classes\model\Culture::updateStatus($lang->id, $status);
	}
	
	$return['lang']['valid'] = VALID_TEXT;
}

if( isset($_POST['action']) && $_POST['action'] == 'conf' ) {
	\classes\model\Configuration::set($_POST);
	$return['conf']['valid']	= VALID_TEXT;
}

$oConfiguration = \classes\model\Configuration::get();

include('inc/header.inc.php');
?>

<p id="fil_ariane">
	<a href="index.php">Back office</a> > Editer les Infos Générales du site
</p>

<div id="content" class="clearfix">
	<section>
		<h2>Editer les Infos Générales du site</h2>
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
			<h3>
				Choix des langues
				<?php echo \helpers\Helper::formatInfo('Choisissez les langues pour votre site parmi les langues disponibles') ?>
		    </h3>
			<?php if(isset($return['lang'])): ?>
				<?php echo \helpers\Helper::printReturn($return['lang']) ?>
			<?php endif ?>
			
			<input type="hidden" name="action" id="action_lang" value="lang" />
			<ul>
			<?php foreach(\classes\model\Culture::getAll() as $culture): ?>
				<li>
					<input type="checkbox" name="status[<?php echo $culture->id ?>]" id="lang_<?php echo $culture->id ?>" value="1"<?php echo $culture->status==\classes\model\Culture::STATUS_ONLINE? 'checked="checked"':'' ?> />
					<label for="lang_<?php echo $culture->id ?>"><?php echo ucfirst($culture->label) ?></label>
				</li>
			<?php endforeach ?>
			</ul>
			
			<p class="w100 clearfix">
				<input type="submit" name="submit" id="submit_lang" class="button btn_submit" value="Valider" />
			</p>
		</form>
		<hr />
		
		<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
			<input type="hidden" name="action" id="action_conf" value="conf" />
			<h3>Style général du site</h3>
			<?php if(isset($return['conf'])): ?>
				<?php echo \helpers\Helper::printReturn($return['conf']) ?>
			<?php endif ?>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="color1">Couleur 1</label>
					<input type="text" name="color1" id="color1" class="colorPick" value="<?php echo isset($oConfiguration)? $oConfiguration->color1:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="color2">Couleur 2</label>
					<input type="text" name="color2" id="color2" class="colorPick" value="<?php echo isset($oConfiguration)? $oConfiguration->color2:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="w50">
				<div class="form_fields">
					<label for="background">Couleur du fond</label>
					<input type="text" name="background" id="background" class="colorPick" value="<?php echo isset($oConfiguration)? $oConfiguration->background:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			
			
			<h3>Police d'écriture</h3>
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="font_family">Police</label>
					<select name="font_family" id="font_family">
						<option value="Arial"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Arial')? 'selected="selected"':''; ?>>Arial</option>
						<option value="Comic Sans MS"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Comic Sans MS')? 'selected="selected"':''; ?>>Comic Sans MS</option>
						<option value="Georgia"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Georgia')? 'selected="selected"':''; ?>>Georgia</option>
						<option value="Helvetica"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Helvetica')? 'selected="selected"':''; ?>>Helvetica</option>
						<option value="Sans serif"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Sans serif')? 'selected="selected"':''; ?>>Sans serif</option>
						<option value="Tahoma"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Tahoma')? 'selected="selected"':''; ?>>Tahoma</option>
						<option value="Times New Roman"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Times New Roman')? 'selected="selected"':''; ?>>Times New Roman</option>
						<option value="Trebuchet MS"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Trebuchet MS')? 'selected="selected"':''; ?>>Trebuchet MS</option>
						<option value="Verdana"<?php echo (isset($oConfiguration) && $oConfiguration->font_family=='Verdana')? 'selected="selected"':''; ?>>Verdana</option>
					</select>
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="font_size">
						Taille de caractères
						<?php echo \helpers\Helper::formatInfo('Taille des caractères en px, em, ex: 10px ou 0.9em') ?>
					</label>
					<input type="text" name="font_size" id="font_size" value="<?php echo isset($oConfiguration)? $oConfiguration->font_size:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="font_color">Couleur du texte</label>
					<input type="text" name="font_color" id="font_color" class="colorPick" value="<?php echo isset($oConfiguration)? $oConfiguration->font_color:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="h1_size">
						Taille des titre niveau 1
						<?php echo \helpers\Helper::formatInfo('Taille des caractères en px, em, ex: 10px ou 0.9em') ?>
					</label>
					<input type="text" name="h1_size" id="h1_size" value="<?php echo isset($oConfiguration)? $oConfiguration->h1_size:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="h2_size">
						Taille des titre niveau 2
						<?php echo \helpers\Helper::formatInfo('Taille des caractères en px, em, ex: 10px ou 0.9em') ?>
					</label>
					<input type="text" name="h2_size" id="h2_size" value="<?php echo isset($oConfiguration)? $oConfiguration->h2_size:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="h3_size">
						Taille des titre niveau 3
						<?php echo \helpers\Helper::formatInfo('Taille des caractères en px, em, ex: 10px ou 0.9em') ?>
					</label>
					<input type="text" name="h3_size" id="h3_size" value="<?php echo isset($oConfiguration)? $oConfiguration->h3_size:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="h4_size">
						Taille des titre niveau 4
						<?php echo \helpers\Helper::formatInfo('Taille des caractères en px, em, ex: 10px ou 0.9em') ?>
					</label>
					<input type="text" name="h4_size" id="h4_size" value="<?php echo isset($oConfiguration)? $oConfiguration->h4_size:''; ?>" />
				</div>
			</div>
			<div class="fleft w50">
				<div class="form_fields">
					<label for="h5_size">
						Taille des titre niveau 5
						<?php echo \helpers\Helper::formatInfo('Taille des caractères en px, em, ex: 10px ou 0.9em') ?>
					</label>
					<input type="text" name="h5_size" id="h5_size" value="<?php echo isset($oConfiguration)? $oConfiguration->h5_size:''; ?>" />
				</div>
			</div>
			<div class="clear"></div>
			<hr/>
			
			<h3>Titre du site &amp; Référencement</h3>
			<?php foreach(\classes\model\Culture::getAll(1) as $culture): ?>
				<?php $oConfigurationTranslate = \classes\model\Configuration::get($culture->id); ?>
				<h4><?php echo $culture->label ?></h4>
				
				<div class="fleft w50 first">
					<div class="form_fields">
						<label for="title">
							Titre :
							<?php echo \helpers\Helper::formatInfo('Titre du site') ?>
						</label>
						<input type="text" name="title[<?php echo $culture->id ?>]" id="title_<?php echo $culture->id ?>" value="<?php echo isset($oConfigurationTranslate)? $oConfigurationTranslate->title:''; ?>" />
					</div>
				</div>
				<div class="fleft w50">
					<div class="form_fields">
						<label for="book_link">Url réservation</label>
						<input type="text" name="book_link[<?php echo $culture->id ?>]" id="book_link_<?php echo $culture->id ?>" value="<?php echo isset($oConfigurationTranslate)? $oConfigurationTranslate->book_link:''; ?>" />
					</div>
				</div>
				<div class="clear"></div>
				
				<div class="fleft w50 first">
					<div class="form_fields">
						<label for="meta_description">Meta Description</label>
						<input type="text" name="meta_description[<?php echo $culture->id ?>]" id="meta_description_<?php echo $culture->id ?>" value="<?php echo isset($oConfigurationTranslate)? $oConfigurationTranslate->meta_description:''; ?>" />
					</div>
				</div>
				<div class="fleft w50">
					<div class="form_fields">
						<label for="meta_keywords">Meta Keywords</label>
						<input type="text" name="meta_keywords[<?php echo $culture->id ?>]" id="meta_keywords_<?php echo $culture->id ?>" value="<?php echo isset($oConfigurationTranslate)? $oConfigurationTranslate->meta_keywords:''; ?>" />
					</div>
				</div>
				<div class="clear"></div>
			<?php endforeach ?>
			
			<div class="fleft w50 first">
				<div class="form_fields">
					<label for="google_analytics_id">ID Google Analytics</label>
					<input type="text" name="google_analytics_id" id="google_analytics_id" value="<?php echo isset($oConfiguration)? $oConfiguration->google_analytics_id:''; ?>" />
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
	
<?php
include('inc/footer.inc.php');