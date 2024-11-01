(function($){
	"use strict";
	$(document).ready(function(){
		$('.nwaf-wrap .taxonomy-block > .title').on('click', function(){
			$(this).parent().find('> .block-options').slideToggle();
		}); 
	});
})(jQuery);