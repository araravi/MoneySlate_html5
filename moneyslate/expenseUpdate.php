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
<script>
function getExpenses()
{
	url = 'http://ec2-107-20-87-250.compute-1.amazonaws.com/expense_det/' + expense_id;
	$.getJSON(url, function(json){
		expense_name = json['exp_name'];
		expense_description = json['exp_description'];
		expense_amount = json['exp_amount'];
		expense_date = json['exp_date'];
		//expense_location = json['location'];
		expense_members = json['members'];
		$('#name').val(expense_name);
		$('#expenseAmount').val(expense_amount);
		$('#description').val(expense_description);
	
		
		/*if(expense_location)
		{
			var myswitch = $("select#location");
			myswitch[0].selectedIndex = 1;
			myswitch.slider("refresh");	
		}
		else
		{
			var myswitch = $("select#location");
			myswitch[0].selectedIndex = 2;
			myswitch.slider("refresh");	
		}*/
		updateMembers();
		$(".ul").listview('refresh');
	});
		
}

function updateMembers()
{
	var found;
	var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/friends.php";
	var tagList = "<option>Tagpeople</option>";
	$.getJSON(url, function(json) {
	   $.each(json.data, function(i,member){
		tagList+="<option value=\"" + member.id + "\"name = \"" + member.name + "\">" + member.name+ "</span></option>";
	   });
	   $("#tagpeople").html(tagList).selectmenu('refresh');
	   
	   $.each(json.data, function(i,member){
			found=false;
			for(var j=0; j<expense_members.length; j++)
			{
				if(member.id == expense_members[j].mem_fb_id)
				{
					found = true;
					break;
				}
			}
			if(found)
			{
				document.getElementById("tagpeople").options[i+1].selected = true;
			}
		});
		$("#tagpeople").selectmenu('refresh');
	 });
}
$(function(){
	expense_id = <?php if(isset($_GET["exp_id"])){echo '"'.$_GET["exp_id"].'"';} else echo "false";?>;
	if(expense_id)
	{
		getExpenses();
	}
});
</script>
<div data-role="page" id="addExpensePage" data-title="Modify Expense"> 
<div data-role="header" id = "expensehead_1">
		<h1>Step 1</h1>
		<a href="#" data-icon="forward" class="ui-btn-right" id="expense1Next">Next</a>
		<a href="http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/home.php" data-role="button" data-icon="home" class="ui-btn-left">Home</a> 
	</div>
	<div data-role="header" id = "expensehead_2">
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
		
		<!---<div class="ui-body ui-body-b">
			<fieldset class="ui-grid-a">
				<button type="button" onclick=clearForm() data-theme="d">Clear</button>
			</fieldset>
		</div>-->
	</div>
	<div id="expense_2" data-role="content">
		
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
		<!---<div id='splitarea'>
		</div>--->
			
	</div>	<!-- content div -->
</div>
</body>
</html>
