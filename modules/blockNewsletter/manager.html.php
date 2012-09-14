<a href="export.php?export=blockNewsletter" target="_blank" class="fright bouton icn-install">Exporter</a>
<div class="clear"></div>

<table class="table_admin">
	<tr>
		<th>#</th>
		<th>Email</th>
		<th>Date inscription</th>
	</tr>
	<?php foreach($newsletters as $key => $oNewsletter): ?>
		<tr class="lign<?php echo $key%2 ?>" id="tr_<?php echo $oNewsletter->id ?>">
			<td><?php echo $oNewsletter->id ?></td>
			<td><?php echo $oNewsletter->email ?></td>
			<td><?php echo $oNewsletter->date_inscription ?></td>
		</tr>
	<?php endforeach ?>
</table>