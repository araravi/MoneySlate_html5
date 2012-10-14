<?php
require_once('class.phpmailer.php');
define('GUSER', 'noreply.uome@gmail.com'); // Gmail username
define('GPWD', '3216!itson!'); // Gmail password


function smtpmailer($to, $from, $from_name, $subject, $body) { 
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465; 
	$mail->Username = GUSER;  
	$mail->Password = GPWD;           
	$mail->isHTML(true);
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$body.="<h1>welcome to UOMe</h1><br/><p>Aravindh wants you to join <a href=\"http://ec2-107-20-87-250.compute-1.amazonaws.com\"> UOMe</a> so that he can track his financial expense with you.</p><br/><p>We would like to take this oppotunituy to congratulate you on being one of the few members to have this opportunity.</p><br/><p> Regards, UOMe Team</p>";	
	$mail->Body = $body;
	$mail->AddAddress($to);
	
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo; 
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}

smtpmailer('aravindh.shankar.91@gmail.com', 'noreply.uome@gmail.com', 'UOMe', 'UOMe Beta Testing', 'This mail is to confirm your registration for beta testing with UOMe. Thank You.');
?>