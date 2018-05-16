"use strict";

function getGridSize_discounts () {
	return (window.innerWidth < 600) ? 1 :
		   (window.innerWidth < 1200) ? 2 : 3;
}
function getGridSize_pop () {
	return (window.innerWidth < 480) ? 1 :
		   (window.innerWidth < 650) ? 2 :
		   (window.innerWidth < 992) ? 3 :
		   (window.innerWidth < 1200) ? 3 : 4;
}
function getGridSize_postrel (type) {
	var count = 3;
	if (type == 'type-2') {
		count = 2;
	}
	return (window.innerWidth < 480) ? 1 :
		(window.innerWidth < 650) ? 2 : count;
}
function getGridSize_brands () {
	return (window.innerWidth < 400) ? 1 :
		(window.innerWidth < 550) ? 2 :
		(window.innerWidth < 650) ? 3 :
		(window.innerWidth < 992) ? 4 :
		(window.innerWidth < 1200) ? 5 : 6;
}

$(document).ready(function () {

	// Modal Images
	$('.fancy-img').fancybox({
		padding: 0,
		helpers: {
			overlay: {
				locked: false
			},
			thumbs: {
				width: 60,
				height: 60
			}
		}
	});

	// Footer Modal Blocks
	if ($('.f-block-btn').length > 0) {
		$('.f-block-btn').each(function () {
			var f_block_btn = $(this);
			var f_block_content;
			if ($(this).data('content')) {
				f_block_content = $(this).data('content');
			} else {
				f_block_content = $(f_block_btn.data('id'));
			}
			$(f_block_btn).fancybox({
				content: f_block_content,
				wrapCSS : 'f-block-modal-wrap',
				padding: 0,
				helpers: {
					overlay: {
						locked: false
					}
				}
			});
		});
	}

	// Frontpage Slider
	if ($('.fr-slider').length > 0) {
		$('.fr-slider').flexslider({
			directionNav: false,
		});
    }

	// Product Related
	if ($('#prod-related-car').length > 0) {
	    $('#prod-related-car').flexslider({
	        animation: "slide",
	        controlNav: true,
	        slideshow: false,
	    });
    }

	// Counters | Progress bar
	if ($('.facts-i-percent').length > 0) {
		var waypoints = $('.facts-i-percent').eq(1).waypoint({
			handler: function(direction) {
				$('.facts-i-percent').each(function () {

					var bar = new ProgressBar.Circle('#' + $(this).attr('id'), {
						strokeWidth: 4,
						trailWidth: 1,
						easing: 'easeInOut',
						duration: 1400,
						text: {
							autoStyleContainer: false
						},
						from: { color: '#dddddd', width: 1 },
						to: { color: '#3a89cf', width: 4 },
						step: function(state, circle) {
							circle.path.setAttribute('stroke', state.color);
							circle.path.setAttribute('stroke-width', state.width);

							var value = Math.round(circle.value() * 100);
							if (value === 0) {
								circle.setText('');
							} else {
								circle.setText(value + '<span>%</span>');
							}

						}
					});

					bar.animate($(this).data('num'));  // Number from 0.0 to 1.0

				});

				this.disable();
			},
			offset: 'bottom-in-view'
		});
	}

	// Counters
	if ($('.facts-i-num').length > 0) {
		var waypoints = $('.facts-i-num').eq(1).waypoint({
			handler: function(direction) {
				$('.facts-i-num').each(function () {
					$(this).prop('Counter',0).animate({
						Counter: $(this).data('num')
					}, {
						duration: 3000,
						step: function (now) {
							$(this).text(Math.ceil(now));
						}
					});
				});
				this.disable();
			},
			offset: 'bottom-in-view'
		});
	}

	// Catalog Images Carousel
	if ($('.prod-items-galimg .prod-i-img').length > 0) {
		$(".prod-items-galimg .prod-i-img").brazzersCarousel();
	}
	if ($('.prod-list2 .list-img-carousel').length > 0) {
		$(".prod-list2 .list-img-carousel").brazzersCarousel();
	}
	if ($('.prod-tb .list-img-carousel').length > 0) {
		$(".prod-tb .list-img-carousel").brazzersCarousel();
	}

});


$(window).load(function () {
	
	// Reviews Carousel
    if ($('.reviewscar').length > 0) {
    	$('.reviewscar').each(function () {
		    var galleryTop = new Swiper($(this), {
                roundLengths: true,
		        loop:true,
		        autoHeight:true,
		        loopedSlides: 9, //looped slides should be the same
		        spaceBetween: 10,
		    });
		    var galleryThumbs = new Swiper($(this).next('.reviewscar-thumbs'), {
		        spaceBetween: 10,
		        centeredSlides: true,
		        slidesPerView: 'auto',
		        touchRatio: 0.2,
                roundLengths: true,
		        loop:true,
		        loopedSlides: 9, //looped slides should be the same2
		        slideToClickedSlide: true
		    });
		    galleryTop.params.control = galleryThumbs;
		    galleryThumbs.params.control = galleryTop;
		});
	}

	// Special Offer Carousel
    if ($('.discounts-list').length > 0) {
    	$('.discounts-list').each(function () {
		    var flexslider_discounts = { vars:{} };
		    var discounts_this = $(this);
		    $(this).flexslider({
		        animation: "slide",
		        controlNav: false,
		        slideshow: false,
		        itemWidth: 288,
		        itemMargin: 30,
		        minItems: getGridSize_discounts(),
		        maxItems: getGridSize_discounts(),
			    start: function(slider){
			    	flexslider_discounts = slider;
			        discounts_this.resize();
			    }
		    });
		    $(window).resize(function () {
		    	var gridSize = getGridSize_discounts();
		    	if (typeof flexslider_discounts.vars !== "undefined") {
		    		flexslider_discounts.vars.minItems = gridSize;
		    		flexslider_discounts.vars.maxItems = gridSize;
		    	}
		    });

		});
	}

	// Popular Products Carousel
	if ($('.fr-pop-tab').length > 0) {
		$(".fr-pop-tab").each(function () {
		    var fr_pop_this = $(this);
			var flexslider_slider = { vars:{} };
			$(this).flexslider({
		        animation: "slide",
		        controlNav: true,
		        slideshow: false,
		        itemWidth: 270,
		        itemMargin: 12,
		        minItems: getGridSize_pop(),
		        maxItems: getGridSize_pop(),
			    start: function(slider){
			    	flexslider_slider = slider;
			        fr_pop_this.resize();
			    }
		    });
			$(window).resize(function() {
				var gridSize = getGridSize_pop();
		    	if (typeof flexslider_slider.vars !== "undefined") {
					flexslider_slider.vars.minItems = gridSize;
					flexslider_slider.vars.maxItems = gridSize;
				}
			});
		});
	}

	// Brands Carousel
	if ($('.brands-list').length > 0) {
		$('.brands-list').each(function () {
			var flexslider_brands;
			$(this).flexslider({
				animation: "slide",
				controlNav: false,
				slideshow: false,
				itemWidth: 150,
				itemMargin: 20,
				minItems: getGridSize_brands(),
				maxItems: getGridSize_brands(),
				start: function(slider){
					flexslider_brands = slider;
				}
			});
			$(window).resize(function () {
				var gridSize = getGridSize_brands();
				if (typeof flexslider_brands.vars !== "undefined") {
					flexslider_brands.vars.minItems = gridSize;
					flexslider_brands.vars.maxItems = gridSize;
				}
			});
		});
	}

	// Range Slider
	if ($('.range-slider').length > 0) {
		$('.range-slider').each(function () {
			var range_slider = $(this);
			$(range_slider).ionRangeSlider({
				type: "double",
				grid: range_slider.data('grid'),
				min: range_slider.data('min'),
				max: range_slider.data('max'),
				from: range_slider.data('from'),
				to: range_slider.data('to'),
				prefix: range_slider.data('prefix')
			});
		});
	}
	
	// Select Styles
	if ($('.chosen-select').length > 0) {
		$('.chosen-select').chosen();
	}

	// Product Articles
	if ($('#post-rel-car').length > 0) {
		var flexslider3;
		var type = 'type-1';
		if ($('#post-rel-car').data('type') == 'type-2') {
			type = 'type-2';
		}
		$('#post-rel-car').flexslider({
			animation: "slide",
			controlNav: false,
			slideshow: false,
			itemWidth: 274,
			itemMargin: 20,
			minItems: getGridSize_postrel(type),
			maxItems: getGridSize_postrel(type),
			start: function(slider){
				flexslider3 = slider;
				$("#post-rel-car").resize();
			}
		});
		$(window).resize(function() {
			var gridSize = getGridSize_postrel(type);
			flexslider3.vars.minItems = gridSize;
			flexslider3.vars.maxItems = gridSize;
		});
	}

	// Post Slider
	if ($('#post-slider-car').length > 0) {
		$('#post-slider-car').flexslider({
			smoothHeight: true,
			controlNav: false,
		});
	}

});