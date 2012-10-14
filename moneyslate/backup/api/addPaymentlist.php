<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{
	$url="http://www.mymoneyslate.com/api/report.php?id=".$id."&pass=uoweme1."; 
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    curl_close($ch);
	$response = json_decode($content, true);
	$finalArray=array();
	$finalArray['mem_id']=$id;
	$flag=0;
	if(array_key_exists('report', $response))
    {
	foreach($response['report'] as $value)
    {
	if($value['Owe']=="true")
	{
	$finalArray['payment_list'][$flag]['mem_fb_id']=$value['mem_fb_id'];
	$finalArray['payment_list'][$flag]['name']=$value['name'];
	$finalArray['payment_list'][$flag]['amount']=$value['amount'];
	$flag++;
	}
	}
	}
	
return $finalArray;
}


		$user_list = getUserList($fb_id); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
		
	


?>

