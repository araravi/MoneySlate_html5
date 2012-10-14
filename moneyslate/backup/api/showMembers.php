<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{ 
	$sql=mysql_query("SELECT mem_id,uname,mem_name,photo from member where fb_id<>'".$id."' and mem_id <> 0 ORDER BY mem_name,uname") or die (mysql_error());
	$retArray=array();
	$retArray['mem_id']=$id;
	while($row = mysql_fetch_assoc($sql))
	{
	$retArray['members'][]=$row;
	}

	return $retArray;
}

$user_list = getUserList($fb_id); // assume this returns an array
sendResponse(200, json_encode($user_list), 'application/json');


?>

