<?php
$cd = isset($cd)? $cd:'';

$managers = \classes\model\Module::getAllWithManager();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>CMS Mobile | ADMIN</title>
		<meta charset="UTF-8">
		<meta name="robots" content="index,follow" />
		
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Maven+Pro">
		
		<script src="<?php echo $cd ?><?php echo JS_DIR ?>jquery-1.7.min.js"></script>
		<script src="<?php echo $cd ?><?php echo JS_DIR ?>modernizr.custom.72008.js"></script>
		
		<link rel="stylesheet" href="<?php echo $cd ?><?php echo CSS_DIR ?>admin.css" />
		<?php
		// INCLUDE DES FICHIERS CSS
		if(isset($page['css']) && !empty($page['css']))
		{
			if(is_array($page['css']))
			{
				foreach($page['css'] as $css)
				{
					if( file_exists(__DIR__.'/../'.CSS_DIR.$css) )
						echo '<link rel="stylesheet" href="'.CSS_DIR.$css.'" />';
					else
						echo '<link rel="stylesheet" href="'.$css.'" />';
				}
			}
		}
		?>
		
		<link rel="stylesheet" href="<?php echo $cd ?><?php echo CSS_DIR ?>jPicker/jPicker-1.1.6.min.css" />
	</head>
	<body>
		<!--[if lt IE 7]>
		<style type="text/css">
		#ie6msg{border:3px solid #090; margin:8px 0; background:#cfc; color:#000;}
		#ie6msg h4{margin:8px; padding:0;}
		#ie6msg p{margin:8px; padding:0;}
		#ie6msg p a.getie7{font-weight:bold; color:#006;}
		#ie6msg p a.ie6expl{font-weight:normal; color:#006;}
		</style>
		<div id="ie6msg">
		<h4>Savez-vous que votre navigateur est obsolète&nbsp;?</h4>
		<p>Pour naviguer de la manière la plus satisfaisante sur notre site, nous recommandons que vous procédiez à une mise à jour de votre navigateur. La mise à jour est gratuite et disponible <a class="getie7" href="http://www.microsoft.com/windows/downloads/ie/getitnow.mspx">ici</a>. Si vous utilisez un PC au travail, veuillez contacter votre service informatique.</p>
		<p>Si vous le souhaitez, vous pouvez aussi essayer d'autres navigateurs Web populaires comme par exemple <a class="ie6expl" href="http://mozilla.com">FireFox</a>, <a class="ie6expl" href="http://www.opera.com">Opera</a> ou <a class="ie6expl" href="http://www.apple.com/safari/download/">Safari</a></p>
		</div>
		<![endif]-->
		<div id="container">
			<header>
				<div class="fright acenter">
					<img src="<?php echo $cd ?>img/logo_mmc.gif" alt="" />
					<p>
						<a href="disconnect.php">Déconnexion</a>
					</p>
				</div>
				<a href="<?php echo $cd ?>">LOGO</a>
				<div class="clear"></div>
				
				
				
				<nav role="navigation" id="menu_principal" class="clearfix">
					<?php 
					$uri		= explode('/', $_SERVER['REQUEST_URI']);
					$filename	= $uri[count($uri)-1];
					?>
					<ul>
						<li><a href="<?php echo $cd ?>admin/edit_conf.php" class="<?php echo $filename=='edit_conf.php'? 'active_menu_item':''; ?>">Infos Générales</a></li>
						<li>
							<a href="<?php echo $cd ?>admin/page.php" class="<?php echo $filename=='page.php'? 'active_menu_item':''; ?>">Editer les Pages</a>
							<ul class="submenu">
								<li><a href="<?php echo $cd ?>admin/page.php" class="<?php echo $filename=='page.php'? 'active_menu_item':''; ?>">Liste de pages</a></li>
								<li><a href="<?php echo $cd ?>admin/edit_page.php" class="<?php echo $filename=='edit_page.php'? 'active_menu_item':''; ?>">Ajouter une page</a></li>
								<li><a href="<?php echo $cd ?>admin/edit_include.php?id=<?php echo \classes\model\Page::HEADER_ID ?>" class="<?php echo ($filename=='edit_include.php' && $_GET['id']==\classes\model\Page::HEADER_ID)? 'active_menu_item':''; ?>">Editer le header</a></li>
								<li><a href="<?php echo $cd ?>admin/edit_include.php?id=<?php echo \classes\model\Page::FOOTER_ID ?>" class="<?php echo ($filename=='edit_include.php' && $_GET['id']==\classes\model\Page::FOOTER_ID)? 'active_menu_item':''; ?>">Editer le footer</a></li>
							</ul>
						</li>
						<li><a href="<?php echo $cd ?>admin/menu.php" class="<?php echo $filename=='menu.php'? 'active_menu_item':''; ?>">Editer les Menu</a></li>
						
						<li>
							<a href="#" class="<?php echo $filename=='page.php'? 'active_menu_item':''; ?>">Extras</a>
							<ul class="submenu">
								<?php foreach($managers as $manager): ?>
									<li><a href="<?php echo $cd ?>admin/manager.php?manager=<?php echo $manager->folder ?>"><?php echo $manager->title ?></a></li>
								<?php endforeach ?>
							</ul>
						</li>
						
						<li><a href="<?php echo $cd ?>admin/component.php" class="<?php echo $filename=='component.php'? 'active_menu_item':''; ?>">Modules/Templates</a></li>
					</ul>
				</nav>
			</header>