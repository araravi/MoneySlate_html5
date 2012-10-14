<!DOCTYPE HTML>
<html>
<head> 
	<title>MoneySlate</title> 
	<meta name="description" content="MoneySlate Social Finance Tracker" />
	<meta name="keywords" content="MoneySlate,MyMoneySlate,mymoneyslate,moneyslate,slate,money,expense,tracker,expensetracker,finance,social,tracker,addexpense,makepayment,report,me,groups,creategroups,myexpense,editgroups,categories" />
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="apple-mobile-web-app-capable" content="yes" /> 
	<link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="styles/moneyslate.min.css">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile.structure-1.0rc2.min.css" /> 
	<link rel="stylesheet" type="text/css" href = "styles/progressbar.css"/>
	<link rel="stylesheet" type="text/css" href = "styles/homeStyle.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="scripts/jqmProps.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script src = "scripts/jquery.json-2.3.min.js"></script>
	<script src= "scripts/uoweme-scripts.js"></script>
	<script src="scripts/mobiscroll-1.5.2.min.js" type="text/javascript"></script>
    <link href="styles/mobiscroll-1.5.2.min.css" rel="stylesheet" type="text/css" />
	<div id="fb-root"></div>
	<script src= "scripts/fb_redirect_logout.js"></script>
</head> 

<body>

<div data-role="page" id="settings">
	<div data-role="header">
	<h1>Settings</h1>
	</div>
	
	<div data-role="content" class="ui-body ui-body-a">
		<div id="settingslist">
			<ul id = "settingset" class = "ui-listview" data-theme="a" data-role="listview" data-inset="true">
			<li><a href="myGroups.php">My Groups</a></li>
			<li><a href="myExpenses.php">My Expenses</a></li>
			<li><a href="#" class="ui-btn-right" id="logout">Logout</a>
			</ul>
		</div>
	</div>
</div>
</body>
</html>