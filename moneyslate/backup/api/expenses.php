<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id123)
{   $new=array();
    $new['mem_fb_id']=$id123;
    $sql=mysql_query("SELECT mem_id from member where fb_id='".$id123."'")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$id = $temp['mem_id'];
	$temp=0;
    $sql=mysql_query("SELECT exp_id,exp_name,exp_date from expense where expense_creator_id='".$id."' ORDER BY timestamp DESC")or die (mysql_error());
	while($row=mysql_fetch_assoc($sql))
	{
	
	$new['expenses'][$temp]['exp_id']=$row['exp_id'];
	$new['expenses'][$temp]['exp_name']=$row['exp_name'];
	
	$tok = strtok($row['exp_date'],"-");
    while ($tok !== false) {
    $new123[]=$tok;
    $tok = strtok("-");
	}
    $new['expenses'][$temp]['exp_date']=$new123[1]."/".$new123[2]."/".$new123[0];
    $temp++;	
	}
	return $new;
}


		$user_list = getUserList($fb_id); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
		
?>

