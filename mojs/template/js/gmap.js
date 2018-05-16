(function($) {

	function allstore_new_map( $el ) {
		var $markers = $el.find('.marker');
		var args = {
			zoom		: $markers.data('zoom'),
			scrollwheel: false,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map( $el[0], args);
		map.markers = [];
		$markers.each(function(){
			allstore_add_marker( $(this), map );
		});
		allstore_center_map( map );
		return map;
	}

	function allstore_add_marker( $marker, map ) {
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
		var marker = new google.maps.Marker({
			position	: latlng,
			icon: $marker.data('marker'),
			map			: map
		});
		map.markers.push( marker );
		if( $marker.html() )
		{
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open( map, marker );
			});
		}
	}

	function allstore_center_map( map ) {
		var bounds = new google.maps.LatLngBounds();
		$.each( map.markers, function( i, marker ){
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});
		if( map.markers.length == 1 )
		{
			map.setCenter( bounds.getCenter() );
			map.setZoom( map.zoom );
		}
		else
		{
			map.fitBounds( bounds );
		}
	}

	var map = null;
	$(window).load(function(){
		$('.allstore-gmap').each(function(){
			map = allstore_new_map( $(this) );
		});
	});

})(jQuery);