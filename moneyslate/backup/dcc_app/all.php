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

<div data-role="page">

	<div data-role="header">
		<h1>Morpheus</h1>
	<a href="#" data-icon="delete" class="ui-btn-right" id="logout">Logout</a>
	<a href="index.php" data-role="button" data-icon="back" class="ui-btn-left">Back</a> 
	</div><!-- /header -->

	<div data-role="content">	
	<ul data-role="listview" data-theme="g">
	<li><a href="#"><strong>Cab.</strong> Will arrive to your location shortly.<span class="ui-li-count">3 mins</span></a></li>
	
	</ul>
	<br/>
	<br/>
	<ul data-role="listview" data-theme="b">
	<li><strong><center>Total time: 15 mins</center></strong></li>
	<li><strong><center>Total cost: $23.4</center></strong></li>
	</ul>
	<br/>
	<a href="cab_rec.php" data-ajax="false" data-role="button" data-theme="b" data-rel="dialog">Go!</a> 
	</div><!-- /content -->
	<div data-role="footer" data-id="foo1" data-position="fixed">		
	<div data-role="navbar">
		<ul>
			<li><a href="all.php" data-icon="check" data-iconpos="bottom" class="ui-btn-active ui-state-persist">Recommended</a></li>
			<li><a href="all1.php" data-icon="star" data-iconpos="bottom">Fastest</a></li>
			<li><a href="all2.php" data-icon="minus" data-iconpos="bottom">Cheapest</a></li>
		</ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>