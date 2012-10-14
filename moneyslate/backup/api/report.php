<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id123)
{   
    $sql=mysql_query("SELECT mem_id from member where fb_id='".$id123."'")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$id = $temp['mem_id'];
	//$sql=mysql_query("SELECT exp_id,amount FROM member_expense where member_id='".$id."'") or die (mysql_error());
	$sql=mysql_query("SELECT DISTINCT member.fb_id FROM member, expense, member_expense WHERE member.mem_id=member_expense.member_id and expense.expense_creator_id ='".$id."'AND member_expense.exp_id = expense.exp_id AND member_expense.exp_paid ='N'")or die (mysql_error());
	$retArray=array();
	$tempArray1=array();
	$tempArray2=array();
	$tempArray3=array();
	$tempArray4=array();
	
	while($row = mysql_fetch_assoc($sql))
	{   
	    //echo $row['fb_id'];
		//array_push($retArray,$row);
		$tempArray1[]=$row['fb_id'];
		//$finalArray[]=$retArray['amount'];
	}
	
    $sql=mysql_query("SELECT DISTINCT member.fb_id from member, member_expense,expense where member.mem_id=expense.expense_creator_id and member_expense.member_id='".$id."' and member_expense.exp_paid='N' AND expense.exp_id = member_expense.exp_id")or die (mysql_error());
    while($new = mysql_fetch_assoc($sql))
	{
	//echo $new['fb_id'];
	$tempArray2[]=$new['fb_id'];
    }
	
	$tempArray3=array_merge($tempArray1,$tempArray2);
	$tempArray4=array_unique($tempArray3);
	$flag=0;
    //print_r($tempArray4);
	$flagArray=array();
	$retArray['mem_fb_id']=$id123;
	
	foreach ($tempArray4 as $value)
	{	
	$flagArray[]="http://www.mymoneyslate.com/api/report_det.php?id=".$id123."&owe=".$value."&pass=uoweme1.";
    //echo $flagArray[$flag]."    ";
	$flag++;
	}
	
	$flag=0;
	foreach ($tempArray4 as $value)
	{
	//echo $value."%%%%";
	$amount=0;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $flagArray[$flag]);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
	curl_close($ch);
    $response = json_decode($content, true);
	//print_r($response);
	//echo $response['Need_count']."....";
	if($response['Need_count']>0)
	{
	foreach($response['Need_from'] as $value1)
	{
    
	$name=$value1['mem_name'];
	$id=$value1['fb_id'];
	
	$amount=$amount+$value1['amount'];
	}
	}
	
	if($response['Owe_count']>0)
	{
	foreach($response['Owe_to'] as $value2)
	{
	
	$name=$value2['mem_name'];
	$id=$value2['fb_id'];
	$amount=$amount-$value2['amount'];
	}
	}
	//echo $name."$$$$$$$$$$$$$$$$$$".$uname;
	$retArray['report'][$flag]['mem_fb_id']=$id;
    $sql123=mysql_query("SELECT first_name from member where fb_id='".$id."'")or die (mysql_error()); 
	while($new = mysql_fetch_assoc($sql123))
	{
	$fst_name=$new['first_name'];
    }
	
    //$new=json_decode(file_get_contents("http://graph.facebook.com/".$id));
	$retArray['report'][$flag]['first_name']=$fst_name;
    $retArray['report'][$flag]['name']=$name;
	if($amount>0)
	{
	$retArray['report'][$flag]['Need']=TRUE;
	$retArray['report'][$flag]['Owe']=FALSE;
	$retArray['report'][$flag]['amount']=$amount;
	}
	else if ($amount<0)
	{
	$retArray['report'][$flag]['Need']=FALSE;
	$retArray['report'][$flag]['Owe']=TRUE;
	$retArray['report'][$flag]['amount']=-$amount;
	}
	else if($amount==0)
	{
	$retArray['report'][$flag]['Need']=FALSE;
	$retArray['report'][$flag]['Owe']=FALSE;
	$retArray['report'][$flag]['amount']=0;
	}
	$flag++;
	}
	 
	return $retArray;
	
}

		if(isset($_GET['id']))
		{
		if($_GET['pass']!="uoweme1.")
		{sendResponse(401);}
		$fb_id=$_GET['id'];
		}
		$user_list = getUserList($fb_id); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
			


?>

