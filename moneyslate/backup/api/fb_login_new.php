<?php        
    
	function get_facebook_cookie($app_id, $app_secret) {
		if (!array_key_exists('fbs_' . $app_id, $_COOKIE)) {
			return null;
		}
		$args = array();
		parse_str(trim($_COOKIE['fbs_' . $app_id], '\\"'), $args);
		ksort($args);
		$payload = '';
		foreach ($args as $key => $value) {
			if ($key != 'sig') {
				$payload .= $key . '=' . $value;
			}
		}
		if (md5($payload . $app_secret) != $args['sig']) {
			return null;
		}
		return $args;
	}
	
	$fb_app_id = "190942770985124";
	$fb_app_secret = "a0ff5cab28ad4cd131ac6355b7758404";
	$fb_cookie = get_facebook_cookie($fb_app_id, $fb_app_secret);
	$fb_id = null;
	$access_token = null;
    
	if ($fb_cookie) {
		$fb_id = $fb_cookie['uid'];
		$access_token = $fb_cookie['access_token'];
		$graph_url = "https://graph.facebook.com/me?access_token=" . $access_token;
		$user = json_decode(file_get_contents($graph_url));
        $name= $user->name;
		$first_name = $user->first_name;
		//echo $first_name;
		$email=$user->email;
		//echo $fb_id." ".$name." ".$email;
		}
    else 
	{
	header( 'Location: http://www.mymoneyslate.com' ) ;
	}
	
	$con=mysql_connect('localhost','root','s@s@') or die (mysql_error());
    mysql_select_db("UOMe") or die (mysql_error());
	$sql=mysql_query("SELECT fb_id,uname,mem_name,first_name from member where fb_id='".$fb_id."'") or die (mysql_error());
    while($row = mysql_fetch_row($sql))
    { 
    $new123=$row;
    }
	if (!(isset($new123)))
	{
	$sql=mysql_query("INSERT INTO member(uname,fb_id,mem_name,first_name) VALUES ('{$email}','{$fb_id}','{$name}','{$first_name}')")or die (mysql_error());
    }
	
	if (!(isset($new123[2])))
    {
	$sql=mysql_query("UPDATE member SET mem_name='".$name."' WHERE fb_id='".$fb_id."'")or die (mysql_error());
    }
    if (!(isset($new123[3])))
    {	
    $sql1=mysql_query("UPDATE member SET first_name='".$first_name."' where fb_id='".$fb_id."'")or die (mysql_error());	
	}
	
	if (!(isset($new123[1])))
    {
	$sql=mysql_query("UPDATE member SET uname='".$email."' WHERE fb_id='".$fb_id."'")or die (mysql_error());
    }
	else if($new123[1]=="a@a.com")
	{
	$sql=mysql_query("UPDATE member SET uname='".$email."' WHERE fb_id='".$fb_id."'")or die (mysql_error());
	} 
	?>