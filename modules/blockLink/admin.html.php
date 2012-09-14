<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action_<?php echo $id ?>" value="module" />
	<input type="hidden" name="id" id="id_<?php echo $id ?>" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="url_<?php echo $id ?>">Url Destination</label>
		<div>
			Externe ? <input type="checkbox" name="content[<?php echo $id ?>][external_url]" id="external_url_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->external_url==1)? 'checked="checked"':'' ?> />  
			<input type="text" name="content[<?php echo $id ?>][url_externe]" id="url_externe_<?php echo $id ?>" value="<?php echo (isset($content) && is_object($content))? $content->url:'http://'; ?>" />
			<select name="content[<?php echo $id ?>][url_interne]" id="url_interne_<?php echo $id ?>">
				<?php foreach(\classes\model\Page::getAll($culture) as $oPage): ?>
					<?php if($oPage->title==null) continue ?>
					<option value="<?php echo $oPage->id ?>" <?php echo (isset($content) && is_object($content) && $content->id_page_dest==$oPage->id)? 'selected="selected"':'' ?>>
						<?php echo $oPage->title ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	
	<div class="form_fields">
		<label for="target_<?php echo $id ?>">Target :</label>
		<select name="content[<?php echo $id ?>][target]" id="target_<?php echo $id ?>">
			<option value="0" <?php echo (isset($content) && is_object($content) && $content->target==0)? 'selected="selected"':''; ?>>Ouvrir dans la même page</option>
			<option value="1" <?php echo (isset($content) && is_object($content) && $content->target==1)? 'selected="selected"':''; ?>>Ouvrir dans une nouvelle page</option>
		</select>
	</div>
	
	<div class="form_fields">
		<label for="text_<?php echo $id ?>">Texte : </label>
		<input type="text" name="content[<?php echo $id ?>][text]" id="text_<?php echo $id ?>" value="<?php echo (isset($content) && is_object($content))? $content->text:''; ?>" />
	</div>
	
	<div class="form_fields">
		<label for="title_<?php echo $id ?>">Titre : </label>
		<input type="text" name="content[<?php echo $id ?>][title]" id="title_<?php echo $id ?>" value="<?php echo (isset($content) && is_object($content))? $content->title:''; ?>" />
	</div>
	
	<div class="form_fields">
		<label for="align">Aligement</label>
		<select name="content[<?php echo $id ?>][align]" id="align_<?php echo $id ?>">
			<option value="left" <?php echo (isset($content) && is_object($content) && $content->align=='left')? 'selected="selected"':'' ?>>A gauche</option>
			<option value="center" <?php echo (isset($content) && is_object($content) && $content->align=='center')? 'selected="selected"':'' ?>>A centre</option>
			<option value="right" <?php echo (isset($content) && is_object($content) && $content->align=='right')? 'selected="selected"':'' ?>>A droite</option>
		</select>
	</div>
	
	<div class="form_fields">
		<label for="button_<?php echo $id ?>">
			Bouton ?
			<?php echo \helpers\Helper::formatInfo('Si oui, le lien sera en forme de bouton. Sinon un lien simple') ?>
		</label>
		<input type="checkbox" name="content[<?php echo $id ?>][button]" id="button_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->button==1)? 'checked="checked"':''; ?>/>
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>

<script>
$("document").ready(function() {
	// Affiche ou masque les différents mode d'url
	$.fn.showHideUrl = function() {
		$("#url_externe_<?php echo $id ?>, #url_interne_<?php echo $id ?>").hide();
		if($(this).is(':checked'))
			$("#url_externe_<?php echo $id ?>").show();
		else
			$("#url_interne_<?php echo $id ?>").show();
	};
	$("#external_url_<?php echo $id ?>").showHideUrl();
	$("#external_url_<?php echo $id ?>").change(function() {
		$(this).showHideUrl();
	})
})
</script>