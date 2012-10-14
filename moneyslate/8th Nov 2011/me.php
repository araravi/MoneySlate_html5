<!DOCTYPE HTML>

<html>
<head> 
	<title>MoneySlate</title> 
	<meta name="description" content="MoneySlate Social Finance Tracker" />
	<meta name="keywords" content="MoneySlate,MyMoneySlate,mymoneyslate,moneyslate,slate,money,expense,tracker,expensetracker,finance,social,tracker,addexpense,makepayment,report,me,groups,creategroups,myexpense,editgroups,categories" />
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
	<div id="fb-root"></div>
	<script src= "scripts/fb_redirect_logout.js"></script>
</head>
	
	<body>
	<div data-role="page" id="mePage">
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
			<div data-role="header">
			<h1>Me</h1>
			<a href="home.php" class="ui-btn-left" data-role="button" data-icon="back">Back</a> 
		    </div>
			
            <div data-role="content" class="ui-body ui-body-a"> 
			<center><div data-role="fieldcontain">
			<fieldset data-role="controlgroup" data-type="horizontal">
			<legend></legend>
				
				<label for="select-choice-month">Month</label>
				<select name="select-choice-month" id="select-choice-month">
					<option value="1">Jan</option>
					<option value="2">Feb</option>
					<option value="3">Mar</option>
					<option value="4">Apr</option>
					<option value="5">May</option>
					<option value="6">June</option>
					<option value="7">July</option>
					<option value="8">Aug</option>
					<option value="9">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
				</select>

				<label for="select-choice-year">Year</label>
				<select name="select-choice-year" id="select-choice-year">
					<option value="2010">2010</option>
					<option value="2011">2011</option>
					<option value="2012">2012</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
				</select>
				
				<button name="fetch" id="fetch" data-theme="b">Fetch</button>
			</fieldset>
         
		</div></center>
		
			
			<ul id = "meDetails" data-theme="a" data-role="listview" data-inset="true"></ul>
			</div>
		</div>
	</body>

</html>