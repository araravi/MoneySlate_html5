<?php
require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{   

    $sql=mysql_query("SELECT groups.group_id,groups.group_name FROM groups,group_det WHERE group_det.member_fb_id='".$id."' and groups.group_id=group_det.group_id") or die (mysql_error());
    $retArray=array();
	$retArray['mem_id']=$id;
	$temp=0;
	while($row = mysql_fetch_assoc($sql))
	{
	//print_r($row);
	$retArray['groups'][$temp]['group_id']=$row['group_id'];
	$retArray['groups'][$temp]['group_name']=$row['group_name'];
	$sql_temp=mysql_query("SELECT group_det.member_fb_id,member.mem_name FROM group_det,member WHERE group_det.group_id='".$row['group_id']."' and member.fb_id=group_det.member_fb_id")or die (mysql_error());
	while($flag=mysql_fetch_assoc($sql_temp))
	{
	if($flag['member_fb_id']==$id)
	continue;
	$retArray['groups'][$temp]['members'][]=$flag;
	//echo "......".$flag['photo'].".........";
	}
	$temp++;
	}
    //print_r($retArray);
    
	return $retArray;
}
        
		$user_list = getUserList($fb_id); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
		
?>

