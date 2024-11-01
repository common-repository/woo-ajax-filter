(function($){
	"use strict";
	$(document).ready(function(){
		$('.widget_product_categories').on('mousedown', 'a', function(event){
			event.preventDefault();
			$(this).toggleClass('selected');
			$(this).attr('href', '#');
			return false;
		});
	});
})(jQuery);