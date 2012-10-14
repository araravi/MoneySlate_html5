<!DOCTYPE html> 

<html> 

	<head>

	

		<title>Map</title>
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />

		<!--<link rel="stylesheet" type="text/css" href="css/main-mobile.css" />-->

		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.2.min.js"></script>

		<script type="text/javascript" src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>

		<script type="text/javascript" src="map/jquery.ui.map.full.min.js"></script>

		<script type="text/javascript" src="map/jquery.ui.map.extensions.js"></script>
		<script type="text/javascript" src="map_cab_js.js"></script>

	</head> 

	<body> 
		<div id="basic_map" data-role="page">

			<div data-role="header">
				<h1>Location</h1>
				<a href="index.php" data-ajax="false" data-icon="back">Back</a>
			</div>

			<div data-role="content">	
				<div class="ui-bar-c ui-corner-all ui-shadow" style="padding:1em;">
					<div id="map_canvas" style="height:350px;"></div>
					</div>
					
			</div>
		</div>	
	</body>

	

</html>