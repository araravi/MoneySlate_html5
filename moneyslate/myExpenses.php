<!DOCTYPE HTML>
<html>
<head> 
	<title>UOMe Recent Expenses</title> 
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
	<div data-role="page" id="myExpenses">
	<script>
	function getExpenseList()
	{
		url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/expenses";
		expenseList = "";
		var element ='';
		var myExpenses;
		$.getJSON(url, function(json){
			if(json.expenses==undefined){
				$('#recentExpenses').parent().html('<h3 style = \"text-align:center\">No Expenses Yet</h3>');
			}
			myExpenses = json.expenses;
			for(var i=0; i<myExpenses.length; i++)
			{  
				expenseList += "<li><a href=\"expense.php?exp_id=" +myExpenses[i].exp_id+ "\"><span class = \"expenseName\">"+myExpenses[i].exp_name+"</span><span class = \"expenseDate\">"+myExpenses[i].exp_date + "</a></li>";
			}
			$('#recentExpenses').html(expenseList);
			$('#recentExpenses').listview('refresh');
		});
		
		
	}
	
	$( '#myExpenses' ).live( 'pageinit',function(event){
		getExpenseList();
	});
	</script>
	
		<div data-role="header">
		<h1>My Expenses</h1>
		<a href="#" data-icon="gear" class="ui-btn-right" id="logout">Logout</a>
		<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-role="button" data-icon="back" class = "ui-btn-left">Back</a> 
			
		</div>
		<div data-role="content">
			<ul id = "recentExpenses" class = "ui-listview" data-role="listview" data-inset="true">
			</ul>
		</div>	
		<div data-role = "footer">
		<H4></H4>
		</div>
	</div>
</body>

</html>