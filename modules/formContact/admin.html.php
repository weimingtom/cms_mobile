<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action_<?php echo $id ?>" value="module" />
	<input type="hidden" name="id" id="id_<?php echo $id ?>" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="dest_<?php echo $id ?>">
			Destinataire :
			<?php echo \helpers\Helper::formatInfo('Adresse mail qui recevra les mails de contact') ?> 
		</label>
		<input type="text" name="content[<?php echo $id ?>][dest]" id="dest_<?php echo $id ?>" value="<?php echo (isset($content) && is_object($content))? $content->dest:''; ?>" placeholder="exemple@host.com" required />
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>