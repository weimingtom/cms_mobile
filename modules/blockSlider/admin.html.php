<table class="table_admin">
	<tr>
		<th>#</th>
		<th>Ordre</th>
		<th>Miniature</th>
		<th>Actions</th>
	</tr>
	<?php foreach($elements as $key => $oElement): ?>
	<tr class="lign<?php echo $key%2 ?>" id="tr_<?php echo $oElement->id ?>">
		<td><?php echo $oElement->id ?></td>
		<td><?php //echo $oElement->label ?></td>
		<td><img src="../<?php echo Module_blockslider_element::UPLOAD_DIR ?><?php echo $oElement->id ?>/<?php echo $oElement->img ?>" alt="" class="thumb" /></td>
		<td><a href="<?php echo $_SERVER['REQUEST_URI'] ?>&delete=block_slider&element=<?php echo $oElement->id ?>" class="icones icn-del" rel="<?php echo $oElement->id ?>" title="Supprimer">Supprimer</a></td>
	</tr>
<?php endforeach ?>
</table>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" id="action" value="module" />
	<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
	
	<?php echo \helpers\Helper::printReturn($return[$id]) ?>
	
	<div class="form_fields">
		<label for="content">Ajouter un élément (940px*400px) : </label>
		<input type="file" name="slider" id="slider_<?php echo $id ?>" />
	</div>
	
	<div class="form_fields">
		<label for="control_<?php echo $id ?>">
			Contrôle ?
			<?php echo \helpers\Helper::formatInfo('Afficher les éléments de contrôle du slider') ?>
		</label>
		<input type="checkbox" name="content[<?php echo $id ?>][control]" id="control_<?php echo $id ?>" value="1" <?php echo (isset($elements) && count($elements)>0 && $elements[0]->control==1)? 'checked="checked"':''; ?>/>
	</div>
	
	<p class="w100 clearfix">
		<input type="submit" name="submit" id="submit_<?php echo $id ?>" class="button btn_submit" value="Valider" />
	</p>
</form>