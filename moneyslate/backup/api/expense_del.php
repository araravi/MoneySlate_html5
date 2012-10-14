<?php
require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{   

   $sql= mysql_query("DELETE from expense where exp_id='".$id."'") or die(mysql_error());
   return true;
}
        
		$user_list = getUserList($_GET['id']); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');



?>