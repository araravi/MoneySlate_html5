<html>
<head> 
	<title>UOMe Me</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
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

<style>
.special
{
background-color:yellow;
}
</style>
<script>

$(function(){
	var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/feeds";
		$.getJSON(url, function(json) {
	   var element = '';
	   $.each(json.feeds, function(i,exp){
	    if(exp.owe==1)
		{
		element = element+'<li data-theme="b"><h3><b>'+ "You owe "+exp.first_name+" S$ "+exp.amount+'</b></h3>';
		element = element+'</li>';	
        }
        else 
       {
	   element = element+'<li><h3><b>'+ exp.first_name + "paid me "+"S$ "+exp.amount +'</b></h3>';
	   element = element+'</li>';
	   }  
	   });
	   $("#feeddetails").html(element);
	   $("#feeddetails").listview('refresh');
	 });	
});	
</script>	
	
</head>
	
	<body>
	<div data-role="page" id="feeds">
	</script>
			<div data-role="header">
			<h1>Feeds</h1>
			</div>
			
            <div data-role="content"> 
			<ul id = "feeddetails" data-role="listview" data-inset="true"></ul>
			</div>
	</div>
	</body>

</html>
