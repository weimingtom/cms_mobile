			<footer>
				&copy; <a target="_blank" href="http://www.mmcreation.com">MMCréation</a> 2012
			</footer>
		</div> <!-- END div #container -->
		
		<?php
		// INCLUDE DES FICHIERS JS
		if(isset($page['js']) && !empty($page['js']))
		{
			if(is_array($page['js']))
			{
				foreach($page['js'] as $js)
				{
					if( file_exists(__DIR__.'/../'.JS_DIR.$js) )
						echo '<script src="'.JS_DIR.$js.'"></script>';
					else
						echo '<script src="'.$js.'"></script>';
				}
			}
		}
		?>
		<script src="<?php echo BASE_DIR ?><?php echo JS_DIR ?>jpicker-1.1.6.min.js"></script>
		<script src="<?php echo BASE_DIR ?><?php echo JS_DIR ?>jquery-ui.custom.min.js"></script>
		<script src="<?php echo BASE_DIR ?><?php echo JS_DIR ?>delete.js"></script>
		<script src="<?php echo BASE_DIR ?><?php echo JS_DIR ?>jquery.orderItem.js"></script>
		
		<script src="http://cdn.mmcreation.com/javascript/ckSource/ckeditor-3.3.1/ckeditor.js"></script>
		<script src="http://cdn.mmcreation.com/javascript/ckSource/ckeditor-3.3.1/config.js"></script>
		<script src="http://cdn.mmcreation.com/javascript/ckSource/ckeditor-3.3.1/adapters/jquery.js"></script>
		<script src="<?php echo BASE_DIR ?><?php echo JS_DIR ?>myckeditory.js"></script>
		<script>
		$(document).ready(function() {
			$('.colorPick').jPicker();
		});
		</script>
	</body>
</html>