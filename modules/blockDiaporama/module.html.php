<div class="diaporama_box">
	<div id="rg-gallery" class="rg-gallery">
	    <div class="rg-thumbs">
	        <!-- Elastislide Carousel Thumbnail Viewer -->
	        <div class="es-carousel-wrapper">
	            <div class="es-nav">
	                <span class="es-nav-prev">Previous</span>
	                <span class="es-nav-next">Next</span>
	            </div>
	            <div class="es-carousel">
	                <ul>
	                    <?php foreach($elements as $element): ?>
							<li>
								<a href="#">
									<?php $folder = BASE_DIR.Module_blockdiaporama_element::UPLOAD_DIR.$element->id.'/'; ?>
									<!-- <img src="images/thumbs/1.jpg" data-large="images/1.jpg" alt="image01" data-description="Some description" /> -->
									<img src="<?php echo $folder ?><?php echo $element->img ?>" data-large="<?php echo $folder ?><?php echo $element->img ?>" alt="image01" data-description="" alt="" />
								</a>
							</li>
						<?php endforeach ?>
	                </ul>
	            </div>
	        </div>
	        <!-- End Elastislide Carousel Thumbnail Viewer -->
	    </div><!-- rg-thumbs -->
	</div><!-- rg-gallery -->

	
	<!-- <link rel="stylesheet" type="text/css" href="http://tympanus.net/Tutorials/ResponsiveImageGallery/css/style.css" />
	<link rel="stylesheet" type="text/css" href="http://tympanus.net/Tutorials/ResponsiveImageGallery/css/elastislide.css" /> -->
	<noscript>
		<style>
			.es-carousel ul{
				display:block;
			}
		</style>
	</noscript>
	<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
	<div class="rg-image-wrapper">
		{{if itemsCount > 1}}
			<div class="rg-image-nav">
				<a href="#" class="rg-image-nav-prev">Previous Image</a>
				<a href="#" class="rg-image-nav-next">Next Image</a>
			</div>
		{{/if}}
		<div class="rg-image"></div>
		<div class="rg-loading"></div>
		<div class="rg-caption-wrapper">
			<div class="rg-caption" style="display:none;">
				<p></p>
			</div>
		</div>
	</div>
	</script>
	<!-- 
	<script type="text/javascript" src="http://tympanus.net/Tutorials/ResponsiveImageGallery/js/jquery.tmpl.min.js"></script>
	<script type="text/javascript" src="http://tympanus.net/Tutorials/ResponsiveImageGallery/js/jquery.elastislide.js"></script>
	<script type="text/javascript" src="http://tympanus.net/Tutorials/ResponsiveImageGallery/js/gallery.js"></script>
	 -->
</div> <!-- !#diaporama_box -->