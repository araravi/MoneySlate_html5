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
	<div data-role="page" id="feeds">
				<script>
				$( '#feeds' ).live( 'pageshow',function(event){
					var url = "http://mymoneyslate.com/api/feeds";
						$.getJSON(url, function(json) {
					   var element = '';
					   $.each(json.feeds, function(i,exp){
						if(exp.owe==1)
						{
							if(exp.seen==0)
							{
							element = element+'<li data-theme="b" style="text-align:center">'+ "You owe "+exp.first_name+" S$ "+exp.amount;
							element = element+'</li>';	
							}
							else
							{
							element = element+'<li style="text-align:center">'+ "You owe "+exp.first_name+" S$ "+exp.amount;
							element = element+'</li>';	
							}
						}
					   else 
					   {
							if(exp.seen==0)
							{
							element = element+'<li data-theme="e" style="text-align:center">'+ exp.first_name + " paid me "+"S$ "+exp.amount;
							element = element+'</li>';
							}
							else
							{
							element = element+'<li style="text-align:center">'+ exp.first_name + " paid me "+"S$ "+exp.amount;
							element = element+'</li>';
							}
					   }  
					   });
					   $("#feeddetails").html(element);
					   $("#feeddetails").listview('refresh');
					 });
							
				$('#alerts').attr("data-theme","b");
				$('#alerts').addClass('ui-btn-hover-b').removeClass('ui-btn-hover-a');
				$('#alerts').addClass('ui-btn-up-b').removeClass('ui-btn-up-a');
				});	
				</script>
	
	
			<div data-role="header">
			<h1>Alerts</h1>
			</div>
			
            <div data-role="content" class="ui-body ui-body-a"> 
			<ul id = "feeddetails" data-theme="a" data-role="listview" data-inset="true" ></ul>
			</div>
	</div>
	</body>

</html>
