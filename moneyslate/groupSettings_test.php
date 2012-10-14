<!DOCTYPE html>
<html>
<head>
    <title>Group Setting</title>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet"  href="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.css" />
	<link rel="stylesheet" href="datepicker/jquery.ui.datepicker.mobile.css" />	
	<link rel="stylesheet" type="text/css" href = "styles/progressbar.css"/>
	<link rel="stylesheet" type="text/css" href = "styles/homeStyle.css"/>
	<script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<script src="scripts/jqmProps.js"></script>
	<script src="http://code.jquery.com/mobile/1.0rc1/jquery.mobile-1.0rc1.min.js"></script>
	<script src="http://connect.facebook.net/en_US/all.js"></script>
	<script src="datepicker/jQuery.ui.datepicker.js"></script>
	<script src="datepicker/jquery.ui.datepicker.mobile.js"></script>
	<script src = "scripts/jquery.json-2.3.min.js"></script>
	<script src= "scripts/uoweme-scripts.js"></script>
	<div id="fb-root"></div>
	<script src="scripts/fb_redirect_logout.js"></script>
</head>
<!-- groupSettingPage -->
<div data-role="page" id = "groupSettings">
<script>
	var group_id=false;
	var fb_user_id;
	function set_group(){
	//if group id exists, it is set in $(...) below
		var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/groups";
		var people_in_group = "";
		if(navigator.onLine&&group_id){
			$.getJSON(url, function(json){
				groups = json.groups;
				$.each(json.groups,function(i,group){
					if(group.group_id==group_id)
					{
						$("#group_name").val(group.group_name);
						console.log(group.members.length);
						for(var i=0; i<group.members.length; i++)
						{
							people_in_group += group.members[i].mem_name + ", ";
						}
						console.log(people_in_group);
						$("#people_in_group").val(people_in_group);
					}
				});
			});
		}
	}
	
	function set_fb_id(){
		var url="http://ec2-107-20-87-250.compute-1.amazonaws.com/fb_id.php";
		$.getJSON(url,function(json){
			fb_user_id = json.mem_fb_id;
		});
	}
	
	var friends;
	
		function populate_friends(tag){
		//alert("ok");
		var friendsList = "";
		//alert(friends.length);
		var patt1=new RegExp(tag,i);
		var search_string = "/"+tag+"/i";
		//alert(search_string);
		for(var i=0; i<friends.length; i++)
			{   if(friends[i].name.search(patt1)>=0){
					friendsList += '<li data-icon="plus" id="'+friends[i].id+'-ls"><a href=# id='+friends[i].id+'>'+friends[i].name+'</a></li>';
					
					$('#'+friends[i].id).live('click',function(){
						var friendId = $(this).attr('id');
						var listFriendId = friendId+'-ls';
						var removeFriendId = friendId+'-rem';
						var name = $('#'+listFriendId).text();
						if($('#'+removeFriendId).length==0){
							$('#group_friends_details').append('<li data-icon="minus" parent='+friendId+' class="groupMembers" id='+removeFriendId+'><a href=#>'+name+'</a></li>')
							$("#group_friends_details").listview('refresh');
						}
						$('#'+listFriendId).hide();
						$('#'+removeFriendId).live('click',function(){
							var friendId = $(this).attr('parent');
							$('#'+friendId+'-ls').show();
							$(this).remove();
						});
						
					});
				}
			}
			$("#friends_details").html(friendsList);
			$("#friends_details").listview('refresh');
	}
	function set_friends(){
		var url = "http://ec2-107-20-87-250.compute-1.amazonaws.com/friends.php";
		
		$.getJSON(url, function(json){
			friends = json.data;
			alert("Friends Data loaded");
			/*for(var i=0; i<friends.length; i++)
			{
				friendsList += '<li data-icon="plus" id="'+friends[i].id+'-ls"><a href=# id='+friends[i].id+'>'+friends[i].name+'</a></li>';
				
				$('#'+friends[i].id).live('click',function(){
					var friendId = $(this).attr('id');
					var listFriendId = friendId+'-ls';
					var removeFriendId = friendId+'-rem';
					var name = $('#'+listFriendId).text();
					if($('#'+removeFriendId).length==0){
						$('#group_friends_details').append('<li data-icon="minus" parent='+friendId+' class="groupMembers" id='+removeFriendId+'><a href=#>'+name+'</a></li>')
						$("#group_friends_details").listview('refresh');
					}
					$('#'+listFriendId).hide();
					$('#'+removeFriendId).live('click',function(){
						var friendId = $(this).attr('parent');
						$('#'+friendId+'-ls').show();
						$(this).remove();
					});
					
				});
			}
			$("#friends_details").html(friendsList);
			$("#friends_details").listview('refresh');*/
		});
	}
	
	var jsonGroupData=new Object();
	var groupMembers=new Object();
	
	$("#saveGroup").live('click',function(){
		$('.groupMembers').each(function(index) {
			var temp=new Object();
			temp[index]=$(this).attr('parent');
			groupMembers[index]=temp;
			console.log(groupMembers[index]);
		});
		jsonGroupData['group_name'] = $('#group_name').val();
		jsonGroupData['creator'] = fb_user_id;
		jsonGroupData['members'] = groupMembers;
		var groupData  = $.toJSON(jsonGroupData);
		console.log(groupData);
		$.ajax({
		      type: "PUT",
		      url: 'http://ec2-107-20-87-250.compute-1.amazonaws.com/new_group.php',
		      data: groupData,
		      contentType: 'application/json', // format of request payload
		      dataType: 'json', // format of the response
		      success: function(msg) {
			      }
		});	
	});
	
	function liveSearch(){
			$('#friendSearch')
		  .change( function () {
			var s = $(this).val();
			populate_friends(s);
			return false;
		  })
		.keyup( function () {
			// fire the above change event after every letter
			$(this).change();
		});
	}
	
	$(function(){
	
		group_id = <?php if(isset($_GET["group_id"])){echo '"'.$_GET["group_id"].'"';} else echo "false";?>;
		if(group_id)
		{
		//set_group();
		}
		set_fb_id();
		set_friends();
		liveSearch();
	});
	</script>
<div data-role="header">
	<h1>Group Setting</h1>
	<a id="saveGroup" href="myGroups.php" data-icon="plus" class="ui-btn-right">Save</a>
	<a href="#" data-rel="back" data-icon="back" class="ui-btn-left">Back</a>
</div> <!-- header --> 
<div data-role="content">
	<div id = "groupSettingsContent">
		<ul data-role="listview" data-inset="true">
			<li>
				<div data-role="fieldcontain">
				<label for="group_name">Group Name:</label>
				<input type="text" name="group_name" id="group_name" value=""  />
				</div>
			</li>
			<li>
				<input type="search" id="friendSearch"/> 
			</li>
			<li>
				<div data-role="fieldcontain">
				<label for="people_in_group">People in the group:</label>
					<div id="peopleGroupList">
						<ul data-role="listview" id="group_friends_details" data-role="listview" data-inset="true">
						</ul>	
					</div>
				<!---<textarea cols="40" rows="8" name="people_in_group" id="people_in_group"></textarea>--->
				</div>
			</li>
		</ul>	
		<div id = "friends_list_body" class = "ui-body ui-body-b">
			<div data-role="fieldcontain">
				<ul data-role="listview" id="friends_details" data-role="listview" data-inset="true">
				</ul>
			</div>
		</div><!--friends_list_body-->
	</div><!--groupSettingContent-->
</div> <!-- content -->
<div data-role="footer">
<h2>IOU2</h2>
</div> <!-- footer -->
</div> <!-- page -->
</html>