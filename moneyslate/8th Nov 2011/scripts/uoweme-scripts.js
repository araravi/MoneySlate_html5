var fb_id;
var memberSelected;
var textvalues = [];
var inival=0;
var jsonExpenseData=new Object();
var mem_exp=new Object();
var latitude;
var longitude;
var current_user_id;
var mem_exp_counter = 0;
var groupsData;
var expTagRequest;
var orig = 1;
var reportUpdate = 1;
var expUpdateId;

function getGroups(){
	var url = "http://mymoneyslate.com/api/groups";
	var groupList="";
	var groups;
   
	if(navigator.onLine){
		$.getJSON(url, function(json){
		
		groups = json.groups;
		if(json.report==null){
		$('#groupDetails').html("<h3 style = \"text-align:center\">No groups yet! Click on Create to make one!<h3>");
			}
		for(var i=0; i<groups.length; i++)
		{
			groupList += "<li data-icon=\"search\"><a href=\"groupUpdate.php?group_id="+groups[i].group_id+ "\">" + groups[i].group_name + "</a></li>";
		}
		$("#groupDetails").html(groupList);
		$("#groupDetails").listview('refresh');
		});
	}
}

$( '#myGroups' ).live( 'pageshow',function(event){
		//alert('show');
		getGroups();
	});	

function checkForm(){
	if(document.getElementById("name").value==""){
		alert("Enter Expense Name");
		return false;
	}
	//if($("#category").val()==0){
	//	alert("Choose a category");
	//	return false;
	//}
	if(document.getElementById("expenseAmount").value==""){
		alert("Enter Expense Amount");
		return false;
	}
	/*if(document.getElementById("date").value==""){
		alert("Enter Date of Expense");
		return false;
	}*/
	return true;
}

function clearForm(){
	document.getElementById("name").value="";
	var myselect = $("#category");
	myselect[0].selectedIndex = 1;
	myselect.selectmenu("refresh");
	document.getElementById("expenseAmount").value="";
	document.getElementById("description").value="";
	$("#taggroups").selectmenu('refresh');
	return true;
}

function moneyFormat(amount){
	console.log(amount);
	return(Math.round(amount*100)/100);
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

function setFbId(){
		var url="http://mymoneyslate.com/api/fb_id.php";
		$.getJSON(url,function(json){
			fb_id = json.mem_fb_id;
		});
}

function setMe(){
	$("#expenseMe").text("Loading...");
    var today= new Date();
	month = Number(today.getMonth())+1;
	year = today.getFullYear();
	var url = "http://mymoneyslate.com/api/meetile.php?month="+month+"&year="+year;
	var amt;
	$.getJSON(url, function(json) {
			amt = json.amount;
			$("#expenseMe").text(moneyFormat(amt));
			if(amt==0)
			$("#meBar").css("width","0%");
	 });
}

function setReport(){
	$("#oweExpAmount").text("Loading...");
	$("#needExpAmount").text("Loading...");
	var url = "http://mymoneyslate.com/api/reporttile";
	var needAmt;
	var oweAmt;
	var total;
	var needPercent;
	var owePercent;
	$.getJSON(url, function(json) {
		needAmt = json.Need;
		oweAmt = json.Owe;
		total = needAmt+oweAmt;
		if(needAmt==0){
			needPercent = 0;
		}
		else{
			needPercent = (needAmt/total)*100;
		}
		if(oweAmt==0){
			owePercent = 0;
		}
		else{
			owePercent = (oweAmt/total)*100;
		}
		$("#expoweBar").css("width",Math.round(owePercent)+"%");
		$("#expneedBar").css("width",Math.round(needPercent)+"%");
		$("#oweExpAmount").text(moneyFormat(oweAmt));
		$("#needExpAmount").text(moneyFormat(needAmt));
		reportUpdate = 0;	
	 });
}

function setCategories(){
        var url = "http://mymoneyslate.com/api/getCategory";
	var optionList = "";
	$.getJSON(url, function(json) {
	   optionList = "<option value = \"0\">Add Category</option>";
	   $.each(json.Categories, function(i,category){
		if(i==0){
			optionList+="<option value=\"" + category.cat_id + "\"selected=\"selected\">Category - " + category.cat_name + "</option>";
		}
		else{
			optionList+="<option value=\"" + category.cat_id + "\">Category - " + category.cat_name + "</option>";
		}
	   });
	   $("#category").html(optionList).selectmenu('refresh');
	 });
}

function settagGroups(){
	var url = "http://mymoneyslate.com/api/groups";
	var tagList = "<option>Tag Groups</option>";
	$.getJSON(url, function(json) {
	   //set_local('tag',$.toJSON(json));
	   if(json.groups==undefined)
		return false;
		
	   groupsData = json.groups;
	   $.each(groupsData, function(i,group){
		tagList+="<option value=\"" + group.group_id + "\"name = \"" + group.group_name + "\">" + group.group_name + "</span></option>";
	   });
		$("#taggroups").html(tagList).selectmenu('refresh');
	 });
}

function addcategory(cat){
	var url = "http://mymoneyslate.com/api/addCategory.php";
	$.post(url, { mem_id: fb_id, category: cat },
	   function(data) { 
	     setCategories();
	     showcategory(true);
	     $('#addcategory').attr("disabled", false);
	   });
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

function arrangeTiles(){
var width = $(window).width();
		if(width>480){
			$("#tileDiff").addClass('ui-grid-a');
			$("#reportTileDiff").addClass('ui-block-a');
			$("#meTileDiff").addClass('ui-block-b');
			$("#staticTiles").removeClass('ui-grid-a').addClass('ui-grid-c');
			$("#tile3").removeClass('ui-block-a').addClass('ui-block-c');
			$("#tile4").removeClass('ui-block-b').addClass('ui-block-d');
			$("#tile3 div").removeClass('leftTile').addClass('rightTile');
		}
}
function set_friends(friends){
	var friendsList = "";
	/*if($('#friendSearch').val()==""){  //was a bug now fixed uncomment to chech if bug exists
		console.log("live search bug exists");
		return false;
	}*/ 
	
	for(var i=0; i<friends.length; i++)
	{		
		if($('#'+friends[i].uid+'-rem').length!=0){
			friendsList += '<li data-icon="plus" class="exphidden" fbID="'+friends[i].uid+'" id="'+friends[i].uid+'-ls"><a href=#>'+friends[i].name+'</a></li>';
		}
		else{
			friendsList += '<li data-icon="plus" class="expnormal" fbID="'+friends[i].uid+'" id="'+friends[i].uid+'-ls"><a href=#>'+friends[i].name+'</a></li>';	
		}
		$('#'+friends[i].uid+'-ls').die(); //to prevent live event firing multiple times
		$('#'+friends[i].uid+'-ls').live('click',function(){
			console.log($(this) + ' clicked');
			var friendId = $(this).attr('fbID');
			var listFriendId = friendId+'-ls';
			var removeFriendId = friendId+'-rem';
			var name = $('#'+listFriendId).text();
			$('#'+listFriendId).hide();
			if($('#'+removeFriendId).length!=0){
				return false;
			}
			//if($('#'+removeFriendId).length==0){
				$('#group_friends_details').append('<li data-icon="minus" parent="'+friendId+'" class="taggedMembers" id="'+removeFriendId+'"><a href=#>'+name+'</a></li>')
				$("#group_friends_details").listview('refresh');
			//}
			//$('#'+listFriendId).hide();
			console.log(listFriendId);
			$('#'+removeFriendId).bind('click',function(){
				console.log(removeFriendId + ' clicked');
				var friendId = $(this).attr('parent');
				console.log('Length = '+$('#'+removeFriendId).length);
				console.log(friendId+'-ls');
				console.log($('#'+friendId+'-ls').length);
				$('#'+friendId+'-ls').show();
				$(this).remove();
				$('#'+friendId+'-amt').remove();
			});
		});
	}
	$("#friends_details").html(friendsList);
	$("#friends_details").listview('refresh');
	$(".exphidden").hide();
}

function liveSearch(){
		var runningexpTagRequest = false;
		var prevtag = "";
			$('#friendSearch').bind('change keyup',function (e) {
				//e.preventDefault();
				console.log("change");
				var searchTag = $(this).val();
				if(searchTag.length<3){
					if(expTagRequest!=undefined)
						expTagRequest.abort();
					
					$("#friends_details").html('');
					//$("#friends_details").listview('refresh');
					return false;
				}
				if(runningexpTagRequest){
					expTagRequest.abort();
				}
				if(prevtag==searchTag){
					return false;
				}
				prevtag = searchTag;
				runningexpTagRequest = true;
				var url = "http://mymoneyslate.com/api/fr/"+searchTag;
				console.log(url);
				expTagRequest = $.getJSON(url, function(friendsJson){
					if(friendsJson.length==0){
						$("#friends_details").html('<li>No one found</li>');
						$("#friends_details").listview('refresh');
						return false;
					}
					set_friends(friendsJson);
					runningexpTagRequest = false;
				});
				return false;
		});
	}
function getLocation(){
	if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(current);
				function current(position){
					latitude = position.coords.latitude;
					longitude = position.coords.longitude;
				}
			}
	else{
			latitude = setInvalidLatitude();
			longitude = setInvalidLongitude();
		}
}

function showExpStep1(tag){
	if(tag==1)//forward step
		$('#expense_2').hide();
	else//backward
		$('#expense_2').slideUp();
		
	$('#expensehead_2').hide();
	$('#expense_1').show();
	$('#expensehead_1').show();
}

function showExpStep2(){
	$('#expensehead_1').hide();
	$('#expense_1').hide();
	$('#expensehead_2').show();
	$('#expense_2').slideDown();
}

function setDateNow(){
		var today= new Date();
		day = today.getDate();
		month = Number(today.getMonth())+1;
		year = today.getFullYear();
		var dateString=""+month+"/"+day+"/"+year;
		return dateString;
	}
	

function expenseInit(){
	$('#expenseValidateMsg1').text('');
	$('#expenseValidateMsg1').hide();
	$('#expenseValidateMsg2').text('');
	$('#expenseValidateMsg2').hide();
	$('#name').val('');
	$('#expenseAmount').val();
	$('#date1').val(setDateNow());
	$('.taggedMembers').remove();
	resetExpID();
}

function setExpId(expID){
	expUpdateId = expID;
}

//function to reset expense id for update to handle ajax page loading event
function resetExpID(){
	expUpdateId = undefined;
}

function getExpenses(expense_id)
{
	url = 'http://mymoneyslate.com/api/expense_det/' + expense_id;
	console.log("getexp="+expense_id);
	$.getJSON(url, function(json){
		console.log("ingetexp");
		expense_name = json['exp_name'];
		//expense_description = json['exp_description'];
		expense_amount = json['exp_amount'];
		expense_date = json['exp_date'];
		//expense_location = json['location'];
		expense_members = json['members'];
		expense_cat_id = json['exp_cat_id'];
		console.log(expense_name);
		console.log(expense_amount);
		console.log(expense_date);
		$('#name').val(expense_name);
		$('#expenseAmount').val(expense_amount);
		$('#date1').val(expense_date);
		
		$('#category').val(expense_cat_id);
		$('#category').selectmenu("refresh");
		$.each(json.members,function(i,member){
			if($('#'+member.mem_fb_id+'-rem').length!=0){
				return true;
			}	

			var friendId = member.mem_fb_id;
			var listFriendId = friendId+'-ls';
			var removeFriendId = friendId+'-rem';
			var name = member.mem_name;
			var expAmtID = friendId+'-amt';
			$('#group_friends_details').append('<li data-icon="minus" parent="'+friendId+'" class="taggedMembers" id="'+removeFriendId+'"><a href=#>'+name+'</a></li>');
			$('#'+removeFriendId).after('<div><input type="text" placeholder="Enter Split Amount" id='+expAmtID+' value="'+member.mem_amount+'"/></div>');
			$('#'+expAmtID).textinput();
			$("#group_friends_details").listview('refresh');
			$('#'+listFriendId).hide();
			$('#'+removeFriendId).die();
			$('#'+removeFriendId).live('click',function(){
				var friendId = $(this).attr('parent');
				$('#'+friendId+'-ls').show();
				$(this).remove();
				$('#'+friendId+'-amt').remove();
			});
		});
		/*var catselect = $("#category");
		catselect[0].selectedIndex = json['exp_cat_id'];
		catselect.selectmenu("refresh");*/
		
		//$('#description').val(expense_description);		
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
	});
}

//Begin @Expense Page Scripts
$( '#addExpensePage' ).live( 'pageinit',function(event){
	console.log('expense pageinit fired');
	//showExpStep1(1);
	$('#date1').scroller({ theme: 'default', mode: 'clickpick' });
	setCategories();
	liveSearch();
	$('#expense1Next').bind('click',function(){
		console.log('expnextfired');
		var expMsg='';
		if($('#name').val()==''){
			expMsg='<h4>Enter an expense name</h4>';
		}
		else if($('#expenseAmount').val()==''){
			expMsg='<h4>Enter expense amount</h4>';
		}
		else if(isNaN($('#expenseAmount').val())){
			expMsg='<h4>Amount isn\'t a number</h4>';
		}
		else if($('#date1').val()==''){
			expMsg='<h4>Enter an expense date</h4>';
		}
		if(expMsg!=''){
			console.log('camehere');
			$('#expenseValidateMsg1').html(expMsg);
			$('#expenseValidateMsg1').show();
			$('#expenseValidateMsg1').delay(1500).fadeOut();
			return false;
		}
		showExpStep2();
	});
	$('#expense2Back').bind('click',function(){
		$('#expense_2').slideUp(function(){
			$('#expensehead_2').hide();
			$('#expense_1').show();
			$('#expensehead_1').show();
		});
	});
	
	//getLocation();
	
	$(this).bind("swiperight", function(){
		  $.mobile.changePage( "http://mymoneyslate.com/home.php");
	});
	
	/*$('#location').change(function() {
		if($('#location').val()=='on'){
			if(navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(current);
				function current(position){
					latitude = position.coords.latitude;
					longitude = position.coords.longitude;
				}
			}
		}
	});*/
		
	$('#taggroups').change(function() {
		$('li[origin="groupSelect"]').remove();
		
		$('#taggroups :selected').each(function(i, selected) {
			var selected_groupId = $(selected).attr('value');
			$.each(groupsData, function(i,group){
			if($(selected).attr('value')==group.group_id){
				if(group.members==undefined){
					return true;
				}	
				$.each(group.members,function(i,member){
						if($('#'+member.member_fb_id+'-rem').length!=0){
							return true;
						}	

						var friendId = member.member_fb_id;
						var listFriendId = friendId+'-ls';
						var removeFriendId = friendId+'-rem';
						var name = member.mem_name;
	
						$('#group_friends_details').append('<li data-icon="minus" origin="groupSelect" parent="'+friendId+'" class="taggedMembers" id="'+removeFriendId+'"><a href=#>'+name+'</a></li>')
						$("#group_friends_details").listview('refresh');
						$('#'+listFriendId).hide();
						$('#'+removeFriendId).die();
						$('#'+removeFriendId).live('click',function(){
							var friendId = $(this).attr('parent');
							$('#'+friendId+'-ls').show();
							$(this).remove();
							$('#'+friendId+'-amt').remove();
						});
					});
				}
			});
		    //textvalues[i] = $(selected).attr("name");
		});
		//var splitAmount = floattotal/(sel.length+1);
		//for(i=0;i<sel.length;i++){
		//	var expSplit = new Object();
		//	expSplit['member_id']=sel[i];
		//	expSplit['mem_name']=textvalues[i];
		//	expSplit['mem_amount']=splitAmount;
		//	mem_exp[i]=expSplit;
		//}
		//mem_exp_counter = i;
	});
	
	$('#modifyExpense').bind('click',function(){
		//alert("Splitting Expense");
		if($("#expenseAmount").val()==""){
			alert("Enter expense amount before splitting it");
			return false;
		}
		if($('.taggedMembers').length==0){
			$('#expenseValidateMsg2').html('<h4>Tag Friends to your Expense first</h4>');
			$('#expenseValidateMsg2').show();
			$('#expenseValidateMsg2').delay(1500).fadeOut();
		}
		
		$('.taggedMembers').each(function(index) {
			//var temp=new Object();
			var expId = $(this).attr('parent') +'-amt';
			if($('#'+expId).length==0){
				$(this).after('<div><input type="text" placeholder="Enter Split Amount" id='+expId+' value=""/></div>');
				$('#'+expId).textinput();
			}
			//temp[index]=$(this).attr('parent');
			//groupMembers[index]=temp;
			//console.log(groupMembers[index]);
		});
		/*if($("#taggroups").val()==null){
			alert("Tag people to split the expense with");
			return false;
		}*/
		/*$('#modifyExpenseSplit').show();
		memberSelected = $('#taggroups').val(); 
		$('#taggroups :selected').each(function(i, selected) {
		    textvalues[i] = $(selected).attr("name");
		});*/
		/*var fieldList = "";
		$.each(memberSelected, function(i,memberid){
			fieldList +='<div data-role="fieldcontain"><label for="'+memberid+'">'+textvalues[i]+': </label>';
			fieldList+='<input type="text" name="'+memberid+'" id="'+memberid+'" value="" /></div>';
			//addTextBox(textvalues[i],memberid);
		});
		document.getElementById("splitarea").innerHTML = fieldList;
		$('input').textinput();*/
		//$("#splitarea").append("<button id = 'splitSave'>Save</button>");	
	});

	/*$("#splitSave").live('click',function(){
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
	});*/
	
	$('#category').change(function() {
	  if($(this).val() ==0){
		showcategory(false);
	  }
	});
	$('#addcategory').bind('click',function(){
			var newcat = $('#categorytext').val()
			if(newcat==""){
				alert("Enter category name");
				return false;
			}
			$(this).attr("disabled", true);
			addcategory(newcat);
			//return false;
	});
	$('#cancelcategory').bind('click',function(){
		showcategory(true);
		//return false;
	});
	
	function afterSubmitExpense(){
		mem_exp = new Object();
		jsonExpenseData = new Object();
		reportUpdate = 1;
	}
	
	$("#submitExpense").bind('click',function(){
		$(this).attr("disabled", true);
		console.log("cxgdfd");
		$.mobile.showPageLoadingMsg();
			if(latitude==undefined)
				latitude = setInvalidLatitude();
			if(longitude==undefined)
				longitude = setInvalidLongitude();
				
			var selectedMembers = $('.taggedMembers');
			var totalSelected = selectedMembers.length;
			var floattotal = parseFloat($('#expenseAmount').val());
			var splitAmount = floattotal/(totalSelected+1);
			var sumtoCheck = 0;
			var flag = true;
			for(i=0;i<totalSelected;i++){
				var expSplit = new Object();
				var member_id=$(selectedMembers[i]).attr('parent');
				expSplit['member_id']=member_id;
				console.log(expSplit['member_id']);
				expSplit['mem_name']=$(selectedMembers[i]).text();
				console.log(expSplit['mem_name']);
				if($('#'+member_id+'-amt').length==0)
					expSplit['mem_amount']=splitAmount;
				else{
					if(isNaN($('#'+member_id+'-amt').val())){
						$('#expenseValidateMsg2').html('<h4>Split Amounts entered are not valid numbers</h4>');
						$('#expenseValidateMsg2').show();
						$('#expenseValidateMsg2').delay(1500).fadeOut();
						flag=false;
						$.mobile.hidePageLoadingMsg();
						return false;
					}
					expSplit['mem_amount'] = parseFloat($('#'+member_id+'-amt').val());
				}
				sumtoCheck+=expSplit['mem_amount']	
				mem_exp[i]=expSplit;
			}
			if(flag = false){
				return false;
			}
			console.log(sumtoCheck);
			console.log(floattotal);
			if(sumtoCheck>floattotal){
				alert('Sum of split amounts greater than Expense amount. Not possible lah');
				$.mobile.hidePageLoadingMsg();
				return false;
			}
			jsonExpenseData['mem_exp'] = mem_exp;
			jsonExpenseData['exp_name']=document.getElementById("name").value;
			jsonExpenseData['expense_creator_id']=fb_id;
			jsonExpenseData['exp_category_id']=$("#category").val();
			if($("#description").val()==undefined)
				jsonExpenseData['exp_description']=""
			else	
				jsonExpenseData['exp_description']=$("#description").val();
			jsonExpenseData['exp_amount']=$("#expenseAmount").val();
			console.log(latitude);
			console.log(longitude);
			jsonExpenseData['lat']=latitude;
			jsonExpenseData['long']=longitude;
			jsonExpenseData['date']=$("#date1").val();
			
			var expenseUrl = 'http://mymoneyslate.com/api/putExpense.php';
			console.log(expenseData);
			if(expUpdateId!=undefined){
				console.log("works = " + expUpdateId);
				jsonExpenseData['exp_id'] = expUpdateId;
			}
			var expenseData = $.toJSON(jsonExpenseData);
			$.ajax({
			      type: "PUT",
			      url: expenseUrl,
			      data: expenseData,
			      contentType: 'application/json', // format of request payload
			      dataType: 'json', // format of the response
			      success: function(msg) {
				//setMe();
				//setReport();
				//clearForm();
				afterSubmitExpense();
				$.mobile.hidePageLoadingMsg();
				$(this).attr("disabled", false);
				$.mobile.changePage( "http://mymoneyslate.com/home.php");
			      }
			});
		});
});

//begin report scripts
$('#reportPage').live( 'pageshow',function(event){
	function populateHeaders(need,owe){
        var url = "http://mymoneyslate.com/api/report";
	$.getJSON(url, function(json) {
	   var element = '';
	   var oweTag;
	   var progressTag;
	   var percent = 0;
	   var elementAmount = 0;
	   if(json.report==undefined){
		$('#reportSet').parent().html("<h3 style = \"text-align:center\">No transactions yet<h3>");
		$('#reportLoader').hide();
	   }
	   $.each(json.report, function(i,person){
		elementAmount = moneyFormat(person.amount);
	        if(person.Need==true){
			oweTag = person.first_name+" Owes ";
			progressTag = "meter";
			percent = parseInt((elementAmount/need)*100);
		}
		else if(person.Owe==true){
			oweTag = "I Owe "+person.first_name;
			progressTag = "meter red";
			console.log(elementAmount);
			console.log(owe);
			console.log(elementAmount/owe);
			console.log((elementAmount/owe)*100);
			percent = parseInt((elementAmount/owe)*100);
		}
		else{
			return true;
		}
		console.log("percent="+percent);
		var image='<img src='+'"http://graph.facebook.com/'+person.mem_fb_id+'/picture" />';
		element = element+'<li><a style="white-space:normal" href="http://mymoneyslate.com/reportdetails.php?mem_id=' + person.mem_fb_id + '&mem_name='+person.first_name+'"><div class="ui-grid-a"><div class="ui-block-a" style="width:20%">'+ image + '</div>';
		element = element+'<div class="ui-block-b style="width:80%"><div style="height:auto">'+ oweTag + " S<span class='currency'>$</span>"+ elementAmount+'</div>';
		element = element+'<div class="' + progressTag + '" style="width: 80%"><span style="width: '+percent+'%"><span></div></div></div>';
		element = element+'</a></li>';
	   });
	   $("#reportSet").html(element);
	   $("#reportSet").listview('refresh');
	   $('#reportLoader').hide();
	 });
	
	}
	
	function setReportHead(){
	var url = "http://mymoneyslate.com/api/reporttile";
		$.getJSON(url, function(json) {
				var needAmount = 0;
				var oweAmount = 0;
				if(json.Need!=null)
					needAmount = json.Need;
				if(json.Owe!=null)
					oweAmount = json.Owe;
				$("#reportOwe").text("S$ " + oweAmount);
				$("#reportNeed").text("S$ " + needAmount);
				total = needAmount+oweAmount;	
				populateHeaders(needAmount,oweAmount);	
		 });
	}
	
	$('#reportLoader').show();
	setReportHead();	
});	
	

//begin payment scripts
function setPayment(){
	var url = "http://mymoneyslate.com/api/addPaymentlist";
	var optionList = "<option value=\"0\" amt = \"\" selected = \"selected\">Select Person to pay</option>";
	$.getJSON(url, function(json) {
	   //set_local('payment_data',$.toJSON(json));
	   if(json.payment_list==undefined){
			optionList="<option>No one to pay</option>"
	   }
	   else{
		   $.each(json.payment_list, function(i,member){
			optionList+="<option value=\"" + member.mem_fb_id +"\"name = \"" +member.name + "\"amt =\"" + member.amount + "\">" + member.name + "</option>";
		   });
		   $('#payAmt_div').show();
		}
	$("#pay").html(optionList).selectmenu('refresh');
	$('#paymentLoader').hide();
	 });
	 /*if(!(navigator.onLine)){
		var data_json_payment=get_local('payment_data');
		var payment_data = $.evalJSON(data_json_payment);
		if(!!(payment_data.payment_list)){
		   $.each(payment_data.payment_list, function(i,member){
			optionList+="<option value=\"" + member.mem_fb_id +"\"name = \"" +member.name + "\"amt =\"" + member.amount + "\">" + member.name + " - " + member.uname + "</option>";
		   });
		}
	$("#pay").html(optionList).selectmenu('refresh');
	 }*/
}

function paymentinit(){
	$('#paymentValidateMsg').text('');
	$('#paymentValidateMsg').hide();
	$('#paymentLoader').show();
	$("#payment_Amount").val('');
	orig = 1;
	setPayment();
}
$('#addPaymentPage').live( 'pageshow',function(event){
	console.log('Payment show fired');
	paymentinit();
});

$('#addPaymentPage').live( 'pageinit',function(event){
console.log('payment page init fired');
setFbId();

$(this).bind("swipeleft", function(){
	var paySel = $('#pay').val();
	var payName = $('#pay option:selected').attr('name');
	if(paySel==0)
		$.mobile.changePage( "http://mymoneyslate.com/userreport.php");
	else
		$.mobile.changePage( "http://mymoneyslate.com/reportdetails.php?mem_id="+paySel+"&mem_name="+payName);
	});	

$('#paymentDetails').bind('click',function(){
	var paySel = $('#pay').val();
	var payName = $('#pay option:selected').attr('name');
	if(paySel==0)
		$.mobile.changePage( "http://mymoneyslate.com/userreport.php");
	else
		$.mobile.changePage( "http://mymoneyslate.com/reportdetails.php?mem_id="+paySel+"&mem_name="+payName);
});

$('#pay').bind("change",function() {
var amount_pay = $("#pay option:selected").attr("amt");
$('#payment_Amount').attr("value", amount_pay);
});


$('#paySubmit').bind('click',function(){
	//Payment validation starts here
	$('#paymentValidateMsg').text('');
	var amount_pay_text = parseFloat($("#payment_Amount").val());
	var origamt = parseFloat($("#pay option:selected").attr("amt"));
	var payMsg = '';
	if($('#pay').val()==0){
		payMsg='<h4>Please Select a Person to Pay</h4>'
		$('#paymentValidateMsg').html(payMsg);
		$('#paymentValidateMsg').show();
		$('#paymentValidateMsg').delay(1500).fadeOut();
		return false;
	}
	if(isNaN(amount_pay_text)){
		payMsg='<h4>Amount must be a number</h4>';
	}
	else if(amount_pay_text<0){
		payMsg='<h4>Enter a positive value</h4>';
	}
	else if((amount_pay_text>origamt)){
		payMsg='<h4>You can\'t pay more than you owe</h4>';
	}
	else if(amount_pay_text<origamt){
			orig = 0;
	}
	if(payMsg!=''){
		$('#paymentValidateMsg').html(payMsg);
		$('#paymentValidateMsg').show();
		return false;
	}
	//Payment Validation Ends here
	$.mobile.showPageLoadingMsg();
	var uid = $("#pay option:selected").attr("value");
	if(navigator.onLine){
		paymentData = new Object();
		paymentData['mem_id'] = uid;
		paymentData['user_id'] = fb_id;
		paymentData['amount'] = amount_pay_text;
		paymentData['original'] = orig;
		var payData = $.toJSON(paymentData);
		console.log(payData);
		$.ajax({
			  type: "PUT",
			  url: 'http://mymoneyslate.com/api/addPayment.php',
			  data: payData,
			  contentType: 'application/json', // format of request payload
			  dataType: 'json', // format of the response
			  success: function(msg) {
			paymentinit();
			reportUpdate=1;
			$.mobile.hidePageLoadingMsg();
			$.mobile.changePage( "http://mymoneyslate.com/home.php");
			  }
		});
	}
	else{
		insertIntoPayment(uid,amount_pay_text,orig);
		$.mobile.hidePageLoadingMsg();
	}
});


});

//begin @Me scripts
function populateMe(mon,yr){
   //alert(mon+yr);
   temp_mon=Number(mon)+1;
   temp_year=Number(yr)+1;
   if(yr!="12")
   var url = "http://mymoneyslate.com/api/getMee.php?sd="+yr+"-"+mon+"-1&ed="+yr+"-"+temp_mon+"-1";
   else
   var url = "http://mymoneyslate.com/api/getMee.php?sd="+yr+"-"+mon+"-1&ed="+temp_year+"-1-1";
   console.log(url);
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
		colorTag = "meter";
	}
	else {
		colorTag = "meter red";
	}
	element = element+'<li><h3><div class="ui-grid-a"><div class="ui-block-a"><b>'+ exp.category + '</b></div>';
	element = element+'<div class="ui-block-b">S$ '+ exp.amount + '<br/>';
	element = element+'<div class="' + colorTag + '" style="width: 100%"><span id='+ i + ' style="width: '+percent+'%"><span></div></div></div></h3>';
	element = element+'</li>';	
   });
   $("#meDetails").html(element);
   $("#meDetails").listview('refresh');
 });
}

$( '#mePage' ).live( 'pageinit',function(event){
	var today = new Date();
	var month,year;
	var myselect = $("#select-choice-month");
	myselect[0].selectedIndex = today.getMonth();
	myselect.selectmenu("refresh");
	var flag = $("#select-choice-year");
	var temp=today.getFullYear();
	var count=1;
	if(temp=="2010")
	count=0;
	else if(temp=="2011")
	count=1;
	else if(temp=="2012")
	count=2;
	else if(temp=="2013")
	count=3;
	else if(temp=="2014")
	count=4;
	else if(temp=="2015")
	count=5;
	flag[0].selectedIndex = count;
	flag.selectmenu("refresh");
	month=$('#select-choice-month').val();
	year=$('#select-choice-year').val();
	populateMe(month,year);  
	$('#fetch').click(function(){
	 console.log('fetch button clicked')
	month=$('#select-choice-month').val();
	year=$('#select-choice-year').val();
	populateMe(month,year);
	});
});

function checkAlerts(){
	var url = "http://mymoneyslate.com/api/feed_check.php";
	if(navigator.onLine){
		$.getJSON(url, function(json){
		msg=(json.msg)
		if(json.msg==true)
		{
		$('#alex').attr("data-theme","b");
		//$('#alerts').addClass('ui-btn-down-b').removeClass('ui-btn-down-a');
		$('#alex').addClass('ui-btn-hover-b').removeClass('ui-btn-hover-a');
		$('#alex').addClass('ui-btn-up-b').removeClass('ui-btn-up-a');
		}
	   });
	   }
	}

$( '#homePage' ).live( 'pageinit',function(event){
		console.log('pageinit fired for home');
		/*setFbId();
		checkAlerts();
		arrangeTiles();
		setReport();
		setMe();*/
		$('#alex').bind('click',function(){
			console.log('alex clicked');
			$('#alex').attr("data-theme","a");
			$('#alex').addClass('ui-btn-hover-a').removeClass('ui-btn-hover-b');
			$('#alex').addClass('ui-btn-up-a').removeClass('ui-btn-up-b');
		});
		$("#meImg").bind("load", function () {
						var theight = $(this).height();
						var expheight = $("#expCont").height();
						$("#expCont").css('padding-top',(theight/2)-expheight);
		});
		$("#repImg").bind("load", function () {
						var theight = $(this).height();
						var topheight = $("#topContent").height();
						var bottomheight = $("#bottomContent").height();
						$("#bottomContent").css('padding-top',theight-(bottomheight+topheight+12));
		});
	});
$( '#homePage' ).live( 'pageshow',function(event){
		console.log('pageshow fired for home');
		setFbId();
		//arrangeTiles();
		//refresh report only if necessary
		//if(reportUpdate==1){
			setReport();
			setMe();
		//}
		checkAlerts();
	});
	
	