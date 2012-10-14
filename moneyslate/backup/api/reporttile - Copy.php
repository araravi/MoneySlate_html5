<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id123)
{   $sql=mysql_query("SELECT mem_id from member where fb_id='".$id123."'")or die (mysql_error());
	$temp=mysql_fetch_assoc($sql);
	$id = $temp['mem_id'];
    $url="http://ec2-107-20-87-250.compute-1.amazonaws.com/report.php?id=".$id123."&pass=uoweme1."; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    curl_close($ch);
	$response = json_decode($content, true);
    //print_r($response);
	$finalArray=array();
	$amount1=0;
	$amount2=0;
    $finalArray['Need']=0;
	$finalArray['Owe']=0;
	if(array_key_exists('report', $response))
    {
	foreach($response['report'] as $value)
    {
    if($value['Need']==true)
	$amount1=$amount1+$value['amount'];
	if($value['Owe']==true)
	$amount2=$amount2+$value['amount'];
	}
	$finalArray['Need']=$amount1;
	$finalArray['Owe']=$amount2;
	
	}
	
	$finalArray['mem_fb_id']=$id123;
	return $finalArray;
}



	
	
		$user_list = getUserList($fb_id); 
		sendResponse(200, json_encode($user_list), 'application/json');
		



?>

