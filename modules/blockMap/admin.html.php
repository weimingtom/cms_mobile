<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data" <?php echo (isset($_GET['edit']) && $_GET['edit']=='block_map')? 'class="showAdmin"':'' ?>>
	
	<table class="table_admin">
		<tr>
			<th>#</th>
			<th>Titre</th>
			<th>Latitude</th>
			<th>Longitude</th>
			<th>Actions</th>
		</tr>
		<?php foreach($elements as $key => $oElement): ?>
		<tr class="lign<?php echo $key%2 ?>" id="tr_<?php echo $oElement->id ?>">
			<td><?php echo $oElement->id ?></td>
			<td><?php echo $oElement->title ?></td>
			<td><?php echo $oElement->latitude ?></td>
			<td><?php echo $oElement->longitude ?></td>
			<td>
				<a href="<?php echo $pageLink ?>&edit=block_map&element=<?php echo $oElement->id ?>" class="icones icn-edit" title="Editer">Editer</a>
				<a href="<?php echo $pageLink ?>&delete=block_map&element=<?php echo $oElement->id ?>" class="icones icn-del" rel="<?php echo $oElement->id ?>" title="Supprimer">Supprimer</a>
			</td>
		</tr>
	<?php endforeach ?>
	</table>

	<input type="hidden" name="action" id="action" value="module" />
	<input type="hidden" name="fk_module_item" id="fk_module_item" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	
	<div class="form_fields">
		<label for="title">Titre</label>
		<input type="text" name="title" id="title_<?php echo $id ?>" value="<?php echo isset($elementToEdit)? $elementToEdit->title:'' ?>" />
	</div>
	
	<div class="form_fields">
		<label for="infos">Description</label>
		<textarea name="infos" id="infos_<?php echo $id ?>"><?php echo isset($elementToEdit)? $elementToEdit->infos:'' ?></textarea>
	</div>
	
	<div class="form_fields">
		<label for="latitude">Latitude</label>
		<input type="text" name="latitude" id="latitude_<?php echo $id ?>" value="<?php echo isset($elementToEdit)? $elementToEdit->latitude:'' ?>" />
	</div>
	
	<div class="form_fields">
		<label for="longitude">Longitude</label>
		<input type="text" name="longitude" id="longitude_<?php echo $id ?>" value="<?php echo isset($elementToEdit)? $elementToEdit->longitude:'' ?>" />
	</div>
	
	<div class="form_fields">
		<label for="img">Image</label>
		<input type="file" name="img" id="img_<?php echo $id ?>" />
		<?php if(isset($elementToEdit) && !empty($elementToEdit->img)): ?>
			<img src="../<?php echo Module_blockmap_element::UPLOAD_DIR ?><?php echo $elementToEdit->id ?>/<?php echo $elementToEdit->img ?>" alt="<?php echo $elementToEdit->img ?>" />
			<a href="<?php echo $pageLink ?>&edit=block_map&element=<?php echo $oElement->id ?>&delete=img&module_name=block_map" title="Delete this item"><img src="../img/admin/Delete.png" alt="Delete" /></a>
		<?php endif ?>
	</div>
	
	<div class="form_fields">
		<label for="status">Statut</label>
		<select name="status" id="status">
			<option value="<?php echo \classes\model\MenuItem::STATUS_OFFLINE ?>" <?php echo (isset($elementToEdit) && $elementToEdit->status==\classes\model\MenuItem::STATUS_OFFLINE)? 'selected="selected"':'' ?>>
				<?php echo \classes\model\MenuItem::getStatus(\classes\model\MenuItem::STATUS_OFFLINE) ?>
			</option>
			<option value="<?php echo \classes\model\MenuItem::STATUS_ONLINE ?>" <?php echo (isset($elementToEdit) && $elementToEdit->status==\classes\model\MenuItem::STATUS_ONLINE)? 'selected="selected"':'' ?>>
				<?php echo \classes\model\MenuItem::getStatus(\classes\model\MenuItem::STATUS_ONLINE) ?>
			</option>
			<option value="<?php echo \classes\model\MenuItem::STATUS_ARCHIVED ?>" <?php echo (isset($elementToEdit) && $elementToEdit->status==\classes\model\MenuItem::STATUS_ARCHIVED)? 'selected="selected"':'' ?>>
				<?php echo \classes\model\MenuItem::getStatus(\classes\model\MenuItem::STATUS_ARCHIVED) ?>
			</option>
		</select>
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>