<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" id="contactBox_<?php echo $id ?>" class="contactBox">
	
	<?php echo \helpers\Helper::printReturn($return) ?>
	
	<input type="hidden" name="action" value="contact" />
	<input type="hidden" name="content[<?php echo $id ?>][culture]" value="<?php echo $culture ?>" />
	<input type="hidden" name="antispam_confirm" value="<?=$_SESSION['Captcha'];?>" />
	
		
	<div class="form_fields">
		<label for="lastname_<?php echo $id ?>"><?php echo __('Lastname') ?> : </label>
		<input type="text" name="content[<?php echo $id ?>][lastname]" id="lastname_<?php echo $id ?>" value="<?php echo isset($_POST['content'][$id]['lastname'])? $_POST['content'][$id]['lastname']:''; ?>" />
	</div>
	
	<div class="form_fields">
		<label for="firstname_<?php echo $id ?>"><?php echo __('Firstname') ?>* : </label>
		<input type="text" name="content[<?php echo $id ?>][firstname]" id="firstname_<?php echo $id ?>" value="<?php echo isset($_POST['content'][$id]['firstname'])? $_POST['content'][$id]['firstname']:''; ?>" required />
	</div>
	
	<div class="form_fields">
		<label for="email_<?php echo $id ?>"><?php echo __('Email') ?>* : </label>
		<input type="text" name="content[<?php echo $id ?>][email]" id="email_<?php echo $id ?>" value="<?php echo isset($_POST['content'][$id]['email'])? $_POST['content'][$id]['email']:''; ?>" placeholder="exemple@host.com" required />
	</div>
	
	<div class="form_fields">
		<label for="phone_<?php echo $id ?>"><?php echo __('Phone') ?> : </label>
		<input type="text" name="content[<?php echo $id ?>][phone]" id="phone_<?php echo $id ?>" value="<?php echo isset($_POST['content'][$id]['phone'])? $_POST['content'][$id]['phone']:''; ?>" />
	</div>
	
	<div class="form_fields">
		<label for="company_<?php echo $id ?>"><?php echo __('Company') ?> : </label>
		<input type="text" name="content[<?php echo $id ?>][company]" id="company_<?php echo $id ?>" value="<?php echo isset($_POST['content'][$id]['company'])? $_POST['content'][$id]['company']:''; ?>" />
	</div>
	
	<div class="form_fields">
		<label for="object_<?php echo $id ?>"><?php echo __('Object') ?>* : </label>
		<input type="text" name="content[<?php echo $id ?>][object]" id="object_<?php echo $id ?>" value="<?php echo isset($_POST['content'][$id]['object'])? $_POST['content'][$id]['object']:''; ?>" required />
	</div>
	
	<div class="form_fields">
		<label for="content_<?php echo $id ?>"><?php echo __('Content') ?>* : </label>
		<textarea name="content[<?php echo $id ?>][content]" id="content_<?php echo $id ?>" required><?php echo isset($_POST['content'][$id]['content'])? $_POST['content'][$id]['content']:''; ?></textarea>
	</div>
	
	<div class="form_fields">
		<label for="captcha_<?php echo $id ?>"><?php echo __('Catpcha') ?>* : </label>
		<img src="<?php echo BASE_DIR ?>captcha.php?PHPSESSID=<?php echo session_id() ?>" style="border: #ccc solid 1px; height: 20px;" alt="Recopiez le code"/>
            
		<input type="text" name="content[<?php echo $id ?>][captcha]" id="captcha_<?php echo $id ?>" maxlength="6" value="" required />
	</div>
		
	<div class="aright">
		<input type="submit" name="submit" id="submit" class="btn" value="<?php echo __('Submit') ?>" />
	</div>
</form>