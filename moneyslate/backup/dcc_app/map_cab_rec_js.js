			$('#basic_map').live("pageshow", function() {

				$('#map_canvas').gmap('refresh');

			});

			

			$('#basic_map').live("pagecreate", function() {

				$('#map_canvas').gmap({'center': '1.296259,103.854355', 'zoom': 16}).bind('init', function(evt, map) {

					$('#map_canvas').gmap('addMarker', {'position': map.getCenter(), 'animation': google.maps.Animation.DROP, 'icon': 'images/taxi.png'}).click(function() { 

						$('#map_canvas').gmap('openInfoWindow', { 'content': 'Your cab here! I will be arriving in 2 mins!'}, this);

					});

				});
		
			//add additional marker 
				$('#map_canvas').gmap('addMarker', {'position': '1.294452,103.853277', 'animation': google.maps.Animation.DROP }).click(function() { 

					$('#map_canvas').gmap('openInfoWindow', { 'content': 'You are here!'}, this);

																				});	
			});
			
	