<?php
require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{ 
$retArray=array();
$retArray['mem_fb_id']=$id;  
$sql=mysql_query("SELECT member.first_name,feeds.creator_fb_id, feeds.owe, feeds.amount, feeds.seen, feeds.TIMESTAMP FROM member,feeds WHERE feeds.mem_fb_id ='".$id."' and member.fb_id=feeds.creator_fb_id ORDER BY feeds.timestamp DESC") or die(mysql_error());

$count=0;
$flag=0;
while($row=mysql_fetch_assoc($sql))
{
//print_r($row);
$count++;
if($row['seen']==1&&$count>5)
break;
$tok = strtok($row['TIMESTAMP']," ");
    while ($tok !== false) {
    $new[]=$tok;
    $tok = strtok(" ");
	}
$exp_date=$new[0];

//$new=json_decode(file_get_contents("http://graph.facebook.com/".$row['creator_fb_id']));
$row['amount']=round($row['amount'],2);
$retArray['feeds'][$flag]=$row;
//$retArray['feeds'][$flag]['first_name']=$new->first_name;
$retArray['feeds'][$flag]['exp_date']=$exp_date;
$flag++;
}
if(isset($_GET['pass']))
{
return $retArray;
}
$sql2=mysql_query("UPDATE feeds SET seen=1 WHERE mem_fb_id='".$id."'")or die(mysql_error());

return $retArray;
}

if(isset($_GET['id']))
{
$fb_id=$_GET['id'];
}

$user_list = getUserList($fb_id); // assume this returns an array
sendResponse(200, json_encode($user_list), 'application/json');

?>
