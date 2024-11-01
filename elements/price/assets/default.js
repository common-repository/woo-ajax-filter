(function($){
	"use strict";
	$(document).ready(function(){
		$('body').on('mousedown', '.nwaf-element-price .price', function(){
			$(this).siblings().removeClass('selected').find('input').attr('disabled', 'disabled');
			$(this).addClass('selected').find('input').removeAttr('disabled');
		});
	});
})(jQuery);