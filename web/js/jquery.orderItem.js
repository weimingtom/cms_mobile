(function($){
	$.fn.orderItem = function(options) {
		
		var position = 0;
		
		var settings = {
			file:		'AJAX_update_order.php',
			"class":	'',
			'item':		''
		};
		var options = $.extend(settings, options);
		
		this.each(function(){
			
			var obj = $(this)/*.find("tbody")*/;
			
			// Empêcher la sélection des éléments à la sourirs (meilleure gestion du drag & drop)
			/*var _preventDefault = function(evt) { evt.preventDefault(); };
			$("tr").bind("dragstart", _preventDefault).bind("selectstart", _preventDefault);*/
			
			$(obj).sortable({
				axis: "y", // Le sortable ne s'applique que sur l'axe vertical
				//containment: ".orderItem", // Le drag ne peut sortir de l'élément qui contient la liste
				handle: ".orderItemControl", // Le drag ne peut se faire que sur l'élément .item (le texte)
				distance: 10, // Le drag ne commence qu'à partir de 10px de distance de l'élément
				opacity: 0.8, 
				cursor: 'move',
				stop: function(event, ui){
					// RÃ©attribut les bonnes couleurs aux lignes
					if(settings.item=='tr')
					{
						$(obj).find("tr").each(function(){
							$(this)
								.removeClass('lign0')
								.removeClass('lign1')
								.addClass('lign' + parseInt($(this).index()+1)%2);
						});
					}
				},
				update: function() {
					// On prépare la variable contenant les paramètres
					var order = $(this).sortable("serialize")+'&action=updateListeOrder&class='+settings.class+'&item='+settings.item;
					// $(this).sortable("serialize") sera le paramètre "element", un tableau contenant les différents "id"
					// action sera le paramètre qui permet éventuellement par la suite de gérer d'autres scripts de mise à jour
			 
					$.post(settings.file, order, function(response) {});
				}
			});
			
		});
		
		return this;
	};
})(jQuery);