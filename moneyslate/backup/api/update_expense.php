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
{   
    $sql=mysql_query("DELETE FROM expense where exp_id='".$values['exp_id']."'")or die (mysql_error());
	$final=array();
	$final['msg']="not done";
	$memberExpense=array();
	//print_r($values['mem_exp']);
	$memberExpense[]=array();
	$memberExpense[]=$values['mem_exp'];
	//echo isset($values['mem_exp']);
	
	$exp_name="";
	$exp_name=$values['exp_name'];
	$expense_creator_id=$values['expense_creator_id'];

	$sql=mysql_query("SELECT mem_id from member where fb_id='".$expense_creator_id."'") or die (mysql_error());
	while($row = mysql_fetch_row($sql))
	{
	$new=$row;
    }

	$expense_creator_id=$new[0];
	$exp_category_id=$values['exp_category_id'];
	$exp_description="";
	$exp_description=$values['exp_description'];
	$exp_amount=$values['exp_amount'];
	$lat=0;
	$lat=$values['lat'];
	$long=0;
	$long=$values['long'];
	$new=array();
    $tok = strtok($values['date'],"/");
    while ($tok !== false) {
    $new[]=$tok;
    $tok = strtok("/");
	}
    $exp_date=$new[2]."-".$new[0]."-".$new[1];
	//$exp_date='2011/1/1';
	//$exp_date=$values['date'];
	$amount=0;
	foreach($values['mem_exp'] as $new)
	{
	$amount=$amount+$new['mem_amount'];
	}
	if($amount>$exp_amount)
	{
	$final['msg']= "Sum of member expense higher than total amount";
	exit;
	}
	//insert into expense table
	$sql=mysql_query("INSERT INTO expense(exp_name,expense_creator_id,exp_category_id,exp_description,exp_amount,lat,longt,exp_date) VALUES ('{$exp_name}','{$expense_creator_id}','{$exp_category_id}','{$exp_description}','{$exp_amount}','{$lat}','{$long}','{$exp_date}')") or die (mysql_error());
	//retrieve id for previous insert statement
	$exp_id=mysql_insert_id();
	//insert into member_expense table
	foreach($values['mem_exp'] as $new)
	{    //echo "...........".$new;
	    $mem_name=$new['mem_name'];
		$mem_amount=$new['mem_amount'];
		$member_id=$new['member_id'];
		
		$sql=mysql_query("SELECT mem_id from member where fb_id='".$member_id."'") or die (mysql_error());
		while($row = mysql_fetch_row($sql))
		{ 
		$new123=$row;
		}
	
		if (isset($new123))
		{
		$sql2=mysql_query("INSERT INTO member_expense(member_id,mem_name,exp_id,amount) VALUES ('{$new123[0]}','{$mem_name}','{$exp_id}','{$mem_amount}')") or die (mysql_error());
		}
		else 
		{
		//echo "innn";
		$temp="a@a.com";
		
		
		$sql=mysql_query("INSERT INTO member(uname,fb_id,mem_name) VALUES ('{$temp}','{$member_id}','{$mem_name}')")or die (mysql_error());
		$sql=mysql_query("SELECT mem_id from member where fb_id='".$member_id."'") or die (mysql_error());
		while($row = mysql_fetch_row($sql))
		{
		$new=$row;
		}

		$mem_id=$new[0];
		$sql2=mysql_query("INSERT INTO member_expense(member_id,mem_name,exp_id,amount) VALUES ('{$mem_id}','{$mem_name}','{$exp_id}','{$mem_amount}')") or die (mysql_error());
		}
		
		
		
	}
	if($sql||$sql2)
	{	
		$final['msg']="success";
		return json_encode($final);
	}
	else
	{
	$final['msg'] = mysql_error();
	return json_encode($final);
	}
	return json_encode($final);
}
	

	   
		$values=$data;
		sendResponse(201, setDB($values));
		










?>