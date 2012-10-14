<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id123)
{

    $sql=mysql_query("SELECT mem_id from member where fb_id='".$id123."'")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$id = $temp['mem_id'];
	$totalexp=0;
//fetch all categories belonging to user and general
	$sql=mysql_query("SELECT * from exp_category where member_id='{$id}' OR member_id=0") or die (mysql_error());
	$catArray=array();
	$expArray=array();
	$finalArray=array();
	$tempArray1=array();
	$tempArray2=array();
	$finalArray['mem_fb_id']=$id123;
//	$expArray['mem_id']=$id;
//create category array
	while($row = mysql_fetch_assoc($sql))
	{
		//array_push($retArray,$row);
		$catArray[]=$row;
		//$finalArray[]=$retArray['amount'];
	}
	
//fetch all exp under given category for the given user
	foreach($catArray as $value)
	{  //echo $value['exp_id']." "; 
		$tempFinalAmt=0;
		$tempPosAmt=0;
		$tempNegAmt=0;
		$totalAmt=0;
		
		$sql=mysql_query("SELECT exp_id,exp_amount from expense where exp_category_id='".$value['cat_id']."' and expense_creator_id='".$id."'") or die (mysql_error());
		$expArray['category']=$value['cat_name'];
		$expArray['cat_limit']=$value['limit'];
		while($row=mysql_fetch_assoc($sql))
		{
			//fetch friends expense which have received payment for given exp_id and sub from original amount	
			$sql2=mysql_query("SELECT amount,exp_diff from member_expense where exp_id='".$row['exp_id']."' and exp_paid='Y'") or die (mysql_error());
			while($row2=mysql_fetch_assoc($sql2))
			{
				$tempNegAmt=$tempNegAmt+$row2['exp_diff']+$row2['amount'];
			}
			$sql3=mysql_query("SELECT exp_diff from member_expense where exp_id='".$row['exp_id']."' and exp_paid='N' and exp_diff<>0") or die (mysql_error());
			while($row3=mysql_fetch_assoc($sql3))
			{
			    $tempNegAmt+=$row3['exp_diff'];
			}
			$tempPosAmt+=$row['exp_amount'];
		}
		$tempFinalAmt=$tempPosAmt-$tempNegAmt;
		
		$expArray['amount']=$tempFinalAmt;
		
		$finalArray['Expense'][]=$expArray;
		$totalAmt+=$tempFinalAmt;
	}
	
	$sql=mysql_query("SELECT member_expense.exp_diff,member_expense.amount, exp_category.cat_name, exp_category.limit,exp_category.cat_id FROM member_expense, expense, exp_category WHERE member_expense.member_id ='".$id."' AND member_expense.exp_paid =  'Y' AND expense.exp_id = member_expense.exp_id AND exp_category.cat_id = expense.exp_category_id");
	$tempArray=array();
	while($row = mysql_fetch_assoc($sql))
	{
	$tempArray2[]=$row;
	}
	
	$api=mysql_query("SELECT member_expense.exp_diff,member_expense.amount, exp_category.cat_name, exp_category.limit,exp_category.cat_id from member_expense,expense,exp_category where exp_diff<>0 and member_expense.exp_paid='N' and member_expense.member_id='".$id."' AND expense.exp_id = member_expense.exp_id AND exp_category.cat_id = expense.exp_category_id")or die (mysql_error());;
	while($ex = mysql_fetch_assoc($api))
	{
	$tempArray1[]=$ex;
	}
	//print_r($tempArray1);
	
   	
	foreach($tempArray1 as $value)
	{
	$count=0;
	for($i=0;$i<count($finalArray['Expense']);$i++)
	{
	//echo $value['cat_name']."$$$$$";
    //print_r($flag['category']);	
	//echo "####";
	if($value['cat_name']== $finalArray['Expense'][$i]['category'])
	{
	//echo "insideeee";
	$count=1;
	//echo $flag['amount']."+".$value['amount'];
	$finalArray['Expense'][$i]['amount']= $finalArray['Expense'][$i]['amount']+$value['exp_diff'];
	$totalexp+=$finalArray['Expense'][$i]['amount'];
	}
	}
	if($count==0)
	{
	$flag[]['category']=$value['cat_name'];
	$flag[]['cat_limit']=$value['limit'];
	$flag[]['amount']=0;
	}
	
	}
	
	//print_r($tempArray);
	//echo count($tempArray)."........";
	foreach($tempArray2 as $value)
	{
	$count=0;
	for($i=0;$i<count($finalArray['Expense']);$i++)
	{
	//echo $value['cat_name']."$$$$$";
    //print_r($flag['category']);	
	//echo "####";
	if($value['cat_name']== $finalArray['Expense'][$i]['category'])
	{
	//echo "insideeee";
	$count=1;
	//echo $flag['amount']."+".$value['amount'];
	$finalArray['Expense'][$i]['amount']= $finalArray['Expense'][$i]['amount']+$value['amount']+$value['exp_diff'];
	$totalexp+=$finalArray['Expense'][$i]['amount'];
	}
	}
	
	if($count==0)
	{
	$flag[]['category']=$value['cat_name'];
	$flag[]['cat_limit']=$value['limit'];
	$flag[]['amount']=0;
	}
	
	}
    $finalArray['totalexp']=$totalexp;
	
	return $finalArray;
}

        $temp=$fb_id;
		if (isset($_GET['id']))
		{
		$temp=$_GET['id'];
		$pass=$_GET['pass'];
		if($pass!="uoweme1.")
		sendResponse(401);
		}
	    
		$user_list = getUserList($temp); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
			


?>

