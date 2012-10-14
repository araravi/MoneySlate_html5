<!DOCTYPE html>
<html>
<head>
    <title>Group Setting</title>
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="apple-mobile-web-app-capable" content="yes" /> 
	<link href='http://fonts.googleapis.com/css?family=Salsa' rel='stylesheet' type='text/css'>
	<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />	
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
	</head>
<body> 
<!-- Groups listing page -->
<div data-role="page" id = "myGroups"> 
<div data-role="header">
	<h1>Groups</h1>
	<a href="groupSettings.php" data-icon="plus" class="ui-btn-right">Create</a>
	<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-icon="back" class="ui-btn-left">Back</a>
</div> <!-- header --> 
<div data-role="content">
	<div id = "groupList">
		<ul id="groupDetails" data-role="listview">
		</ul>
	</div><!--groupList-->
</div> <!-- content -->
</div> <!-- page -->
</body>
</html>