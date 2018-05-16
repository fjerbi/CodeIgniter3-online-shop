/*!
 * jQuery Brazzers Carousel v1.0.0 (http://webdesign-master.ru)
 * Copyright 2015 WebDesign Master.
 */
(function($) {
	$.fn.brazzersCarousel = function(options) {
		return this.addClass("brazzers-daddy").append("<div class='tmb-wrap'><div class='tmb-wrap-table'>").append("<div class='image-wrap'>").each(function() {
			var this_wrapper = $(this);
			this_wrapper.find("img").appendTo(this_wrapper.find(".image-wrap")).each(function() {
				this_wrapper.find(".tmb-wrap-table").append("<div>");
			});
		}).find(".tmb-wrap-table").bind('touchmove', function(event) {
			event.preventDefault();
			var myLocation = event.originalEvent.changedTouches[0];
			var realTarget = document.elementFromPoint(myLocation.clientX, myLocation.clientY);
			var this_img = $(realTarget).parent(".tmb-wrap-table").closest(".brazzers-daddy").find("img");
			var all_thmbs = $(realTarget).parent(".tmb-wrap-table").find("div");
			this_img.hide().eq($(realTarget).index()).css("display", "inline-block");
			all_thmbs.removeClass("active");
			$(realTarget).addClass("active");
		}).find("div").hover(function() {
			var this_img = $(this).parent(".tmb-wrap-table").closest(".brazzers-daddy").find("img");
			var all_thmbs = $(this).parent(".tmb-wrap-table").find("div");
			this_img.hide().eq($(this).index()).css("display", "inline-block");
			all_thmbs.removeClass("active");
			$(this).addClass("active");
		}).parent().find(":first").addClass("active");
	};
})(jQuery);