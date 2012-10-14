<?php
require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{   //echo "adasdasd";
    $retArray=array();
    $url="http://www.mymoneyslate.com/api/feeds.php?id=".$id."&pass=uoweme1.";
    //echo $url;	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
    curl_close($ch);
	$response = json_decode($content, true);
	if(isset($response['feeds']))
	{
	foreach($response['feeds'] as $value)
	{
	if($value['seen']==0)
	{
	$retArray['msg']=true;
	return $retArray;
	}
	}
	}
//echo "sadasd";
$retArray['msg']=false;
return $retArray;
}


$user_list = getUserList($fb_id); // assume this returns an array
sendResponse(200, json_encode($user_list), 'application/json');

?>
