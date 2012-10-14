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
	
	$fb_app_id = "137734082990634";
	$fb_app_secret = "8b1917f4dea9fd2952f25cf472fa09fb";
	$fb_cookie = get_facebook_cookie($fb_app_id, $fb_app_secret);
	$fb_id = null;
	$access_token = null;

	if ($fb_cookie) {
		$fb_id = $fb_cookie['uid'];
		$access_token = $fb_cookie['access_token'];
		
		}
   
$id123=$_GET['id'];
$id=strtolower ( $id123 );
$fql_query_url = "https://api.facebook.com/method/fql.query?query=SELECT+uid%2C+name+FROM+user+WHERE+uid+IN+%28%0ASELECT+uid2+FROM+friend+WHERE+uid1%3Dme%28%29%29%0AAND+strpos%28lower%28name%29%2C%22".urlencode($id)."%22%29+%3E%3D0&access_token=".$access_token."&format=json";
  //echo $fql_query_url;
  $fql_query_result = file_get_contents($fql_query_url);
  $fql_query_obj = json_decode($fql_query_result, true);

  //display results of fql query
 
  print_r($fql_query_result);
  
//echo $friends;
?>