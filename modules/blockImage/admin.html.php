<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action" value="module" />
	<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="img">Image</label>
		<input type="file" name="img" id="img_<?php echo $id ?>" />
		<?php if(isset($content) && !empty($content->img)): ?>
			<img src="../<?php echo self::UPLOAD_DIR ?><?php echo $id ?>/<?php echo $content->img ?>" alt="" style="max-width:350px;" />
			<a href="<?php echo $pageLink ?>&module=<?php echo $id ?>&delete=img" title="Delete this item"><img src="../img/admin/Delete.png" alt="Delete" /></a>
		<?php endif ?>
	</div>
	
	<div class="form_fields">
		<label for="responsive_<?php echo $id ?>">
			Responsive ?
			<?php echo \helpers\Helper::formatInfo('L\'image s\'adapte à la taille de l\'écran') ?>
		</label>
		<input type="checkbox" name="content[<?php echo $id ?>][responsive]" id="responsive_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->responsive==1)? 'checked="checked"':''; ?>/>
	</div>
	
	<div class="form_fields">
		<label for="center_<?php echo $id ?>">Centrer l'image ?</label>
		<input type="checkbox" name="content[<?php echo $id ?>][center]" id="center_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->center==1)? 'checked="checked"':''; ?>/>
	</div>
	
	<div class="form_fields">
		<label for="title_<?php echo $id ?>">Titre : </label>
		<input type="text" name="content[<?php echo $id ?>][title]" id="title_<?php echo $id ?>" value="<?php echo (isset($content) && is_object($content))? $content->title:''; ?>" />
	</div>
	
	<div class="form_fields">
		<label for="link_<?php echo $id ?>">Lien ?</label>
		<input type="checkbox" name="content[<?php echo $id ?>][link]" id="link_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->link==1)? 'checked="checked"':''; ?>/>
	</div>
	
	<div class="form_fields" id="link_url_<?php echo $id ?>">
		<label for="url_<?php echo $id ?>">LienUrl Destination</label>
		<div>
			Externe ? <input type="checkbox" name="content[<?php echo $id ?>][external_url]" id="external_url_<?php echo $id ?>" value="1" <?php echo (isset($content) && is_object($content) && $content->external_url==1)? 'checked="checked"':'' ?> />  
			<input type="text" name="content[<?php echo $id ?>][url_externe]" id="url_externe_<?php echo $id ?>" value="<?php echo (isset($content) && is_object($content))? $content->url:'http://'; ?>" />
			<select name="content[<?php echo $id ?>][url_interne]" id="url_interne_<?php echo $id ?>">
				<?php foreach(\classes\model\Page::getAll($culture) as $oPage): ?>
					<?php if($oPage->title==null) continue ?>
					<option value="<?php echo $oPage->id ?>" <?php echo (isset($content) && is_object($content) && $content->id_page_dest==$oPage->id)? 'selected="selected"':'' ?>>
						<?php echo $oPage->title ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>

<script>
$("document").ready(function() {
	// Affiche ou masque les différents mode d'url
	$.fn.showHideUrl = function() {
		$("#url_externe_<?php echo $id ?>, #url_interne_<?php echo $id ?>").hide();
		if($(this).is(':checked'))
			$("#url_externe_<?php echo $id ?>").show();
		else
			$("#url_interne_<?php echo $id ?>").show();
	};
	$("#external_url_<?php echo $id ?>").showHideUrl();
	$("#external_url_<?php echo $id ?>").change(function() {
		$(this).showHideUrl();
	})

	
	// Affiche ou masque l'url
	$.fn.showHideLink = function() {
		if($(this).is(':checked'))
			$("#link_url_<?php echo $id ?>").show();
		else
			$("#link_url_<?php echo $id ?>").hide();
	};
	$("#link_<?php echo $id ?>").showHideLink();
	$("#link_<?php echo $id ?>").change(function() {
		$(this).showHideLink();
	})
})
</script>