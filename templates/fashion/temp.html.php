<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $site_title ?> | <?php echo $page_title ?></title>
		<meta charset="UTF-8">
		<meta name="robots" content="index,follow" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=1;" />
		<meta name="keywords" content="<?php echo $meta_keywords ?>" />
		<meta name="description" content="<?php echo $meta_description ?>" />
		<link rel="apple-touch-icon" href="/apple-touch-icon.png" />
		<link rel="shortcut icon" href="/favicon.ico" />
		
		<?php echo $css ?>
		
		<script src="<?php echo BASE_DIR ?><?php echo JS_DIR ?>jquery-1.7.min.js"></script>
	</head>
	<body>
		<header>
			<div id="header_top">
				<?php
				$uri		= explode('/', $_SERVER['REQUEST_URI']);
				$idPage 	= explode('-', $uri[count($uri)-1]); ?>
				<?php if($idPage[0]!=3 && !empty($idPage[0])): ?>
					<a href="javascript:window.history.back();" id="backBtn" title="">Back</a>
				<?php endif ?>
				<?php echo $page_title ?>
				<a href="javascript:window.sidebar.addPanel('<?php echo addslashes($site_title) ?> | <?php echo addslashes($page_title) ?>', '<?php echo $_SERVER['VIRTUAL_ROOT'] ?><?php echo $_SERVER['REQUEST_URI'] ?>', '')" id="addFavorite" title="Ajouter au favoris">+</a>
			</div>
			
			<div id="header_middle" class="wrapper">
				<?php echo $page_header ?>
				
				<?php if(count($cultures)>1): ?>
					<ul id="switch_culture">
						<?php foreach($cultures as $culture): ?>
							<li>
								<a href="<?php echo BASE_DIR ?><?php echo $culture->id ?>/" title="<?php echo $culture->label ?>">
									<img src="<?php echo BASE_DIR ?><?php echo IMG_DIR ?>flag/16/new/<?php echo $culture->id ?>.png" alt="<?php echo $culture->label ?>" <?php echo $culture->id==$lang? 'id="current_culture"':'' ?> />
								</a>
							</li>
						<?php endforeach ?>
						<li></li>
					</ul>
					<div class="clear"></div>
				<?php endif ?>
			</div>
		</header>
		
		<div id="container" class="wrapper">
			<?php echo $page_content ?>
		</div>
		
		<footer>
			<?php echo $page_footer ?>
		</footer>
		
		<?php echo $js ?>
		
		<?php if(!empty($google_analytics_id)): ?>
		<!-- Google analytique -->
		<script>
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo $google_analytics_id ?>']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
		</script>
		<?php endif ?>
	</body>
</html>