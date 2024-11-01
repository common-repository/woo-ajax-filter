(function($){
	"use strict";
	$(document).ready(function(){
		$('[class*="nwaf-element-tags"] a, .widget_product_tag_cloud a').each(function(){
			$(this).on('click', function(event){
				event.preventDefault();
				return false;
			});
			$(this).on('mousedown', function(event){
				event.preventDefault();
				$(this).toggleClass('selected');
				return false;
			});
		});
	});
})(jQuery);