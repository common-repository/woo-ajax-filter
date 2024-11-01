"use strict";

function NWAF(options) {
	this.options = options;
}

var NWAFo = new NWAF({
	container: '.products',
	noproduct: 'woocommerce-info',
	pagination: '.woocommerce-pagination',
	loading: false,
	loadString: '',
	loadStyle: false, // default false or loadmore or scroll
	filter_key_selectors: [ // support event for default widget and popular plugin
		{
			event: 'mouseup',
			selector: '.nwaf-filter-element',
			dataSelector: '.nwaf-filter-element',
			activebar: true
		},
		{
			event: 'mouseup',
			selector: '[data-filter-key]',
			dataSelector: '[data-filter-key]',
			activebar: true
		},
		{
			event: 'change',
			selector: '.woocommerce-ordering select',
			dataSelector: '.woocommerce-ordering select',
			activebar: false
		},
		{
			event: 'change',
			selector: '.form-wppp-select select',
			dataSelector: '.form-wppp-select select',
			activebar: false
		},
		{
			event: 'change',
			selector: '.c4d-woo-cpp-form select',
			dataSelector: '.c4d-woo-cpp-form select',
			activebar: false
		},
		{
			event: 'mouseup click',
			selector: '.woocommerce-pagination a',
			dataSelector: '.woocommerce-pagination a',
			activebar: false
		},
		{
			event: 'mouseup',
			selector: '.widget_price_filter .price_slider_wrapper .price_slider',
			dataSelector: '.widget_price_filter .price_slider_amount input',
			activebar: false,
			clear: {
				callback: function(){
					
					jQuery('.widget_price_filter .price_slider_amount input').each(function(){
						var inputName = jQuery(this).attr('name');
						if(inputName == 'min_price') {
							jQuery(this).val(jQuery(this).attr('data-min'));
						} else {
							jQuery(this).val(jQuery(this).attr('data-max'));
						}
					});

					jQuery('.price_slider').each(function(){
						jQuery(this).find('.ui-slider-range').css({
							left: '0%',
							width: '100%'
						});	
						jQuery(this).find('.ui-slider-handle').each(function(index, el){
							if (index < 1) {
								jQuery(this).css({
									left: '0%'
								});
							} else {
								jQuery(this).css({
									left: '100%'
								});
							}
						});
					});
				},
			}
		},
		{
			event: 'mouseup',
			selector: '.widget_price_filter .price_slider_amount button',
			dataSelector: '.widget_price_filter .price_slider_amount input.donotfind', // do not need,
			activebar: false
		},
		{
			event: 'mouseup',
			selector: '.widget_product_tag_cloud a',
			dataSelector: '.widget_product_tag_cloud a',
			activebar: true
		}
	],
	element_event_check: {
		select: 'change', 
		a: 'mouseup', 
		input: 'change'
	},
	complete: function(){}
});

(function($){ // jquery block

	NWAF.prototype.loading = function(status) {
		var nwafo = this;
		if ($('.nwaf-loading').length < 1) {
			$(nwafo.options.container).before('<div class="nwaf-loading">'+ nwafo.options.loadString +'</div>');
		}
		if (status == 'load') {
			$('.nwaf-loading').removeClass('hide-loading').addClass('load');
		} else {
			$('.nwaf-loading').addClass('hide-loading').removeClass('load');
			nwafo.options.loading = false;
			nwafo.options.loadStyle = false; 
		}
	};

	NWAF.prototype.build_data = function() {
		var nwafo = this,
		oFilters = {};
		
		$('.nwaf-filter-form').each(function(){
			var datas = $(this).serializeArray();
			$.each(datas, function(index, data){
				if (oFilters[data.name] == undefined) {
					oFilters[data.name] = data.value;
				} else {
					oFilters[data.name] += ',' + data.value;
				}
			});
		});
		
		$.each(nwafo.options.filter_key_selectors, function(index, el){
			$(el.dataSelector).each(function(index, el){
				var tagName = this.tagName.toLowerCase();
				if (tagName == 'a') {
					if ($(this).hasClass('selected')) {
						if (oFilters[$(this).attr('data-filter-key') + $(this).attr('data-filter-term')] == undefined) {
							oFilters[$(this).attr('data-filter-key') + $(this).attr('data-filter-term')] = $(this).attr('data-filter-value');	
						} else {
							oFilters[$(this).attr('data-filter-key') + $(this).attr('data-filter-term')] += ',' + $(this).attr('data-filter-value');
						}
					} 
				}

				if (tagName == 'select' || tagName == 'input') {
					// have to check input in form and take all selected inputs
					if (oFilters[$(this).attr('name')] == undefined) {
						oFilters[$(this).attr('name')] = $(this).val();	
					} else {
						oFilters[$(this).attr('name')] += ',' + $(this).val();
						// console.log(oFilters[$(this).attr('name')]);
					}
				}
			});
		});
		
		return oFilters;
	};
	NWAF.prototype.clear_event = function() {
		var nwafo = this;
		$.each(nwafo.options.filter_key_selectors, function(index, el){
			$(el.selector).removeAttr('onchange').parents('form').on('submit', function(event){
				event.preventDefault();
				return false;
			});
			$('body').on('click change', el.selector, function(event){
				$(this).removeAttr('onchange');
				return false;
			});
		});
	};
	NWAF.prototype.filter = function() {
		var nwafo = this;
		nwafo.ajaxRunning = false;
		
		nwafo.clear_event();

		$.each(nwafo.options.filter_key_selectors, function(index, el){
			$('body').on(el.event, el.selector, function(event){
				event.preventDefault();
				var filter = $(this),
				ajaxUrl = window.location.href,
				herf = $(filter).attr('href');
				filter.toggleClass('active'); // add this selected class instead in element js. we use settimout before get value
				if (filter.parents('.nwaf-active-filter').length > 0) return false;
				if (herf && herf != '') {
					ajaxUrl = herf;
				}
				
				if (nwafo.ajaxRunning !== false) {
					nwafo.ajaxRunning.abort();	
				}

				setTimeout(function(){ // need delay time to get selected values
					// add to active filter box
					var term = $(filter).attr('data-filter-time');
					if (term) {
						$('.nwaf-active-filter').find('[data-filter-time-clone="'+term+'"]').remove();
						var wrap = $('.nwaf-clear-filter-block'),
						count = parseInt(wrap.attr('data-count'));
						if (count > 0) {
							wrap.attr('data-count', count - 1);
							if (count == 1) {
								wrap.addClass('clear');
							}
						}
					}

					if (filter.hasClass('active') && el.activebar == true) {
						var time = $.now(),
						wrap = $('.nwaf-clear-filter-block'),
						bar = $('.nwaf-active-filter'),
						term = $(filter).attr('data-filter-term'),
						clone = $(filter).clone();
						wrap.addClass('add').removeClass('clear');
						clone.removeClass('selected').removeClass('active').attr('data-filter-time-clone', time);
						$(filter).attr('data-filter-time', time);
						if (bar.find('> .'+term).length < 1) {
							bar.append('<div class="term-block '+term+'"></div>');
						}
						bar.find('> .'+term).append(clone);		
						wrap.attr('data-count', parseInt(wrap.attr('data-count')) + 1);
					}

					nwafo.filterAjax(ajaxUrl);	
				}, 500);
				
				return false;
			});
			
			$('.nwaf-active-filter').on(el.event, el.selector, function(){
				$(this).remove();
				var time = $(this).attr('data-filter-time-clone'),
				wrap = $('.nwaf-clear-filter-block'),
				count = parseInt(wrap.attr('data-count'));
				if (count > 0) {
					wrap.attr('data-count', count - 1);
					if (count == 1) {
						wrap.addClass('clear');
					}
				}

				$('[data-filter-time="'+time+'"]').removeClass('selected').trigger(el.event);
				return false;
			})
		});
	};
	NWAF.prototype.updateItems = function(res) {
		var nwafo = this,
		products = $(res).find(nwafo.options.container).html(),
		pagination = $(res).find(nwafo.options.pagination).html(); 
		pagination =  pagination == undefined ? '' : pagination;
		products = products == undefined ? '<div class="'+ nwafo.options.noproduct +'">' + $(res).find('.'+nwafo.options.noproduct).html() + '</div>' : products;
		var items = jQuery('<div/>', {html: products}).find('li.product').addClass('add-new-item');

		// replace list product
		if (nwafo.options.loadStyle) { // scroll or load more style
			$(nwafo.options.container).append(items);
		} else {
			$(nwafo.options.container).removeClass('refresh').addClass('refresh').html(items);
			$(nwafo.options.pagination).addClass('update').html(pagination);
		}
	};
	NWAF.prototype.filterAjax = function(ajaxUrl) {
		var nwafo = this,
		dataFilter = nwafo.build_data();
		
		nwafo.ajaxRunning = $.ajax({
			url: ajaxUrl,
			method: 'GET',
			data: dataFilter,
			dataType: 'html',
			beforeSend: function(xhr) {
				nwafo.loading('load');
				var cacheDataFilter = $(nwafo).data(ajaxUrl + this.url),
				clearTime = 0,
				now = $.now();
				if (cacheDataFilter) {
					var clearTime = (now - cacheDataFilter.time) / (60 * 60 * 60);
					if (clearTime < 5) {
						nwafo.updateItems(cacheDataFilter.res);
						nwafo.loading('hide');
						nwafo.options.complete();
						xhr.abort();		
					}
				}
			},
			success: function(res){
				$(nwafo).data(ajaxUrl + this.url, {res: res, time: $.now()}); // cache data for 5 minutes
				nwafo.updateItems(res);
				nwafo.loading('hide');
				nwafo.options.complete();
			},
			complete: function() {
				nwafo.loading('hide');
				nwafo.options.complete();
			},
			fail: function (res) {
				$(nwafo).data(ajaxUrl + this.url, false); // fail need to raise flag to reset cache
				nwafo.loading('hide');
				nwafo.options.complete();
			}
		}).done(function(){
			nwafo.loading('hide');
			nwafo.options.complete();
		});
	};
	NWAF.prototype.clearFilter = function() {
		var nwafo = this;

		$('.nwaf-clear-filter').on('click', function(event){
			event.preventDefault();
			// $('.nwaf-filter-form input, .nwaf-filter-form select').each(function(){
			// 	$(this).attr('disabled', 'disabled');
			// });
			$(this).parents('.nwaf-clear-filter-block').addClass('clear');
			$('.nwaf-active-filter').html('');
			$('.nwaf-filter-element').removeClass('selected');
			$.each(nwafo.options.filter_key_selectors, function(index, el){
				$(el.dataSelector).each(function(index, el){
					var tagName = this.tagName.toLowerCase();
					if (tagName == 'a') {
						$(this).removeClass('selected');
					}
				});
				
				if (el.clear) {
					el.clear.callback();
				}
			});

			nwafo.filterAjax(window.location.href);

			return false;
		});
	};
	NWAF.prototype.loadmoreCheckNav = function() {
		var nwafo = this,
		nav = $('.woocommerce-pagination');
		nwafo.current = 0;
		nwafo.links = 0;

		nav.find('li').each(function(index, el){
			if ($(this).find('.current').length > 0) {
				nwafo.current = index;
			}
			nwafo.links++;
		});

		nav.removeClass('update');
	},
	NWAF.prototype.loadmore = function() {
		var nwafo = this,
		search = window.location.search.substring(1);

		if (typeof c4d_plugin_manager != 'undefined' && c4d_plugin_manager['c4d-woo-ajax-filter-load-style']) {
			nwafo.options.loadStyle = c4d_plugin_manager['c4d-woo-ajax-filter-load-style'];
		}

		search = decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"');
		if (search != '') {
			search = JSON.parse('{"' + search + '"}');	
			if (typeof search.loadstyle != 'undefined' ) nwafo.options.loadStyle = search.loadstyle;
		}
		
		if (!nwafo.options.loadStyle) return;

		var nwafo = this,
		wooNav = $('.woocommerce-pagination').addClass('loadmore');
		wooNav.after('<div class="c4d-woo-ajax-filter-load-more '+ nwafo.options.loadStyle +'"><span class="text">Load More</span><span class="icon"><i class="fa fa-angle-down"></i></span></div>');
		nwafo.loadmoreCheckNav();
		nwafo.options.complete = function () {
			$('.c4d-woo-ajax-filter-load-more').removeClass('loading');
		};
		$('body').on('click', '.c4d-woo-ajax-filter-load-more', function(){
			if (wooNav.hasClass('update')) {
				nwafo.loadmoreCheckNav();
				$(this).removeClass('end');
			}
			
			if (!nwafo.options.loading) {
				if (nwafo.current < nwafo.links - 1) {
					$('.woocommerce-pagination li:eq('+(nwafo.current+1)+') a').trigger('click');
					$(this).addClass('loading');
					nwafo.current++;
					nwafo.options.loadStyle = 'loadmore';
					nwafo.options.loading = 'loadmore';
					if (nwafo.current >= nwafo.links - 1) {
						$(this).addClass('end');
					}
				} else {
					$(this).addClass('end');
				}	
			}
		});

		if (nwafo.options.loadStyle == 'scroll') {
			var startScroll = 0,
			scrollButton = $('.c4d-woo-ajax-filter-load-more');
			
			$(window).scroll(function(event) {
				var end = scrollButton.offset().top,
				scroll = $(this).scrollTop(),
				viewEnd = scroll + $(window).height(),
				distance = end - viewEnd; 
				if (scroll > startScroll && distance < -100) {
					nwafo.options.loadStyle = 'scroll';
					$('.c4d-woo-ajax-filter-load-more').trigger('click');
					scrollButton.addClass('loading');
				}
				startScroll = scroll;
			});	
		}
	}

	$(document).ready(function(){
		NWAFo.filter();
		NWAFo.clearFilter();
		NWAFo.loadmore();
	});

})(jQuery);