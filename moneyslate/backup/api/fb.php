<!DOCTYPE html> 
<html>
<head>
<?php
$con=mysql_connect('localhost','root','html5') or die (mysql_error());
mysql_select_db("UOMe") or die (mysql_error());

define('137734082990634', 'your_app_id');
define('8b1917f4dea9fd2952f25cf472fa09fb', 'your_app_secret');

function parse_signed_request($signed_request, $secret) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
    error_log('Unknown algorithm. Expected HMAC-SHA256');
    return null;
  }

  // check sig
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }

  return $data;
}

function base64_url_decode($input) {
    return base64_decode(strtr($input, '-_', '+/'));
}

function error_alert()
{
echo '<script type="text/javascript">alert("Hurray! Seems you are already registered with us!");</script>';
}
function correct_alert()
{
echo '<script type="text/javascript">alert("Successfully registered !!!");</script>';
}
function add($name,$uname,$pass,$fb_id)
{
//echo $name;
//echo $uname;
//echo $pass;
if(isset($fb_id))
{$photo="http://graph.facebook.com/".$fb_id."/picture";}
else
{$photo="http://ec2-107-20-87-250.compute-1.amazonaws.com/dummy.gif";}
$hashed_password = sha1($pass);
$sql="SELECT uname from member where uname='".$uname."'";
$result=mysql_query($sql) or die (mysql_error());
$num_rows = mysql_num_rows($result);
if ($num_rows==0)
{
$sql="INSERT INTO member (uname, mem_name,password,fb_id,photo) VALUES ('{$uname}','{$name}','{$hashed_password}','{$fb_id}','{$photo}')";
$result=mysql_query($sql) or die (mysql_error());
//echo '<script type="text/javascript">alert("Successfully registered !!!");</script>';
correct_alert();
echo '<script type="text/javascript">window.location = "http://ec2-107-20-87-250.compute-1.amazonaws.com/auth/login.php?uname='.$uname.'"</script>';
//header( 'Location: http://ec2-107-20-87-250.compute-1.amazonaws.com/auth/login.php' );
}
else
{
//echo "<script language=javascript>alert('Please enter a valid username.')</script>";
//echo "safffasfsf";
error_alert();
echo '<script type="text/javascript">window.location = "http://ec2-107-20-87-250.compute-1.amazonaws.com/auth/login.php?uname='.$uname.'";</script>';
}
}

if ($_REQUEST) {
  
  $response = parse_signed_request($_REQUEST['signed_request'], 
                                   '8b1917f4dea9fd2952f25cf472fa09fb');
  echo '<pre>';
  //$obj = json_decode($response);
  $name=$response['registration']['name'];
  $uname=$response['registration']['email'];
  $pass=$response['registration']['password'];
  if(array_key_exists('user_id', $response))
  {$fb_id=$response['user_id'];}
  else {$fb_id=NULL;}
  add($name,$uname,$pass,$fb_id);
  //print_r($response);
  echo '</pre>';
  
  
 // header( 'Location: http://ec2-107-20-87-250.compute-1.amazonaws.com/auth/login.php' );
} else {
  echo '$_REQUEST is empty';
}
?>
</head>
</html>