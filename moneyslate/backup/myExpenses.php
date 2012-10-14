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
</head> 

<body>
	<div data-role="page" id="myExpenses">
	<script>
	function getExpenseList()
	{
		url = "http://mymoneyslate.com/api/expenses";
		var expenseList = "";
		var element ='';
		var myExpenses = new Array();
		$.getJSON(url, function(json){
			if(json.expenses==undefined){
				$('#recentExpenses').parent().html('<h3 style = \"text-align:center\">No Expenses Yet</h3>');
			}
			myExpenses = json.expenses;
			$.each(myExpenses,function(i,myexp)
			{  
				expenseList += "<li id='"+myexp.exp_id+"-expDel'><a href='/expense.php?exp_id="+myexp.exp_id+"'><span class = \"expenseName\">"+myexp.exp_name+"</span><span class = \"expenseDate\">"+myexp.exp_date + "</a><a expid="+myexp.exp_id+" id='expDel-"+myexp.exp_id+"' href='#'>Delete Expense</a></li>";
				$('#expDel-'+myexp.exp_id).die();
				$('#expDel-'+myexp.exp_id).live('click',function(){
					var expId = $(this).attr('expid');
					var expElem = expId+'-expDel';
					var delUrl = 'api/expense_del/'+expId;
					$.get(delUrl, function(data) {
					  console.log('Load was performed.'+expElem);
					  $('#'+expElem).remove();
					  
					});
				});
			});
			$('#recentExpenses').html(expenseList);
			$('#recentExpenses').listview('refresh');
		});
	}
	
	$( '#myExpenses' ).live( 'pageshow',function(event){
		getExpenseList();
	});
	</script>
	
		<div data-role="header">
		<h1>My Expenses</h1>
		<a href="#" data-icon="gear" class="ui-btn-right" id="logout">Logout</a>
		<a href="home.php" data-role="button" data-icon="back" class = "ui-btn-left">Back</a> 
			
		</div>
		<div data-role="content" class="ui-body ui-body-a">
			<ul id = "recentExpenses" data-role="listview" data-split-icon="delete" data-split-theme="b" data-theme="a">
			</ul>
		</div>
		<!--<div data-role = "footer">
		<H4></H4>
		</div>
	</div>
</body>

</html>