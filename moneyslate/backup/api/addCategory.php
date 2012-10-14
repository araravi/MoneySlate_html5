<?php

require_once("output.php");
			
function getUserList($id,$cat)
{
	$sql=mysql_query("SELECT mem_id from member where fb_id='".$id."'")or die (mysql_error());
	while($row = mysql_fetch_assoc($sql))
    { 
    $new123=$row;
    }
		
	
	$member_id=$new123['mem_id'];
	$cat_name=$cat;
	
	$sql=mysql_query("INSERT INTO exp_category (member_id,cat_name) values ('{$member_id}','{$cat_name}')") or die (mysql_error());
	if($sql)
	{
		return "true";
	}
	else
	{
	return mysql_error();
	}
}

				$data['mem_id'] = $_POST['mem_id'];
				$data['category']=$_POST['category'];

       

		$user_list = getUserList($data['mem_id'],$data['category']); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
	
	
?>

