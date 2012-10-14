<?php

require_once("output.php");
			
function addBeta($name,$email)
{	
	$sql=mysql_query("INSERT INTO privateBeta (name,email_id) values ('{$name}','{$email}')") or die (mysql_error());
	if($sql)
	{
		return "true";
	}
	else
	{
	return mysql_error();
	}
}

				$data['bname'] = $_POST['bname'];
				$data['bemail']=$_POST['bemail'];

       

		$user_list = addBeta($data['bname'],$data['bemail']); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
	
	
?>

