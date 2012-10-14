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
	<li><strong>Walk 88 m. </strong>Walk to the bus stop at Raffles Hotel, Bras Basah Road.<span class="ui-li-count">2 mins</span></li>
	<li><strong>Bus 133. </strong>Board at Raffles Hotel (02049), Bras Basah Road in about 9 min. Alight at Marina Bay MRT, Marina Street, 6 stops later.<span class="ui-li-count">10 mins</span></li>
	<li><strong>Bus 400. </strong>Board at Marina Bay MRT (03311), Marina Street in about 18 min. Alight at Marina Barrage, Marina Gardens Drive, 4 stops later.<span class="ui-li-count">24 mins</span></li>
	<li><strong>Walk 234 m. </strong>Walk to Marina Barrage.<span class="ui-li-count">4 mins</span></li>
	
	</ul>
	<br/>
	<br/>
	<ul data-role="listview" data-theme="b">
	<li><strong><center>Total time: 40 mins</center></strong></li>
	<li><strong><center>Total cost: $0.95</center></strong></li>
	</ul>
	<br/>
	<a href="map_raffles_barrage_2.php" data-ajax="false" data-role="button" data-theme="b" data-rel="dialog">Go!</a> 
	</div><!-- /content -->
	<div data-role="footer" data-id="foo1" data-position="fixed">		
	<div data-role="navbar">
		<ul>
			<li><a href="nocab.php" data-icon="check" data-iconpos="bottom">Recommended</a></li>
			<li><a href="nocab1.php" data-icon="star" data-iconpos="bottom">Fastest</a></li>
			<li><a href="nocab2.php" data-icon="minus" data-iconpos="bottom"  class="ui-btn-active ui-state-persist">Cheapest</a></li>
		</ul>
	</div><!-- /navbar -->
</div><!-- /footer -->
</div><!-- /page -->

</body>
</html>