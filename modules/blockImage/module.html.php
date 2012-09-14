<?php if(isset($element->img) && $element->img!=""): ?>
	<div class="blockImage<?php echo $element->center==1? ' acenter':'' ?>">
		<?php if(!empty($url)): ?>
			<a href="<?php echo $url ?>">
		<?php endif ?>
		<img src="<?php echo BASE_DIR ?><?php echo self::UPLOAD_DIR ?><?php echo $oModule->id ?>/<?php echo $element->img ?>" <?php echo $element->responsive==1? 'class="responsive_img"':'' ?> alt="<?php echo $element->title ?>" />
		<?php if(!empty($url)): ?>
			</a>
		<?php endif ?>
	</div>
<?php endif ?>