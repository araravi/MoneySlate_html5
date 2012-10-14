<!DOCTYPE html>
<html>
<head> 
	<title>UOMe New Expense</title> 
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
<div data-role="page" id="addExpensePage" data-title="UOMe Add Expense">
<script>
$( '#addExpensePage' ).live( 'pageshow',function(event){
	console.log('pageShow fired');
	var expense_id = <?php if(isset($_GET["exp_id"])){echo '"'.$_GET["exp_id"].'"';} else echo "false";?>;
	if(expense_id)
	{
		console.log("expense_id="+expense_id);
		getExpenses(expense_id);
	}
	showExpStep1(1);
	$('#date1').scroller({ theme: 'default', mode: 'clickpick' });
	function setDateNow(){
		var today= new Date();
		day = today.getDate();
		month = Number(today.getMonth())+1;
		year = today.getFullYear();
		var dateString=""+month+"/"+day+"/"+year;
		return dateString;
	}
	$('#date1').val(setDateNow());
	getLocation();
});
</script>
	<div data-role="header" id = "expensehead_1">
		<h1>Step 1</h1>
		<a href="#" data-icon="forward" class="ui-btn-right" id="expense1Next">Next</a>
		<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-role="button" data-icon="home" class="ui-btn-left">Home</a> 
	</div>
	<div data-role="header" id = "expensehead_2" style="display:none">
		<h1>Step 2</h1>
		<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-icon="check" data-theme='b' class="ui-btn-right" id="submitExpense">Submit</a>
		<a href="#" data-icon="back" data-role="button"  id="expense2Back" class="ui-btn-left">Back</a> 
	</div>
	<div id="expense_1" data-role="content">

		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="name">Expense Name</label>
			<input type="text" name="name" id="name" placeholder="Enter Expense Name" value=""  />
		</div>

		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="expenseAmount">Expense Amount</label>
			<input type="text" name="expenseAmount" id="expenseAmount" placeholder="Enter Total Expense Amount" value=""/>
		</div>

		<div data-role="fieldcontain" class="ui-hide-label">
		<div id="cat">
			<label for="category" class="select">Category:</label>
			<select name="category" id="category">
			</select>
		</div>
			<div id="cattext" style = "display:none">
				<label for="category" class="select">Category:</label>
				<input type="text" name="category" id="categorytext" value=""/>
				<div style="float:right">
				<button data-inline="true" id="addcategory" data-icon="check" data-iconpos="notext"></button>
				<button data-inline="true" id="cancelcategory" data-icon="delete" data-iconpos="notext"></button>
				</div>
			</div>
		</div>

		<div data-role="fieldcontain">
			<input name="date" type="date" id="date1" class="mobiscroll"/>
			<!--<input type="text" name="date" id="datepicker" value=""  />-->
		</div>
		
		<div id='expenseValidateMsg1' style='text-align:center;display:none' class='ui-body ui-body-e'>
		</div>
		<!---<div class="ui-body ui-body-b">
			<fieldset class="ui-grid-a">
				<button type="button" onclick=clearForm() data-theme="d">Clear</button>
			</fieldset>
		</div>-->
	</div>
	<div id="expense_2" data-role="content" style="display:none">
		
		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="taggroups">Tag Groups:</label>
			<select name="taggroups" id="taggroups" multiple="multiple" data-native-menu="false">
			<option>No Groups Created Yet</option>
			</select>	
		</div>
		
		<div data-role="fieldcontain">
			<input type="search" id="friendSearch" placeholder="Search facebook friends"/>
				<ul data-role="listview" id="friends_details" data-inset="true">
			</ul>
		</div>	

		<div class="ui-body ui-body-b" style="text-align:center">Tagged People
			<div id="taggedPeople" name="taggedPeople">
				<ul data-role="listview" data-theme="e" id="group_friends_details" data-inset="true">
			<!---You haven't tagged anyone to your Expense. Tag a group above or choose person below.--->
				</ul>	
			</div>
		</div>
		<button id="modifyExpense" data-theme="a">Modify Expense Split</button>
		
		<div id='expenseValidateMsg2' style='text-align:center;display:none' class='ui-body ui-body-e'>
		<div>
		<!---<div id='splitarea'>
		</div>--->
			
	</div>	<!-- content div -->
</div>
</body>
</html>
