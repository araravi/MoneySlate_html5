<!DOCTYPE HTML>
<html>
<head> 
	<title>UOMe Report</title> 
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
	<div id="fb-root"></div>
	<script src= "scripts/fb_redirect_logout.js"></script>
</head>

<body>
	<div data-role="page" id="reportDetails" data-add-back-btn="true">
		<script>
			function populateTransacs(){
			var url = "http://ec2-46-137-231-62.ap-southeast-1.compute.amazonaws.com/api/report_det.php?owe=" + <?php echo $_GET['mem_id'];?>;
			$.getJSON(url, function(json) {
			   var element = '';
			   var owe_count = json.Owe_count;
			   var need_count = json.Need_count;
			   var need_element = "";	
			   var owe_element = "";
			   var maptag = "";
			   var translatitude;
			   var translongitude;	
			   
			   if(need_count!=0){
				$.each(json.Need_from, function(i,need){
				translatitude = need.lat;
				translongitude = need.longt;
					if(translatitude==-1||translongitude==-1){
						maptag='<b>No location</b>';
					}
					else{
						maptag='<a data-ajax="false" href = "http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/mapwork.php?lat='+translatitude+'&longt='+translongitude+'&mem_id='+<?php echo $_GET['mem_id'];?>+'&exp_name='+need.exp_name+'">Location</a>'; 
					}
					/*need_element = need_element + '<li><h3><div class="ui-grid-c">';
					need_element = need_element + '<div class="ui-block-a" style="text-align: center"> <b> '+need.exp_date+' </b> </div>';
					need_element = need_element + '<div class="ui-block-b" style="text-align: center">'+need.exp_name+'</div>';
					need_element = need_element + '<div class="ui-block-c" style="text-align: center"> <b> S$'+need.amount+' </b> </div>';
					need_element = need_element + '<div class="ui-block-d" style="text-align: center">'+maptag+'</div>';
					need_element = need_element + '</div><h3></li>';		*/
					//need_element+='<li><h3><div class="ui-grid-a">';
					need_element+='<li>S$ '+need.amount+' for '+need.exp_name+' on '+need.exp_date+' </li>';
					//need_element+='<div class="ui-block-b">'+maptag+'</div>';
					//need_element+='</div></h3></li>';
				});
			   }
			   else if(need_count==0){
					need_element = '<li><h3><?php echo $_GET['mem_name'];?> doesn\'t owe you</h3></li>';
			   }
			   if(owe_count!=0){
				$.each(json.Owe_to, function(i,owe){
					translatitude = owe.lat;
					translongitude = owe.longt;
					if(translatitude==-1||translongitude==-1){
						maptag='<b>No location<b>';
					}
					else{
						maptag='<a data-ajax="false" href = "http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/mapwork.php?lat='+translatitude+'&longt='+translongitude+'&mem_id='+<?php echo $_GET['mem_id'];?>+'&exp_name='+owe.exp_name+'">Location</a>';
					}
					/*owe_element = owe_element + '<li><h3><div class="ui-grid-c">';
					owe_element = owe_element + '<div class="ui-block-a" style="text-align: center"> <b> '+owe.exp_date+' </b> </div>';
					owe_element = owe_element + '<div class="ui-block-b" style="text-align: center">'+owe.exp_name+'</div>';
					owe_element = owe_element + '<div class="ui-block-c" style="text-align: center"> <b> S$'+owe.amount+' </b> </div>';
					owe_element = owe_element + '<div class="ui-block-d" style="text-align: center">'+maptag+'</div>';
					owe_element = owe_element + '</div><h3></li>';*/
					//owe_element+='<li><h3><div class="ui-grid-a">';
					owe_element+='<li>S$ '+owe.amount+' for '+owe.exp_name+' on '+owe.exp_date+' </li>';
					//owe_element+='<div class="ui-block-b">'+maptag+'</div>';
					//owe_element+='</div></h3></li>';
				});
			   }
			   else if(owe_count==0){
					owe_element = '<li><h3>You don\'t owe <?php echo $_GET['mem_name'];?></h3></li>'; 
			   }
			   $("#needtransactions").html(need_element);
			   $("#owetransactions").html(owe_element);
			   $("#needtransactions").listview('refresh');
			   $("#owetransactions").listview('refresh');
			 });
			
			}
			$('#reportDetails').live('pageshow',function(){
				populateTransacs();
			});
		</script>
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
			<h1><?php echo $_GET['mem_name'];?></h1>
		</div>
		<div data-role="content" class="ui-body ui-body-a">
			<div id = "needs">
			<h2 style = "color:#3ed853"> I need to get</h2>
			<ul id = "needtransactions" class = "ui-listview" data-role="listview" data-inset="true">			
			</ul>
			</div>
			<div id = "owes">
			<h2 style = "color:#f25959">I owe</h2>
			<ul id = "owetransactions" class = "ui-listview" data-role="listview" data-inset="true">
			</ul>
			</div>	
		</div>
	</div>
</body>

</html>