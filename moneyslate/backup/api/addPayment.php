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

function setDB($flag)
{    
    $id=$flag['mem_id'];
	$amount=$flag['amount'];
	$orig=$flag['original'];
	$user=$flag['user_id'];
               
     $tempArray=array();
	 $tempArray1=array();
	 $flagArray=array();
	//echo $id."     ".$amount."        ".$orig."           ".$user;
     $sql3=mysql_query("INSERT INTO feeds(mem_fb_id,creator_fb_id,owe,amount,exp_id) VALUES ('{$id}','{$user}',0,'{$amount}',582)")or die (mysql_error());
	 $url="http://www.mymoneyslate.com/api/report_det.php?id=".$user."&owe=".$id."&pass=uoweme1."; 
	 //echo $url;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
	curl_close($ch);
    $response = json_decode($content, true);
	//print_r($response);
	if($response['Need_count']>0)
	{
	foreach($response['Need_from'] as $value1)
	{
	$tempArray[]=$value1['id'];
	}
	}
    if($response['Owe_count']>0)
	{
	foreach($response['Owe_to'] as $value2)
	{
	$tempArray[]=$value2['id']; 
	}
	}
	$count=0;
	
	if($response['Owe_count']>0)
	{
	foreach($response['Owe_to'] as $value3)
	{
	$tempArray1['id'][]=$value3['id'];
    $tempArray1['amount'][]=$value3['amount'];	
	$count++;
	}
	}
	
	if($orig == 1)
	{
		foreach($tempArray as $value)
		{
		  $sql="UPDATE member_expense SET exp_paid='Y' WHERE id='".$value."'";
		  $result=mysql_query($sql)or die (mysql_error());
		}
	return true;
	}
	 
	
   else if ($orig == 0)
   {	
  
   for( $flag=0;$flag<$count;$flag++)
   {
   
   if ($amount == 0)
   return true;
   else if ($amount > $tempArray1['amount'][$flag])
   {
   $amount=$amount-$tempArray1['amount'][$flag];
   $sql="UPDATE member_expense SET exp_paid='Y' WHERE id='".$tempArray1['id'][$flag]."'";
   $result1=mysql_query($sql)or die (mysql_error());
   $new= mysql_query("UPDATE member_expense SET exp_diff='0' where id='".$tempArray1['id'][$flag]."'")or die (mysql_error()); 
   }
   else if ($amount<$tempArray1['amount'][$flag])
   {
   $amount_temp=0;
   $tempArray1['amount'][$flag]=$tempArray1['amount'][$flag]-$amount;
   //echo ".....Hii..".$tempArray1['amount'][$flag].",,,,".$tempArray1['id'][$flag];
   $sql=" UPDATE member_expense SET amount='".$tempArray1['amount'][$flag]."' where id='".$tempArray1['id'][$flag]."'";
   $result2=mysql_query($sql)or die (mysql_error());
   $temp=mysql_query("SELECT exp_diff from member_expense where id='".$tempArray1['id'][$flag]."'");
   	while($row = mysql_fetch_assoc($temp))
	{
		$flagArray=$row;
	}
	$amount_temp=$flagArray['exp_diff'];
	$amount_temp+=$amount;
   $new= mysql_query("UPDATE member_expense SET exp_diff='".$amount_temp."'  where id='".$tempArray1['id'][$flag]."'"); 
   $amount =0;
   return true;
   }
   
   }
   }
		
		
    return false;
	//  return $finalArray;
}



				
				
		$values=$data;
		sendResponse(201, setDB($values));
	


?>
