<!DOCTYPE html> 
<html> 

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Multi-page template</title> 
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.css" />
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc2/jquery.mobile-1.0rc2.min.js"></script>
</head> 

	
<body> 

<!-- Start of first page: #one -->
<div data-role="page" id="foo">
	<script>
	$( '#foo' ).live( 'pageinit',function(event){
	alert($('test_name').val());
	alert($('test_expenseAmount').val());
		$('#est').click(function(){
			//alert("clicked");
			$('#one').hide();
			$('#second').show("slow");
		});
	});
	</script>

	<div data-role="header">
		<h1>Multi-page</h1>
	</div><!-- /header -->
	
	<div data-role="content" id="one">	
		<div data-role="fieldcontain" class="ui-hide-label">
		<label for="name">Expense Name</label>
		<input type="text" name="name" id="test_name" placeholder="Enter Expense Name" value=""  />
		</div>
								
		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="expenseAmount">Expense Amount</label>
			<input type="text" name="expenseAmount" id="test_expenseAmount" placeholder="Enter Expense Amount" value=""/>
		</div>
		
		<div data-role="fieldcontain" class="ui-hide-label" id="cat">
			<label for="category" class="select">Category:</label>
			<select name="category" id="category">
			</select>
		</div>
		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="date">Expense Date</label>
			<input type="date" name="date" id="date" placeholder="Enter Expense Date" value=""  />
		</div>
		
		<fieldset class="ui-grid-a">
				<div class="ui-block-a"><button type="submit" data-theme="d">Next</button></div>
				<div class="ui-block-b"><button type="submit" data-theme="a">Submit</button></div>
	    </fieldset>
		
		<h3>Show internal pages:</h3>
		<button id = "est">Test Data</button>
		<p><a href="#two" data-role="button">Show page "two"</a></p>	
	</div><!-- /content -->
	<div data-role="content" id="second">	
		<div data-role="fieldcontain" class="ui-hide-label">
		<label for="name">Expense Name</label>
		<input type="text" name="name" id="test_name" placeholder="Enter Expense Name" value=""  />
		</div>
								
		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="expenseAmount">Expense Amount</label>
			<input type="text" name="expenseAmount" id="test_expenseAmount" placeholder="Enter Expense Amount" value=""/>
		</div>
		
		<div data-role="fieldcontain" class="ui-hide-label" id="cat">
			<label for="category" class="select">Category:</label>
			<select name="category" id="category">
			</select>
		</div>
		<div data-role="fieldcontain" class="ui-hide-label">
			<label for="date">Expense Date</label>
			<input type="date" name="date" id="date" placeholder="Enter Expense Date" value=""  />
		</div>	
	</div><!-- /content -->
</div><!-- /page one -->
</body>
</html>