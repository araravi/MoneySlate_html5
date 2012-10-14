<!DOCTYPE HTML>
<html>
<head> 
	<title>UOMe</title> 
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

<div id="content" align="center">
<script type="text/javascript">
$(function(){
alert("sad");

/*var now = new Date();
alert(now.getFullYear());
$('#year').attr('value', now.getFullYear());*/
});
</script>
<div data-role="fieldcontain">
   <label for="slider">Year:</label>
   <input id="year" type="range" name="slider" id="slider" value="2011" min="2010" max="2015"  /><br>
   <label for="slider">Month:</label>
   <input id="month" type="range" name="slider" id="slider" value="10" min="1" max="12"  />
</div>
</div>
</body>
</html>