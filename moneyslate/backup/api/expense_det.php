<?php

require_once("fb_login.php");
require_once("output.php");

function getUserList($id)
{
$retArray=array();   
$sql=mysql_query("SELECT expense.exp_id,expense.exp_name,expense.exp_description,expense.exp_amount,expense.exp_category_id,exp_category.cat_name,expense.exp_date,expense.lat,expense.longt FROM expense,exp_category WHERE expense.exp_id='".$id."' and exp_category.cat_id=expense.exp_category_id")or die (mysql_error());
while($row = mysql_fetch_assoc($sql))
	{
		$retArray['exp_id']=$row['exp_id'];
		$retArray['exp_name']=$row['exp_name'];
		$retArray['exp_description']=$row['exp_description'];
		$retArray['exp_amount']=$row['exp_amount'];
		
		$tok = strtok($row['exp_date'],"-");
		while ($tok !== false) {
		$new123[]=$tok;
		$tok = strtok("-");
		}
		
		$retArray['exp_date']=$new123[1]."/".$new123[2]."/".$new123[0];
		$retArray['exp_cat_id']=$row['exp_category_id'];
		$retArray['cat_name']=$row['cat_name'];
		if($row['lat']==-1&&$row['longt']==-1)
		$retArray['location']=false;
		else
		$retArray['location']=true;
	}
$sql1=mysql_query("SELECT member_id,mem_name,amount,exp_paid from member_expense where exp_id='".$id."'")or die (mysql_error());
$flag=0;
while($new = mysql_fetch_assoc($sql1))
{  
     $sql=mysql_query("SELECT fb_id from member where mem_id='".$new['member_id']."'")or die (mysql_error());
	 $new123=mysql_fetch_assoc($sql);
	 $f_id=$new123['fb_id'];
     $retArray['members'][$flag]['mem_fb_id']=$f_id;
	 $retArray['members'][$flag]['mem_name']=$new['mem_name'];
	 $retArray['members'][$flag]['mem_amount']=$new['amount'];
	 $retArray['members'][$flag]['exp_paid']=$new['exp_paid'];
	 $flag++;
}

return $retArray;

}

$exp_id=$_GET['exp_id'];
$user_list = getUserList($exp_id); 
sendResponse(200, json_encode($user_list), 'application/json');

?>
