<!DOCTYPE html> 

<html> 

	<head>
	
	

		<title>Map</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />

		<!--<link rel="stylesheet" type="text/css" href="css/main-mobile.css" />-->

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>

		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0b2/jquery.mobile-1.0b2.min.js"></script>

		<script type="text/javascript" src="map/jquery.ui.map.full.min.js"></script>

		<script type="text/javascript" src="map/jquery.ui.map.extensions.js"></script>



		<script type="text/javascript">

			

			$('#basic_map').live("pageshow", function() {

				$('#map_canvas').gmap('refresh');

			});

			

			$('#basic_map').live("pagecreate", function() {

				$('#map_canvas').gmap({'center': '1.294436,103.853277', 'zoom': 16}).bind('init', function(evt, map) {

					$('#map_canvas').gmap('addMarker', {'position': map.getCenter(), 'animation': google.maps.Animation.DROP}).click(function() { 

						$('#map_canvas').gmap('openInfoWindow', { 'content': 'You are here!'}, this);

					});

				});
		
			//add additional marker 
				$('#map_canvas').gmap('addMarker', {'position': '1.293228,103.852252', 'animation': google.maps.Animation.DROP,  'icon': 'images/mrt.png' }).click(function() { 

					$('#map_canvas').gmap('openInfoWindow', { 'content': 'City Hall MRT'}, this);

																				});	
			//add additional marker 
				$('#map_canvas').gmap('addMarker', {'position': '1.276067,103.854682', 'animation': google.maps.Animation.DROP,  'icon': 'images/bus.png' }).click(function() { 

					$('#map_canvas').gmap('openInfoWindow', { 'content': 'Bus 400<br/><span style="color:red">Bus Arriving in 2 mins</span><br/><span style="color:green">Next bus in 9 mins</span>'}, this);

																				});	
			//add additional marker 
				$('#map_canvas').gmap('addMarker', {'position': '1.27436,103.856678', 'animation': google.maps.Animation.DROP }).click(function() { 

					$('#map_canvas').gmap('openInfoWindow', { 'content': 'Marina Barrage'}, this);

																				});																					
			});
			
	


		</script>

	</head> 

	<body> 
		<div id="basic_map" data-role="page">

			<div data-role="header">
				<h1>Map</h1>
				<a href="nocab.php" data-ajax="false" data-icon="back">Back</a>
			</div>

			<div data-role="content">	
				<div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
					<div id="map_canvas" style="height:350px;"></div>
						</div>
					<a href="onbus.php" data-role="button" data-theme="b" data-rel="dialog">Bus Tap</a> 
					<a href="onmrt.php" data-role="button" data-theme="b" data-rel="dialog">MRT Tap</a> 
			</div>
		</div>	
	</body>

	

</html>