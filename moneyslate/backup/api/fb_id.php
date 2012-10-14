<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{
$retArray=array();
$retArray['mem_fb_id']=$id;
return $retArray;
}

$user_list = getUserList($fb_id); 
sendResponse(200, json_encode($user_list), 'application/json');

?>
