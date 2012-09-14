<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action" value="module" />
	<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="content">Texte : </label>
		<textarea name="content[<?php echo $id ?>]" id="content_<?php echo $id ?>" class="blocTxtEditor"><?php echo isset($content)? $content:''; ?></textarea>
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>