<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action_<?php echo $id ?>" value="module" />
	<input type="hidden" name="id" id="id_<?php echo $id ?>" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="file">Fichier :</label>
		<input type="file" name="file" id="file_<?php echo $id ?>" />
		<?php if(isset($content) && !empty($content->file)): ?>
			<a href="<?php echo BASE_DIR ?><?php echo self::UPLOAD_DIR ?><?php echo $id ?>/<?php echo $content->file ?>" target="_blank">Voir le fichier</a>
			<a href="<?php echo $pageLink ?>&module=<?php echo $id ?>&delete=img" title="Delete this item"><img src="<?php echo BASE_DIR ?>img/admin/Delete.png" alt="Delete" /></a>
		<?php endif ?>
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