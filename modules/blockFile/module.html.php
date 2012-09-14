<?php if(isset($element->file) && $element->file!=""): ?>
	<div class="blockFile a<?php echo $element->align ?>">
		<a href="<?php echo BASE_DIR ?><?php echo self::UPLOAD_DIR ?><?php echo $oModule->id ?>/<?php echo $element->file ?>" target="_blank" title="<?php echo $element->title ?>"<?php echo $element->button==1? ' class="btn"':'' ?>>
			<?php echo $element->text ?>
		</a>
	</div>
<?php endif ?>