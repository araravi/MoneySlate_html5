<?php
require_once("fb_login.php");
$friends = file_get_contents('https://graph.facebook.com/me/friends?access_token='.$access_token);

echo $friends;
?>