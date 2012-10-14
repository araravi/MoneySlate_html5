<!DOCTYPE html> 
<html> 
	<head> 
	<title>Morpheus</title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
</head> 
<body> 

<div data-role="page" data-theme="a" data-content-theme="a">

	<div data-role="header">
		<h1>Taxi Alert</h1>

	</div><!-- /header -->

	<div data-role="content">	
<center><h2>Offer Alert</h2></center>
	
	<center><h3>Taxi number SAB 1234C has requested to pick you up</h3>
	<h4>Total Journey Time : 38 mins</h4> 
	<h4>ETA : 3 mins</h4>
	<h4>Appoximate Fare : $25.6 </h4> </center>
	
	<!--buttons for cab / no cab-->

	<a href="map_cab.php" data-role="button" data-theme="b" data-ajax="false">Accept</a>
	<a href="index.php" data-role="button">Decline</a>
	<!-- end buttons -->
	</div><!-- /content -->

	<div data-role="footer">
		<h4>A Team Xcited Production</h4>
	</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>