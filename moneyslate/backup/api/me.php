<?php require_once("auth/includes/functions.php");?>
<?php require_once("auth/includes/session.php");?>
<?php if(!logged_in()){
	header("Location: auth/login.php");
	exit;
	}
?>
<!DOCTYPE HTML>

<html>
	<head>
<head>
	<title>Me</title>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href = "styles/progressbar.css"/>
	<link rel="stylesheet" type="text/css" href = "styles/homeStyle.css"/>
	<script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
	<script>
	//reset type=date inputs to text
	$( document ).bind( "mobileinit", function(){
	$.mobile.page.prototype.options.degradeInputs.date = true;
	});
	$(document).bind("mobileinit", function () {
	    $.mobile.ajaxLinksEnabled = false;
	});
	
	</script>
	<script type="text/javascript" src="scripts/init.js"></script>
	<script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>
	<link rel="apple-touch-icon-precomposed" href="images/me.png" />
	<!-- startup image for web apps - iPad - landscape (748x1024) -->
	<link rel="apple-touch-startup-image" href="images/ipad_landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)" />
	<!-- startup image for web apps - iPad - portrait (768x1004) -->
	<link rel="apple-touch-startup-image" href="images/ipad_portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)" />
	<script type="text/javascript" src="scripts/googleanalytic.js"></script>
</head>

	</head>
	
	<body>
		<div data-role="page">
	<script>
	function populateMe(){
        var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/getMe/" + <?php echo getUserId(); ?>;
	$.getJSON(url, function(json) {
	   var element = '';
	   var colorTag;
	   var percent;
	   var blah;
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
		element = element+'<li><a href="#" data-rel="dialog"><h3><div class="ui-grid-a"><div class="ui-block-a" style="text-align: center"><b>'+ exp.category + '</b></div>';
		element = element+'<div class="ui-block-b" style="text-align: left">SGD '+ exp.amount + '<br/>';
		element = element+'<div class="' + colorTag + '" style="width: 50%"><span id='+ i + ' style="width: '+percent+'%"><span></span></span></div></div></div><h3>';
		element = element+'</a></li>';	
	   });
	   $("#meDetails").html(element);
	   $("#meDetails").listview('refresh');
	 });
	
	}
		
	var totalMeExp;
	function setMeHead(){
	var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/metile/" + <?php echo getUserId(); ?>;
		$.getJSON(url, function(json) {
				totalMeExp = json.amount;
				$("#meSpend").text("SGD " + totalMeExp);
				populateMe();	
		 });
	}
	$(function(){
		setMeHead();
	});	
	</script>
			<div data-role="header" data-position="fixed">
				<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/index.php" data-role="button" data-icon="back">Home Page</a> 
				<h1>Me</h1>
				<div class="ui-grid-a">
					<div class="ui-block-a" style="text-align: center"> Total spending </div>
					<div id = "meSpend" class="ui-block-b" style="text-align: center"> $0</div>
				</div>
			</div>
			<div data-role="content">
				<ul id = "meDetails" data-role="listview" data-inset="true">
				</ul>
			</div>
		</div>
	</body>

</html>