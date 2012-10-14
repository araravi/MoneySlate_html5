<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{
    $sql=mysql_query("SELECT mem_id from member where fb_id='".$id."'") or die (mysql_error());
	while($row = mysql_fetch_row($sql))
	{
	$new=$row;
    }

	$id123=$new[0];

	$sql=mysql_query("SELECT cat_id,cat_name FROM exp_category where member_id='".$id123."' OR member_id=0") or die (mysql_error());
	$retArray=array();
	$retArray['mem_fb_id']=$id;
	while($row = mysql_fetch_assoc($sql))
	{
		//array_push($retArray,$row);
		$retArray['Categories'][]=$row;
		//$finalArray[]=$retArray['amount'];
	}
	
	return $retArray;
}
//echo json_encode(getUserList());

$user_list = getUserList($fb_id); 
sendResponse(200, json_encode($user_list), 'application/json');
?>
