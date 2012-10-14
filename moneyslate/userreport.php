<!DOCTYPE HTML>
<html>
<head> 
	<title>UOMe Report</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<link rel="stylesheet" href="datepicker/jquery.ui.datepicker.mobile.css" />	
	<link rel="stylesheet" type="text/css" href = "styles/progressbar.css"/>
	<link rel="stylesheet" type="text/css" href = "styles/homeStyle.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="scripts/jqmProps.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script src = "scripts/jquery.json-2.3.min.js"></script>
	<script src= "scripts/uoweme-scripts.js"></script>
	<div id="fb-root"></div>
	<script src= "scripts/fb_redirect_logout.js"></script>
</head> 

<body>


	<div data-role="page" id="reportPage" data-add-back-btn="true">

		<div data-role="header" date-position="fixed">
		<h1>Report</h1>	
			<!--<div class="ui-grid-a">
				<div class="ui-block-a" style="text-align: center"> I owe </div>
				<div id = "reportOwe" class="ui-block-b" style="text-align: center"> $0 </div>
			</div>
			<div class="ui-grid-a">
				<div class="ui-block-a" style="text-align: center"> Others Owe </div>
				<div id = "reportNeed" class="ui-block-b" style="text-align: center"> $0 </div>
			</div>-->
		</div>
		<div data-role="content">
			<center><img id="reportLoader" src="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/images/big-loader.gif"/></center>
			<ul id = "reportSet" data-role="listview">
			</ul>
		
		</div>
	</div>
</body>

</html>