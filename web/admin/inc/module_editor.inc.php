<?php
// Ajout d'un module
if(isset($_GET['action']) && $_GET['action'] == 'addModule' && isset($_GET['module']) && intval($_GET['module'])!='')
{
	$values = array(
		'order' 				=> 0,
		'datas'					=> '',
		'fk_module'				=> $_GET['module'],
		'fk_page_translation'	=> $id,
		'culture'				=> $culture,
		'status'				=> 0
	);
	\classes\model\ModuleItem::set(0, $values);
	
	header('Location: '.$_SERVER['PHP_SELF'].'?id='.$id.'&culture='.$culture);
}

$module_list		= \classes\model\Module::getValid();
$module_selected	= \classes\model\ModuleItem::getAll($id, $culture);
?>

<div class="cleargix">
	<div class="fleft w71m">
		<h3>Gestion du contenu de la page</h3>
		
		<div id="orderItem">
			<?php foreach($module_selected as $oModule): ?>
				<div class="contenu_modules" id="module_<?php echo $oModule->id ?>">
					<div class="contenu_modules_title">
						<span class="icn orderItemControl">order</span>
						<span class="contenu_modules_title_title"><?php echo $oModule->title ?></span>
						<a href="javascript:void(0);" class="icn icn-chevron">Afficher/masquer</a>
						<a href="javascript:void(0);" class="icn icn-del delete" rel="<?php echo $oModule->id ?>">Supprimer</a>
						<a href="javascript:void(0);" class="icn icn-status<?php echo $oModule->status==1? ' connect':'' ?>">Status</a>
						<div class="clear"></div>
					</div>
					<div class="contenu_modules_content">
					<?php
					include_once(__DIR__.'/../../../'.MODULE_DIR.$oModule->folder.'/module.class.php');
					$class = 'Module'.ucfirst($oModule->folder);
					
					$moduleItem = new $class();
					echo $moduleItem->set($oModule->id, $oModule, $culture, $_POST);
					?>
					</div>
				</div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="fleft w28">
		<h3>Ajouter des blocks</h3>
		
		<?php foreach($module_list as $oModule): ?>
			<a href="<?php echo $_SERVER['REQUEST_URI'] ?>&culture=<?php echo $culture ?>&action=addModule&module=<?php echo $oModule->id ?>" class="add_module">
				<img src="<?php echo BASE_DIR ?>img/admin/mini_add.png" alt="" /><?php echo $oModule->title ?>
			</a>
		<?php endforeach ?>
	</div>
</div>


<script>
$("document").ready(function() {
	$(".icn-chevron").click(function() {
		$(this).parent().next('.contenu_modules_content').slideToggle();
	})
	
	// Update du status
	$(".icn-status").click(function() {
		var id = $(this).parent().parent().attr("id");
		var id = id.substr(7, id.length);
		var status = $(this).hasClass("connect")? 0:1;
		var oThis = $(this);
		
		$.ajax ({
			type: "post",
			data: "id=" + id + "&status=" + status,
			url: "AJAX_update_status_module.php",
			success: function(data) {
				if(status==0)
					oThis.removeClass("connect");
				else
					oThis.addClass("connect");
			},
    		error: function(msg) {
				alert("error!! " + msg);
			}
		});
	})
	
	// Order by
	$("#orderItem").orderItem({
		"class":	'ModuleItem',
		'item':		'module'
	});

	// Supprime un module
	$(".delete").deleteItem({
		name: 'Module',
		"class": 'ModuleItem'
	});

	// Déplie les moduleBox qui ont été modifiées
	$(".warning_box, .valid_box, .error_box").parent().parent().slideDown();
	$(".showAdmin").parent().slideDown();
})
</script>