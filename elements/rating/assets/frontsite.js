(function($){
	"use strict";
	$(document).ready(function(){
		$('.nwaf-element-rating').on('mousedown', 'a', function(event){
			event.preventDefault();
			$(this).parents('li').siblings().find('a').removeClass('selected');
			$(this).toggleClass('selected');
			return false;
		});
	});
})(jQuery);