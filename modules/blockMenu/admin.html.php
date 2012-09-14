<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action_<?php echo $id ?>" value="module" />
	<input type="hidden" name="id" id="id_<?php echo $id ?>" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="menu_<?php echo $id ?>">Menu :</label>
		<select name="content[<?php echo $id ?>][menu]" id="menu_<?php echo $id ?>">
			<?php foreach(\classes\model\Menu::getAll() as $oMenu): ?>
				<option value="<?php echo $oMenu->id ?>" <?php echo (isset($content) && is_object($content) && $content->menu==$oMenu->id)? 'selected="selected"':'' ?>>
					<?php echo $oMenu->title ?>
				</option>
			<?php endforeach ?>
		</select>
	</div>
	
	<div class="form_fields">
		<label for="display_<?php echo $id ?>">Affichage :</label>
		<select name="content[<?php echo $id ?>][display]" id="display_<?php echo $id ?>">
			<option value="<?php echo self::DISPLAY_INLINE_ALL_ON_BAR ?>" <?php echo (isset($content) && is_object($content) && $content->display==self::DISPLAY_INLINE_ALL_ON_BAR)? 'selected="selected"':''; ?>><?php echo self::getDisplay(self::DISPLAY_INLINE_ALL_ON_BAR) ?></option>
			<option value="<?php echo self::DISPLAY_INLINE_ONE_BY_ONE ?>" <?php echo (isset($content) && is_object($content) && $content->display==self::DISPLAY_INLINE_ONE_BY_ONE)? 'selected="selected"':''; ?>><?php echo self::getDisplay(self::DISPLAY_INLINE_ONE_BY_ONE) ?></option>
			<option value="<?php echo self::DISPLAY_INLINE_ALL_IN_TXT ?>" <?php echo (isset($content) && is_object($content) && $content->display==self::DISPLAY_INLINE_ALL_IN_TXT)? 'selected="selected"':''; ?>><?php echo self::getDisplay(self::DISPLAY_INLINE_ALL_IN_TXT) ?></option>
			<option value="<?php echo self::DISPLAY_BLOCK_ONE_BY_LIGN ?>" <?php echo (isset($content) && is_object($content) && $content->display==self::DISPLAY_BLOCK_ONE_BY_LIGN)? 'selected="selected"':''; ?>><?php echo self::getDisplay(self::DISPLAY_BLOCK_ONE_BY_LIGN) ?></option>
		</select>
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>