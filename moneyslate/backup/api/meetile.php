<?php

require_once("fb_login_new.php");
require_once("output.php");

function getUserList($id,$m,$y)
{   
	$temp_m=(int)$m+1;
	$temp_y=(int)$y+1;
    if($m!=12)
	$url="http://www.mymoneyslate.com/api/getMee.php?id=".$id."&pass=uoweme1.&sd=".$y."-".$m."-1&ed=".$y."-".$temp_m."-1";
	else
	$url="http://www.mymoneyslate.com/api/getMee.php?id=".$id."&pass=uoweme1.&sd=".$y."-".$m."-1&ed=".$temp_y."-1-1";
	//echo $url;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
	curl_close($ch);
    $response = json_decode($content, true);
    $finalArray=array();
	$finalArray['amount']=$response['totalexp'];
	$finalArray['mem_fb_id']=$id;
	return $finalArray;
}

        $mon=$_GET['month']; 
		$year=$_GET['year'];
		$user_list = getUserList($fb_id,$mon,$year); // assume this returns an array
		sendResponse(200, json_encode($user_list), 'application/json');
		
?>

