/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

	function initialize() {
		var mapElement = $('#gMap');
		var mapOptions = {
			zoom: 8,
			center: new google.maps.LatLng(0, 0 ),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		var gmap = new google.maps.Map(document.getElementById('gMap'),
		mapOptions);
		
		// Add first marker
		var point = new google.maps.LatLng(mapElement.attr('lat'), mapElement.attr('lng') );
		gmap.setCenter(point);

		var marker = new google.maps.Marker({
			map: gmap, 
			title: mapElement.attr('title'),
			position: point
		});		

		google.maps.event.trigger(gmap, 'resize');

	}

	function loadMapScript() {
		var script = document.createElement('script');
		script.type = 'text/javascript';
		script.src = 'https://maps.googleapis.com/maps/api/js?sensor=false&' +
			'callback=initialize';
		document.body.appendChild(script);
	}



