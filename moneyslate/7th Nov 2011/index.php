<!DOCTYPE html> 
<html> 
	<head> 
	<title>UOMe</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="apple-mobile-web-app-capable" content="yes" /> 
	<link href='http://fonts.googleapis.com/css?family=Salsa' rel='stylesheet' type='text/css'>
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
	<script type="text/javascript">

	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-26848914-1']);
	  _gaq.push(['_trackPageview']);

	  (function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();

	</script>
</head> 
<body> 

<div data-role="page">
     
	<div data-role="header">
		
	<center><fb:login-button autologoutlink="true" perms="email"></fb:login-button></center>
	<div id="fb-root">
		</div>
    <script src="scripts/fb_login.js"></script>		
	</div><!-- /header -->

	<div>	
		<img src="http://ec2-46-137-231-62.ap-southeast-1.compute.amazonaws.com/images/logo.png" style="max-width:100%;max-height:100%" alt="UOMe" />		
	</div>

	
</div><!-- /page -->

</body>
</html>