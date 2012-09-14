<?php
switch($element->display){
	
	// Tous les éléments en ligne menu
	case self::DISPLAY_INLINE_ALL_ON_BAR:
	default:
		?>
		<nav role="navigation" class="menu_inline_all_on_bar clearfix">
			<table>
				<tr>
					<?php foreach($menuItem as $key => $item): ?>
					<td class="<?php echo $filename=='#'? 'active_menu_item':''; ?>">
						<a href="<?php echo $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($item->id_page_dest, $culture) ?>" id="menu_carte">
							<?php if(!empty($item->img)): ?>
								<img src="<?php echo BASE_DIR ?><?php echo \classes\Model\MenuItem::UPLOAD_DIR ?><?php echo $item->id ?>/<?php echo $item->img ?>" alt="<?php echo $item->title ?>" />
							<?php else: ?>
								<?php echo $item->title ?>
							<?php endif ?>
						</a>
					</td>
					<?php endforeach ?>
				</tr>
			</table>
		</nav>
		<?php break; ?>
		
		
	<?php
	// Elément 1 par 1
	case self::DISPLAY_INLINE_ONE_BY_ONE:
		
		// Récupère les pages suivantes et précédentes
		$idPage = explode('-', $filename);
		foreach($menuItem as $key => $item) {
			if($idPage[0]==$item->id_page_dest)
			{
				$now = $item->title;
				
				if(isset($menuItem[$key+1]))
					$next = $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($menuItem[$key+1]->id_page_dest, $culture);
				else
					$next = $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($menuItem[0]->id_page_dest, $culture);
								
				if(isset($menuItem[$key-1]))
					$prev = $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($menuItem[$key-1]->id_page_dest, $culture); 
				else
					$prev = $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($menuItem[count($menuItem)-1]->id_page_dest, $culture); 
				break;
			}
		}
		if(!isset($now))
		{
			$now = \classes\model\Page::getTitleById($idPage[0], $culture);
			$next = $menuItem[0]->external_url==1? $menuItem[0]->url:\classes\model\Page::getPageUrl($menuItem[0]->id_page_dest, $culture);
			$prev = $menuItem[count($menuItem)-1]->external_url==1? $menuItem[count($menuItem)-1]->url:\classes\model\Page::getPageUrl($menuItem[count($menuItem)-1]->id_page_dest, $culture); 
			
		}
	?>
		<nav role="navigation" class="menu_inline_one_by_one clearfix">
			<table>
				<tr>
					<td class="home">
						<a href="<?php echo $homeUrl ?>"><img src="<?php echo BASE_DIR ?>img/icn-home.png" alt="home" /></a>
					</td>
					<td class="menu_separator"></td>
					<td class="menu_navigator">
						<a href="<?php echo $prev ?>"><img src="<?php echo BASE_DIR ?>img/icn-prev.png" alt="home" /></a>
					</td>
					<td class="menu_item">
						<span><?php echo $now ?></span>
					</td>
					<td class="menu_navigator">
						<a href="<?php echo $next ?>"><img src="<?php echo BASE_DIR ?>img/icn-next.png" alt="home" /></a>
					</td>
				</tr>
			</table>
		</nav>
		<?php break; ?>
	
		
	<?php
	// Tous les éléments en ligne texte
	case self::DISPLAY_INLINE_ALL_IN_TXT:
	?>
		<nav role="navigation" class="menu_inline_all_in_txt clearfix">
			<?php foreach($menuItem as $key => $item): ?>
				<?php if($key>0): ?>
					|
				<?php endif ?>
				<a href="<?php echo $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($item->id_page_dest, $culture) ?>"><?php echo $item->title ?></a>
			<?php endforeach ?>
		</nav>
		<?php break; ?>
		
	<?php
	// Un élément par ligne
	case self::DISPLAY_BLOCK_ONE_BY_LIGN:
	?>
		<nav role="navigation" class="menu_block_one_by_lign">
			<ul class="clearfix">
				<?php foreach($menuItem as $key => $item): ?>
					<li>
						<a href="<?php echo $item->external_url==1? $item->url:\classes\model\Page::getPageUrl($item->id_page_dest, $culture) ?>">
							<?php echo $item->title ?>
							<img src="<?php echo BASE_DIR ?>img/icn-next.png" alt="" />
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</nav>
		<?php break; ?>
<?php }
