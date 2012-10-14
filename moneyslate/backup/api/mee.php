<!DOCTYPE HTML>

<html>
<head> 
	<title>UOMe Me</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<link rel="stylesheet" href="datepicker/jquery.ui.datepicker.mobile.css" />	
	<link rel="stylesheet" type="text/css" href = "styles/progressbar.css"/>
	<link rel="stylesheet" type="text/css" href = "styles/homeStyle.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="scripts/jqmProps.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script src="datepicker/jQuery.ui.datepicker.js"></script>
	<script src="datepicker/jquery.ui.datepicker.mobile.js"></script>
	<script src = "scripts/jquery.json-2.3.min.js"></script>
	<script src= "scripts/uoweme-scripts.js"></script>
	<div id="fb-root"></div>
	<script src= "scripts/fb_redirect_logout.js"></script>
</head>
	
	<body>
		<div data-role="page">
	<script>
	function populateMe(){
	   //alert("me");
       var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/getMe/";
	   $.getJSON(url, function(json) {
	   var element = '';
	   var colorTag;
	   var percent;
	   var blah;
	   totalMeExp=json.totalexp;
	   $.each(json.Expense, function(i,exp){
		if(totalMeExp==0){
			percent = 0;
		}
		else{
			percent = parseInt((exp.amount/totalMeExp)*100);
		}
	        if(percent<=50){
			colorTag = "meter animate";
		}
		else {
			colorTag = "meter red animate";
		}
		element = element+'<li><h3><div class="ui-grid-a"><div class="ui-block-a"><b>'+ exp.category + '</b></div>';
		element = element+'<div class="ui-block-b">SGD '+ exp.amount + '<br/>';
		element = element+'<div class="' + colorTag + '" style="width: 100%"><span id='+ i + ' style="width: '+percent+'%"><span></span></span></div></div></div></h3>';
		element = element+'</li>';	
	   });
	   $("#meDetails").html(element);
	   $("#meDetails").listview('refresh');
	 });
	}
	$(function(){
		populateMe()
	});		
	</script>
			<div data-role="header" data-position="fixed">
			<h1>Me</h1>
				<a href="#" data-icon="gear" class="ui-btn-right" id="logout">Logout</a>
			<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" class="ui-btn-left" data-role="button" data-icon="home">Home</a> 
			<!--<div data-role="fieldcontain" align="center">-->
            <label for="slider">Year:</label>
            <input id="year" type="range" name="slider" id="slider" value="2011" min="2010" max="2015" width="50%" /><br>
            <label for="slider">Month:</label>
            <input id="month" type="range" name="slider" id="slider" value="10" min="1" max="12" width="50%"  />
            <!--</div>-->
			</div>
			
			<div data-role="content">
			<div data-role="fieldcontain" align="center">
            <label for="slider">Year:</label>
            <input id="year" type="range" name="slider" id="slider" value="2011" min="2010" max="2015" width="50%" /><br>
            <label for="slider">Month:</label>
            <input id="month" type="range" name="slider" id="slider" value="10" min="1" max="12" width="50%"  />
            </div>
				<ul id = "meDetails" data-role="listview" data-inset="true">
				</ul>
			</div>
		</div>
	</body>

</html>