<?php

session_start();
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
	
print_r($fb_cookie);
         unset($_SESSION['fb'.$fb_app_id.'_code']);
unset($_SESSION['fb'.$fb_app_id.'_access_token']);
unset($_SESSION['fb'.$fb_app_id.'_user_id']);  
print_r($fb_cookie);
		  
   //First remove FB cookie
  // $this	->load->helper('cookie');
    //session_destroy();
	//delete_cookie('fbs_190942770985124');
    //Then destroy CI session
    //$this->session->sess_destroy();
    //redirect('');
?>