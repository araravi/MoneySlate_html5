<?php

require_once("output.php");

		$request_method = strtolower($_SERVER['REQUEST_METHOD']);
		if ($request_method=='put')
				{
				$data=array();
				$incoming = (string)file_get_contents('php://input');
				$data = json_decode($incoming,true);
				//print_r($data);
				}

		

function setDB($values)
{   $final['msg']="fail";
    $group_name=$values['group_name'];
    $creator=$values['creator'];
	//echo $group_name."......".$creator;
	$sql=mysql_query("SELECT MAX(group_id) from groups")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$temp1=preg_replace("/[^\d]/", "", $temp);
	//print_r($temp1);
	$new=$temp1['MAX(group_id)']+1;
	$sql=mysql_query("INSERT INTO groups(group_id,group_name,creator_fb_id) VALUES ('{$new}','{$group_name}','{$creator}')")or die (mysql_error());
	$sql123=mysql_query("INSERT INTO group_det(group_id,member_fb_id) VALUES ('{$new}','{$creator}')")or die (mysql_error());
	$count=0;
	foreach($values['members'] as $flag)
	{
	$new123=NULL;
	$mem_id=$flag[$count];
	//echo $mem_id."....";
	$sql=mysql_query("SELECT fb_id from member where fb_id='".$mem_id."'") or die (mysql_error());
    while($row = mysql_fetch_row($sql))
    { 
    $new123=$row;
    }
	//print_r($new123);
    if (isset($new123))
	{
    $sql=mysql_query("INSERT INTO group_det(group_id,member_fb_id) VALUES ('{$new}','{$mem_id}')")or die (mysql_error());
	$final['msg']="success";
    }
	else 
    {
	 //echo "innn";
	 $temp="a@a.com";
	 $graph_url = "https://graph.facebook.com/".$mem_id;
	 $user = json_decode(file_get_contents($graph_url));
	 $temp_name = $user->name;
	 $fst_name = $user->first_name;
	 $sql=mysql_query("INSERT INTO member(uname,fb_id,mem_name,first_name) VALUES ('{$temp}','{$mem_id}','{$temp_name}','{$fst_name}')")or die (mysql_error());
	 $sql=mysql_query("INSERT INTO group_det(group_id,member_fb_id) VALUES ('{$new}','{$mem_id}')")or die (mysql_error());
	 $final['msg']="success";
	}
	//echo $mem_id."@@@";
	
	$count++;
	}
	$final['msg']="success";
    return json_encode($final);
	
}
		$values=$data;
		sendResponse(201, setDB($values));
		


?>



