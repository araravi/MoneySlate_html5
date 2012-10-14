<!DOCTYPE html>
<html>
<head>
    <title>MoneySlate</title>
	<meta name="description" content="MoneySlate Social Finance Tracker" />
	<meta name="keywords" content="MoneySlate,MyMoneySlate,mymoneyslate,moneyslate,slate,money,expense,tracker,expensetracker,finance,social,tracker,addexpense,makepayment,report,me,groups,creategroups,myexpense,editgroups,categories" />
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
	<script src="scripts/fb_redirect_logout.js"></script>
</head>
<!-- groupSettingPage -->
<div data-role="page" id = "groupUpdate">
<script>
	var group_id=false;
	var fb_user_id;
	
	function set_group(){
	//if group id exists, it is set in $(...) below
		var url = "http://mymoneyslate.com/api/groups";
		var people_in_group = "";
		if(navigator.onLine&&group_id){
			$.getJSON(url, function(json){
				groups = json.groups;
				console.log(groups);
				$.each(json.groups,function(i,group){
					if(group.group_id==group_id)
					{
						$("#group_name").val(group.group_name);
						console.log(group.members.length);
						for(var i=0; i<group.members.length; i++)
						{
								var friendId = group.members[i].member_fb_id;
								var listFriendId = friendId+'-ls';
								var removeFriendId = friendId+'-rem';
								var name = group.members[i].mem_name;
								if($('#'+removeFriendId).length==0){
									$('#group_update_members').append('<li data-icon="minus" parent='+friendId+' class="groupMembers-update" id='+removeFriendId+'><a href=#>'+name+'</a></li>')
									$("#group_update_members").listview('refresh');
								}
								$('#'+listFriendId).hide();
								$('#'+removeFriendId).live('click',function(){
									var friendId = $(this).attr('parent');
									$('#'+friendId+'-ls').show();
									$(this).remove();
								});
							
							//people_in_group += group.members[i].mem_name + ", ";
						}
						console.log(people_in_group);
						$("#people_in_group").val(people_in_group);
					}
				});
			});
		}
	}
	
	function set_fb_id(){
		var url="http://mymoneyslate.com/api/fb_id.php";
		$.getJSON(url,function(json){
			fb_user_id = json.mem_fb_id;
		});
	}
	
	function set_friends(friends){
	var friendsList = "";
	/*if($('#friendSearch').val()==""){  //was a bug now fixed uncomment to chech if bug exists
		console.log("live search bug exists");
		return false;
	}*/ 
	
	for(var i=0; i<friends.length; i++)
	{		
		if($('#'+friends[i].uid+'-rem-upd').length!=0){
			friendsList += '<li data-icon="plus" class="grpuphidden" fbID="'+friends[i].uid+'" id="'+friends[i].uid+'-ls-upd"><a href=#>'+friends[i].name+'</a></li>';
		}
		else{
			friendsList += '<li data-icon="plus" class="grpupnormal" fbID="'+friends[i].uid+'" id="'+friends[i].uid+'-ls-upd"><a href=#>'+friends[i].name+'</a></li>';	
		}
		$('#'+friends[i].uid+'-ls-upd').live('click',function(){
			var friendId = $(this).attr('fbID');
			var listFriendId = friendId+'-ls-upd';
			var removeFriendId = friendId+'-rem-upd';
			var name = $('#'+listFriendId).text();
			$('#'+listFriendId).hide();
			if($('#'+removeFriendId).length!=0){
				return false;
			}
			//if($('#'+removeFriendId).length==0){
				$('#group_update_members').append('<li data-icon="minus" parent="'+friendId+'" class="groupMembers-update" id="'+removeFriendId+'"><a href=#>'+name+'</a></li>')
				$("#group_update_members").listview('refresh');
			//}
			//$('#'+listFriendId).hide();
			console.log(listFriendId);
			$('#'+removeFriendId).bind('click',function(){
				var friendId = $(this).attr('parent');
				console.log('Length = '+$('#'+removeFriendId).length);
				console.log(friendId+'-ls-upd');
				console.log($('#'+friendId+'-ls-upd').length);
				$('#'+friendId+'-ls-upd').show();
				$(this).remove();
				$('#'+friendId+'-amt').remove();
			});
		});
	}
	$("#friends_details_group").html(friendsList);
	$("#friends_details_group").listview('refresh');
	$(".grpuphidden").hide();
}

function liveSearch(){
		var runningexpTagRequest = false;
		var prevtag = "";
			$('#groupUpdateSearch').bind('change keyup',function (e) {
				//e.preventDefault();
				console.log("change");
				var searchTag = $(this).val();
				if(searchTag.length<3){
					if(expTagRequest!=undefined)
						expTagRequest.abort();
					
					$("#friends_details_group").html('');
					//$("#friends_details_group").listview('refresh');
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
						$("#friends_details_group").html('<li>No one found</li>');
						$("#friends_details_group").listview('refresh');
						return false;
					}
					set_friends(friendsJson);
					runningexpTagRequest = false;
				});
				return false;
		});
	}
	
	var jsonGroupData=new Object();
	var groupMembers=new Object();
	
	$("#updateGroup").bind('click',function(){
		$('.groupMembers-update').each(function(index) {
			var temp=new Object();
			temp[index]=$(this).attr('parent');
			groupMembers[index]=temp;
			console.log(groupMembers[index]);
		});
		jsonGroupData['group_name'] = $('#group_name').val();
		jsonGroupData['creator'] = fb_user_id;
		jsonGroupData['members'] = groupMembers;
		jsonGroupData['group_id']= group_id;
		var groupData  = $.toJSON(jsonGroupData);
		console.log(groupData);
		$.ajax({
		      type: "PUT",
		      url: 'http://mymoneyslate.com/api/update_group.php',
		      data: groupData,
		      contentType: 'application/json', // format of request payload
		      dataType: 'json', // format of the response
		      success: function(msg) {
			  console.log(msg);
			      }
		});	
	});
	
	$( '#groupUpdate' ).live( 'pageinit',function(event){
		liveSearch();
	});
	
	$( '#groupUpdate' ).live( 'pageshow',function(event){
		set_fb_id();
		group_id = <?php if(isset($_GET["group_id"])){echo '"'.$_GET["group_id"].'"';} else echo "false";?>;
		if(group_id){
			set_group();
		}
		liveSearch();
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
	<h1>Group Setting</h1>
	<a id="updateGroup" href="myGroups.php" data-icon="plus" class="ui-btn-right">Save</a>
	<a href="myGroups.php" data-icon="back" class="ui-btn-left">Back</a>
</div> <!-- header --> 
<div data-role="content" class="ui-body ui-body-a">
	<div id = "groupSettingsContent">
		<div data-role="fieldcontain">
			<input type="search" id="groupUpdateSearch" placeholder="Search facebook friends to tag"/>
				<ul data-role="listview" data-theme="a" id="friends_details_group" data-inset="true">
			</ul>
		</div>
		<ul data-role="listview" data-theme="a" data-inset="true">
			<li>
				<div data-role="fieldcontain">
				<label for="group_name">Group Name:</label>
				<input type="text" name="group_name" id="group_name" value=""  />
				</div>
			</li>
			<li>
				<div data-role="fieldcontain">
				<label for="people_in_group">People in the group:</label>
					<div id="peopleGroupList">
						<ul data-role="listview" data-theme="b" id="group_update_members" data-role="listview" data-inset="true">
						</ul>	
					</div>
				<!---<textarea cols="40" rows="8" name="people_in_group" id="people_in_group"></textarea>--->
				</div>
			</li>
		</ul><!--friends_list_body-->
	</div><!--groupSettingContent-->
</div> <!-- content -->
</div> <!-- page -->
</html>