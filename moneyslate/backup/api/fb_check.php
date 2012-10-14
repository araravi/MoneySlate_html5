<?php

require_once("fb_login.php");
require_once("output.php");

function check($c_id)
{
$sql=mysql_query("SELECT fb_id from member where fb_id='".$c_id."'") or die (mysql_error());
while($row = mysql_fetch_row($sql))
{
$new=$row;
}
echo '<a href="fb_check?id=121331">'.".....";
/*
if (isset($new))
return true;
else 
return false;
*/
}        

		
$id=$_GET['id'];
$user_list = check($id); 
sendResponse(200, json_encode($user_list), 'application/json');
?>