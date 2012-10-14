<!DOCTYPE html>
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
</head> 
<body> 
<div id="fb-root"></div>
<script src= "scripts/fb_redirect_logout.js"></script>
<div data-role="page" id="addPaymentPage">
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
 
	<div data-role="header" id = "homehead">
        <h1>Make a payment</h1>
	<a href="#" data-icon="check" data-theme='b' class="ui-btn-right" id="paySubmit">Submit</a>
	<a href="home.php" data-role="button" data-icon="back" class="ui-btn-left">Back</a> 
	</div>
	<div data-role="content" class="ui-body ui-body-a">
		<div id="paySelect_div" data-role="fieldcontain" class="ui-hide-label">
			<label for="pay" class="select">Choose payment to be made:</label>
			<select name="pay" id="pay">
			<option value="0">Loading Payment List</option>
			</select>
		</div>
		<div id="payAmt_div" data-role="fieldcontain" style="display:none">
			<label for="payment_Amount">Amount:</label>
			<input type="text" name="payment_Amount" value="0" id="payment_Amount" placeholder="Amount to Pay"/>
			<div style="float:right"><button data-inline="true" id="paymentDetails" data-icon="info" data-iconpos="notext"></button></div>
		</div>	
		<div id='paymentValidateMsg' style='text-align:center;display:none' class='ui-body ui-body-b'>
		<div>
	</div><!--content-->
</div>
</body>
</html>
