<script>
	// Inclu la google map
	$(function() {
		var latlng = new google.maps.LatLng(47.010226,2.15332); // Centrer pour la france
		$('#map_canvas').gmap({'center':latlng, 'zoom':5, 'streetViewControl': false, 'callback':function() {
				$('#map_canvas').gmap('addSidebar', 'sidebar', google.maps.ControlPosition.LEFT_TOP);
				$('#map_canvas').gmap('loadHTML', 'microdata', '.vevent');
			}
		});
	});
</script>

<article class="map">
	<?php foreach($elements as $element): ?>
		<div class="vevent">
			<div class="summary">
				<div class="popupMap">
					<p>
						<h3><?php echo $element->title ?></h3>
						<?php if($element->infos!=''): ?>
							<?php echo $element->infos ?><br/>
						<?php endif ?>
						<?php if($element->img!=''): ?>
							<img src="../<?php echo Module_blockmap_element::UPLOAD_DIR ?><?php echo $element->id ?>/<?php echo $element->img ?>" alt="" />
						<?php endif ?>
					</p>
				</div>
			</div>
			<span class="hidden" itemprop="geo"><?php echo $element->latitude ?>;<?php echo $element->longitude ?></span>
		</div>
	<?php endforeach ?>
	
	<div style="height:300px; position:relative; background-color:rgb(229, 227, 223); overflow:hidden; text-align:center;" id="map_canvas">Aucune carte n'est disponible pour cette agence</div>
</article> <!-- .map -->