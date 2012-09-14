/*
 * @author Yoann RENARD
 * @version 1.2
 * @since 14/01/2011
 * Plugin d'auto completion
 * Necessite jQuery
 * Developper sur jQuery 1.4.4
*/

(function($){
	
	// Plugin deleteItem
	jQuery.fn.deleteItem = function(options) {
		var settings = {
			name: '',
			file: 'AJAX_del_item.php',
			"class": ''
		};
		if(options) {
			jQuery.extend(settings, options);
		}
		
		
		$(this).bind("click", function() {
			if(confirm('Etes-vous certain de vouloir supprimer cet ' + settings.name + ' ?'))
			{
				var id = $(this).attr("rel");
				$.ajax ({
					type: 'POST',
					data: "id=" + id + "&class=" + settings.class,
					url: settings.file,
					
					success: function(data) {
						$("#module_" + id).empty().remove();
					},
		    		error: function(msg) {
						alert("error!! " + msg);
					}
				});
			}
		});
		
		return $(this);
	};

})(jQuery)