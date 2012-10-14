<?php        
    
	// Function to retrieve the cookie set by Facebook
	// when the user logs in
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
	
	$fb_app_id = "137734082990634";
	$fb_app_secret = "8b1917f4dea9fd2952f25cf472fa09fb";
	$fb_cookie = get_facebook_cookie($fb_app_id, $fb_app_secret);
	$fb_id = null;
	$access_token = null;

	if ($fb_cookie) {
		$fb_id = $fb_cookie['uid'];
		$access_token = $fb_cookie['access_token'];
		$graph_url = "https://graph.facebook.com/me?access_token=" . $access_token;
		$user = json_decode(file_get_contents($graph_url));
        $name= $user->name;
		$email=$user->email;
		}
    else 
	{
	header( 'Location: http://ec2-107-20-87-250.compute-1.amazonaws.com/app0.1/index.php' ) ;
	}
	
	$con=mysql_connect('localhost','root','html5') or die (mysql_error());
    mysql_select_db("UOMe") or die (mysql_error());
	$sql=mysql_query("SELECT fb_id,uname from member where fb_id='".$fb_id."'") or die (mysql_error());
    while($row = mysql_fetch_row($sql))
    { 
    $new123=$row;
    }
	if (!(isset($new123)))
	{
	$sql=mysql_query("INSERT INTO member(uname,fb_id,mem_name) VALUES ('{$email}','{$fb_id}','{$name}')")or die (mysql_error());
    }
	else if($new123[1]=="a@a.com")
	{
	$sql=mysql_query("UPDATE member SET uname='".$email."' WHERE fb_id='".$fb_id."'")or die (mysql_error());
	}
	?>