(function($){
	$(document).ready(function(){
		$('.nwaf-filter-menu ul .menu-item a').each(function(){
			$(this).addClass('nwaf-filter-element');
			$(this).on('mousedown', function(event){
				event.preventDefault();
				$(this).parents('ul').find('> li > a').removeClass('selected');
				$(this).toggleClass('selected');
			});
		});
	});
})(jQuery)