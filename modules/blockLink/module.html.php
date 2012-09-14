<?php if(!empty($url)): ?>
	<div class="blockLink a<?php echo $element->align ?>">
		<a href="<?php echo $url ?>"<?php echo $element->target==1? 'target="_blank"':'' ?> title="<?php echo $element->title ?>"<?php echo $element->button==1? ' class="btn"':'' ?>>
			<?php echo $element->text ?>
		</a>
	</div>
<?php endif ?>