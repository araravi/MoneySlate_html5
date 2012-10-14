<!DOCTYPE HTML>
<html>
<head> 
	<title>UOMe Report</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.css" />
	<link rel="stylesheet" href="datepicker/jquery.ui.datepicker.mobile.css" />	
	<link rel="stylesheet" type="text/css" href = "styles/progressbar.css"/>
	<link rel="stylesheet" type="text/css" href = "styles/homeStyle.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="scripts/jqmProps.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.js"></script>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script src="datepicker/jQuery.ui.datepicker.js"></script>
	<script src="datepicker/jquery.ui.datepicker.mobile.js"></script>
	<script src = "scripts/jquery.json-2.3.min.js"></script>
	<script src= "scripts/uoweme-scripts.js"></script>
	<div id="fb-root"></div>
	<script src= "scripts/fb_redirect_logout.js"></script>
</head> 

<body>

<div data-role="page" id="settings">
	<div data-role="header">
	<h1>Settings</h1>
	</div>
	
	<div data-role="content">
		<div id="settingslist">
			<ul id = "settingset" class = "ui-listview" data-role="listview" data-inset="true">
			<li><a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/myGroups.php">My Groups</a></li>
			<li><a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/myExpenses.php">My Expenses</a></li>
			</ul>
		</div>
	</div>
</div>
</body>
</html>