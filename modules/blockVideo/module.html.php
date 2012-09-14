<?php if(isset($element->embed) && $element->embed!=""): ?>
	<div class="blockVideo<?php echo $element->responsive==1? ' responsive_video':'' ?>">
		<div style="max-width:650px;<?php echo $element->center==1? ' margin:0 auto;':'' ?>">
			<?php echo $element->embed ?>
		</div>
	</div>
<?php endif ?>

<script>
$(document).ready(function(){
    $(".responsive_video").fitVids();
});
</script>