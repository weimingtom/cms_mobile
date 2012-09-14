<div class="slider_box">
	<ul class="rslides">
		<?php foreach($elements as $element): ?>
			<li><img src="<?php echo BASE_DIR ?><?php echo Module_blockslider_element::UPLOAD_DIR ?><?php echo $element->id ?>/<?php echo $element->img ?>" alt="" /></li>
		<?php endforeach ?>
	</ul>

	<script>
	$(function () {
		$(".rslides").responsiveSlides({
			auto: true,
			speed: 800,
			timeout: 4000,
			maxwidth: 960,
			namespace: "centered-btns",
			<?php if($elements[0]->control == 1): ?>
				pager: true,
				nav: true,
			<?php else: ?>
				pager: false,
				nav: false,
			<?php endif; ?>
		});
	});
	</script>
</div> <!-- !#slider_box -->