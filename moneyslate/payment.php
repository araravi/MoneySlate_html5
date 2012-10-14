<!DOCTYPE html>
<html>
<head> 
	<title>UOMe Make a Payment</title> 
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
<div id="fb-root"></div>
<script src= "scripts/fb_redirect_logout.js"></script>
<div data-role="page" id="addPaymentPage">

 
	<div data-role="header" id = "homehead">
        <h1>Make a payment</h1>
	<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-icon="check" data-theme='b' class="ui-btn-right" id="paySubmit">Submit</a>
	<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-role="button" data-icon="home" class="ui-btn-left">Home</a> 
	</div>
	<div data-role="content">
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
	</div><!--content-->
	<div id='paymentValidateMsg' style='text-align:center;display:none' class='ui-body ui-body-e'>
	<div>
	
</div>
</body>
</html>
