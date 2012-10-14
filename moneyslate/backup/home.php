<!DOCTYPE html>
<html>
<head>
	<title>MoneySlate</title>
	<link rel="icon" type="image/png" href="/images/favicon.png" />
	<META NAME="title" content="myMoneySlate.com | Track your Social Finance" />
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
	<script src= "scripts/localStorage.js"></script>
	<script src= "scripts/offline.js"></script>
	<script src="scripts/mobiscroll-1.5.2.min.js" type="text/javascript"></script>
    <link href="styles/mobiscroll-1.5.2.min.css" rel="stylesheet" type="text/css" />	
</head>
<body>
<div id="fb-root"></div>
<script src= "scripts/fb_redirect_logout.js"></script>
<div data-role="page" id="homePage">
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
    <div data-role="header" id = "homehead" data-position="inline">
		<h1>MoneySlate</h1>
		<a href="feeder.php" data-icon="alert" class="ui-btn-right" id="alex" data-rel="dialog" >Alerts</a>
	    <a href="settings.php" data-rel="dialog" data-icon="gear" class="ui-btn-left" id="settings">Settings</a>
        <!--button data-icon="gear" style="align:right" id="logout" data-inset="true">Logout</button>-->
    </div><!-- /header -->
    <div data-role="content" class="ui-body ui-body-a">
		<div id = "staticTiles" class="ui-grid-a">
			<a href="expense.php"><div id="tile1" class="ui-block-a"><div class="leftTile"><img src = "icons/expense_new.png" style="max-width:100%;max-height:100%"/></div></div></a>
			<a href="payment.php"><div id="tile2" class="ui-block-b"><div class="rightTile"><img src = "icons/payment_new.png" style="max-width:100%;max-height:100%"/></div></div></a>
		</div>
		<div id="tileDiff">
			<div id="reportTileDiff">	
				<a href = "http://mymoneyslate.com/userreport.php" style =  "text-decoration:none">	
					<div id = "reporttile" class="tile" >
						<div id = "reporttile_content">
							<div id = "metileElement">
								<!--<center><div><img src = "http://ec2-46-137-231-62.ap-southeast-1.compute.amazonaws.com/icons/ewe.png"/></div></center>-->
								<div class="ui-grid-a">
									<div class="ui-block-a">
										<img id="repImg" src = "http://mymoneyslate.com/icons/repp.png" style="max-width:100%;max-height:100%"/>
									</div>
									<div class="ui-block-b">
										<div id='topContent'>
											<div>I owe</div>
											<div class = "tilecontent"><span class = "currency">S$</span> <span id="oweExpAmount">Loading...</span></div>
											<div class="meter red" style="width: 90%">
												<span id = "expoweBar" style="width: 0%"><span>
											</div>
										</div>
										<div id='bottomContent'>	
											<div>Others owe</div>
											<div class = "tilecontent"><span class = "currency">S$</span> <span id="needExpAmount">Loading...</span></div>
											<div class="meter" style="width: 90%">
												<span id = "expneedBar" style="width: 0%"><span>
											</div>
										</div>	
									</div>	
								</div>
							</div>
						</div><!--reporttile_content-->
					</div>
				</a>
			</div>
			<div id="meTileDiff">
				<a href = "http://mymoneyslate.com/me.php" style="text-decoration: none">
					<div id = "metile" class="tile">
						<div id = "reporttileElement">
							<!--<center><div><img src = "http://ec2-46-137-231-62.ap-southeast-1.compute.amazonaws.com/icons/ewe.png"/></div></center>-->
							<div class="ui-grid-a">
								<div class="ui-block-a">
									<img id="meImg" src = "http://mymoneyslate.com/icons/mee.png" style="max-width:100%;max-height:100%"/>
								</div>
								<div class="ui-block-b">
									<div id="expCont">
										<div>I spent</div>
										<div class = "tilecontent"><span class = "currency">S$</span> <span id="expenseMe">Loading...</span></div>
										<div>this month</div>
										<!--<div class="meter red animate" style="width: 100%">
												<span id = "meBar" style="width: 50%"><span></span></span>
										</div>-->
									</div>	
								</div>
							</div>	
						</div>
					</div>
				</a>
			</div>	
		</div>	
	</div><!-- /content -->
	<!--<div data-role="footer" data-theme = "a">
        <h4></h4>			
	</div><!-- /footer-->
</div><!-- /page -->
</body>
</html>
