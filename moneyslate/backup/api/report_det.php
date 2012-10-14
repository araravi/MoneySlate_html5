<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id,$owe)
{    
    $sql=mysql_query("SELECT mem_id from member where fb_id='".$id."'")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$id = $temp['mem_id'];
	$sql=mysql_query("SELECT mem_id from member where fb_id='".$owe."'")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$owe = $temp['mem_id'];
	
	

     $sql="SELECT member_expense.id, member_expense.exp_id,expense.exp_name, expense.exp_date,expense.lat, expense.longt, member_expense.amount, expense.expense_creator_id,member.mem_name,member.fb_id FROM expense,member_expense,member where member_expense.member_id=".$id." and member_expense.exp_paid='N' and expense.expense_creator_id=".$owe." and expense.exp_id=member_expense.exp_id and member.mem_id=expense.expense_creator_id ORDER BY member_expense.timestamp DESC";

	$retArray=array();
	$result1=mysql_query($sql)or die (mysql_error());
	$count1=0;
	$count2=0;
	while($row = mysql_fetch_assoc($result1))
	{
		
		$retArray['Owe_to'][]=$row;
		$count1++;
	}
	
	$sql="SELECT member_expense.id, expense.exp_id, expense.exp_name, expense.exp_date,expense.lat, expense.longt, member_expense.member_id, member_expense.mem_name,member.fb_id,member_expense.amount FROM member,expense,member_expense where expense.expense_creator_id=".$id." and member_expense.exp_id=expense.exp_id and member_expense.exp_paid='N' and member_expense.member_id='".$owe."' and member.mem_id=member_expense.member_id ORDER BY member_expense.timestamp DESC";
	$result=mysql_query($sql)or die (mysql_error());
	while($new = mysql_fetch_assoc($result))
	{
		
		$retArray['Need_from'][]=$new;
		$count2++;
	}
	$retArray['Owe_count']=$count1;
    $retArray['Need_count']=$count2;
	
		return $retArray;
	//  return $finalArray;
}
        $data2=$_GET['owe'];
		$data1=$fb_id;
		if(isset($_GET['id']))
		{
		if($_GET['pass']!="uoweme1.")
		{sendResponse(401);}
		$data1=$_GET['id'];
		}
		
		
		$user_list = getUserList($data1,$data2); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
		

?>
