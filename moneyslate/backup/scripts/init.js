var inival=0;
var jsondata=new Object();
var mem_exp=new Object();
var latitude;
var longitude;
var current_user_id;
var mem_exp_counter = 0;

ls = getLocalStorage(); //dispError sets variable called errorMessage

function getLocalStorage() {
    try {
	if( !! window.localStorage ) return window.localStorage;
    } catch(e) {
	return undefined;
    }
}

function checkForm(){
	if(document.getElementById("name").value==""){
		alert("Enter Expense Name");
		return false;
	}
	/*if($("#category").val()==0){
		alert("Choose a category");
		return false;
	}*/
	if(document.getElementById("expenseAmount").value==""){
		alert("Enter Expense Amount");
		return false;
	}
	if(document.getElementById("date").value==""){
	
		//alert("Enter Date of Expense");
		//return false;
	}
	return true;
}

function clearForm(){
	document.getElementById("name").value="";
	var myselect = $("#category");
	myselect[0].selectedIndex = 1;
	myselect.selectmenu("refresh");
	document.getElementById("expenseAmount").value="";
	document.getElementById("description").value="";
	$("#tagpeople").selectmenu('refresh');
	return true;
}

/***functions to set and get local data***/
function set_local(type, data){
	ls.setItem(type, data);
}
function get_local(type){
	return ls.getItem(type);
}


function setInvalidLatitude(){
	return -1;
}

function setInvalidLongitude(){
	return -1;
}

function addTextBox(meminfo,memberId)
{
	add_New_Element(memberId);
	var htcontents = "<label for=" +"'" + memberId + "'" + ">"+ meminfo + "</label>";
	htcontents = htcontents + "<input type='text' id=" + "'" + memberId + "'" + "name="+ "'"+memberId+"'/>";
	document.getElementById(memberId+"-div").innerHTML = htcontents; // You can any other elements in place of 'htcontents';
}

function add_New_Element(memberId) {
	inival=inival+1; // Increment element number by 1
	var ni = document.getElementById('splitarea');
	var newdiv = document.createElement('div'); // Create dynamic element
	//var divIdName = 'my'+inival+'Div';
	newdiv.setAttribute('id',memberId+"-div");
	ni.appendChild(newdiv);
}

function showcategory(value){
	if(value==true){
		$('#cattext').hide();
		$('#cat').show();
		var myselect = $("#category");
		myselect[0].selectedIndex = 1;
		myselect.selectmenu("refresh");
	}
	else{
		$("#cat").hide();
		$("#cattext").show();
	}
}

var memberSelected;
var textvalues = [];

$( '#expPage' ).live( 'pagecreate',function(event){

	$('#category').change(function() {
	  if($(this).val() ==0){
		showcategory(false);
	  }
	});
	
	$('#location').change(function() {
		if($('#location').val()=='on'){
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(current);
				function current(position){
					latitude = position.coords.latitude;
					longitude = position.coords.longitude;
				}
			}
		}
	});
	
	$('#tagpeople').change(function() {
		var sel = $(this).val();
		total = $("#expenseAmount").val();
		if(total==""){
			alert("Enter expense amount before tagging people");
			return false;
		}
		var floattotal = parseFloat(total);
		if(isNaN(floattotal)){
			alert("Expense amount is invalid");
			return false;
		}
		$('#tagpeople :selected').each(function(i, selected) {
		    textvalues[i] = $(selected).attr("name");
		});
		var splitAmount = floattotal/(sel.length+1);
		for(i=0;i<sel.length;i++){
			var expSplit = new Object();
			expSplit['member_id']=sel[i];
			expSplit['mem_name']=textvalues[i];
			expSplit['mem_amount']=splitAmount;
			mem_exp[i]=expSplit;
		}
		mem_exp_counter = i;
	});
	
	$('#modifyExpense').live('click',function(){
		alert("Splitting Expense");
		if($("#expenseAmount").val()==""){
			alert("Enter expense amount before splitting it");
			return false;
		}
		if($("#tagpeople").val()==null){
			alert("Tag people to split the expense with");
			return false;
		}
		$('#modifyExpenseSplit').show();
		memberSelected = $('#tagpeople').val(); 
		$('#tagpeople :selected').each(function(i, selected) {
		    textvalues[i] = $(selected).attr("name");
		});
		var fieldList = "";
		$.each(memberSelected, function(i,memberid){
			fieldList +='<div data-role="fieldcontain"><label for="'+memberid+'">'+textvalues[i]+': </label>';
			fieldList+='<input type="text" name="'+memberid+'" id="'+memberid+'" value="" /></div>';
			//addTextBox(textvalues[i],memberid);
		});
		document.getElementById("splitarea").innerHTML = fieldList;
		$('input').textinput();
		//$("#splitarea").append("<button id = 'splitSave'>Save</button>");	
	});

	$("#splitSave").live('click',function(){
		alert("Save pressed");
		var totalExpense = parseFloat($("#expenseAmount").val());
		var total_split=0;
		var amount_split;
		for(i=0;i<memberSelected.length;i++){
			amount_split = parseFloat(document.getElementById(memberSelected[i]).value);
			if(isNaN(amount_split)){
				alert("Enter valid amount");
				return false;
			}
			total_split+=amount_split;
		}
		if(total_split>totalExpense){
			alert("Total split is greater than entered amount");
			return false;
		}
		for(i=0;i<memberSelected.length;i++){
			var expSplit = new Object();
			expSplit['member_id']=memberSelected[i];
			expSplit['mem_name']=textvalues[i];
			expSplit['mem_amount']=document.getElementById(memberSelected[i]).value;
			mem_exp[i]=expSplit;
		}
		$('#modifyExpenseSplit').hide();
	});
	
	
	$('#cancelcategory').live('click',function(){
		showcategory(true);
		return false;
	});	
});
