<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" id="newsletterBox">
	<?php echo \helpers\Helper::printReturn($return) ?>
	<input type="hidden" name="action" value="newsletter" />
	<input type="hidden" name="culture" value="<?php echo $culture ?>" />
	
	<label for="email">NEWSLETTER</label>
	<input type="text" name="email" id="email" value="" placeholder="exemple@host.com" required />
	<input type="submit" name="submit" id="submit" value="<?php echo __('OK') ?>" />
</form>