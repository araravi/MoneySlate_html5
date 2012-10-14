			$('#basic_map').live("pageshow", function() {

				$('#map_canvas').gmap('refresh');

			});

			

			$('#basic_map').live("pagecreate", function() {

				$('#map_canvas').gmap({'center': '1.319841,103.756996', 'zoom': 16}).bind('init', function(evt, map) {

					$('#map_canvas').gmap('addMarker', {'position': map.getCenter(), 'animation': google.maps.Animation.DROP, 'icon': 'images/taxi.png'}).click(function() { 

						$('#map_canvas').gmap('openInfoWindow', { 'content': 'Your cab here! I will be arriving in 5 mins!'}, this);

					});

				});
		
			//add additional marker 
				$('#map_canvas').gmap('addMarker', {'position': '1.316623,103.761867', 'animation': google.maps.Animation.DROP }).click(function() { 

					$('#map_canvas').gmap('openInfoWindow', { 'content': 'You are here!'}, this);

																				});	
			});
			
	