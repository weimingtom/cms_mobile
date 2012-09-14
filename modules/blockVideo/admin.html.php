<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action" value="module" />
	<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	
	<div class="form_fields">
		<label for="embed_<?php echo $id ?>">Video (embed) : </label>
		<textarea name="content[<?php echo $id ?>][embed]" id="embed_<?php echo $id ?>"><?php echo (isset($content) && is_object($content))? $content->embed:''; ?></textarea>
	</div>
	
	<div class="form_fields">
		<label for="responsive_<?php echo $id ?>">
			Responsive ?
			<?php echo \helpers\Helper::formatInfo('La vidéo s\'adapte à la taille de l\'écran') ?>
		</label>
		<input type="checkbox" name="content[<?php echo $id ?>][responsive]" id="responsive_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->responsive==1)? 'checked="checked"':''; ?>/>
	</div>
	
	<div class="form_fields">
		<label for="center_<?php echo $id ?>">Centrer la vidéo ?</label>
		<input type="checkbox" name="content[<?php echo $id ?>][center]" id="center_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->center==1)? 'checked="checked"':''; ?>/>
	</div>
		
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>

<script>
$("document").ready(function() {
	
})
</script>