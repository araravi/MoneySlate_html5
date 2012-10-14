<!DOCTYPE html> 
<html manifest="cache.manifest"> 
	<head> 
	<title>Morpheus</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
</head>

<body> 

<div data-role="page">

	<div data-role="header">
		<h1>Morpheus</h1>
	<a href="#" data-icon="delete" class="ui-btn-right" id="logout">Logout</a>
	<a href="#" data-role="button" data-icon="gear" class="ui-btn-left">Settings</a> 
	</div><!-- /header -->

	<div data-role="content">	
	<div data-role="fieldcontain">
				<label for="start">Where you at?</label>
				<input type="text" name="name" id="start" placeholder="Current Location" value=""  />
	</div>	
	<div data-role="fieldcontain">
				<label for="end">Going to?</label>
				<input type="text" name="name" id="end" placeholder="Raffles City Tower,Raffles Place" value=""  />
	</div>
	<!--buttons for cab / no cab-->

	<a href="cab.php" data-role="button" data-theme="b">Taxi</a>
	<a href="nocab.php" data-role="button" data-theme="a">Public Transport</a>
	<a href="all.php" data-role="button">All</a>
	<!-- end buttons -->
	</div><!-- /content -->

	<div data-role="footer">
		<h4>A Team Xcited Production</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>