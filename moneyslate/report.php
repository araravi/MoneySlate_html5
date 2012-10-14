<?php
/*
require_once('auth/includes/session.php');
require_once('auth/includes/functions.php');
confirmGreenSignal();
$auth=getUserId();
*/

//mysql connect
$con=mysql_connect('localhost','root','html5') or die (mysql_error());
mysql_select_db("UOMe") or die (mysql_error());

class RestRequest
{
	private $request_vars;
	private $data;
	private $http_accept;
	private $method;

	public function __construct()
	{
		$this->request_vars		= array();
		$this->data				= '';
		$this->http_accept		= (strpos($_SERVER['HTTP_ACCEPT'], 'json')) ? 'json' : 'xml';
		$this->method			= 'get';
	}

	public function setData($data)
	{
		$this->data = $data;
	}

	public function setMethod($method)
	{
		$this->method = $method;
	}

	public function setRequestVars($request_vars)
	{
		$this->request_vars = $request_vars;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getMethod()
	{
		return $this->method;
	}

	public function getHttpAccept()
	{
		return $this->http_accept;
	}

	public function getRequestVars()
	{
		return $this->request_vars;
	}
}

class RestUtils
{
	public static function processRequest()
	{
		// get our verb
		$request_method = strtolower($_SERVER['REQUEST_METHOD']);
		$return_obj		= new RestRequest();
		// we'll store our data here
		$data = array();

		switch ($request_method)
		{
			
			case 'get':
				$data = $_GET;
				break;
			
		}

		// store the method
		$return_obj->setMethod($request_method);

		// set the raw data, so we can access it if needed (there may be
		// other pieces to your requests)
		$return_obj->setRequestVars($data);

		if(isset($data['id']))
		{
			// translate the JSON to an Object for use however you want
			$return_obj->setData(json_decode($data['id']));
		}
		return $return_obj;
	}

	public static function sendResponse($status = 200, $body = '', $content_type = 'text/html')
	{
		$status_header = 'HTTP/1.1 ' . $status . ' ' . RestUtils::getStatusCodeMessage($status);
		// set the status
		header($status_header);
		// set the content type
		header('Content-type: ' . $content_type);

		// pages with body are easy
		if($body != '')
		{
			// send the body
			echo $body;
			exit;
		}
		// we need to create the body if none is passed
		else
		{
			// create some body messages
			$message = '';

			// this is purely optional, but makes the pages a little nicer to read
			// for your users.  Since you won't likely send a lot of different status codes,
			// this also shouldn't be too ponderous to maintain
			switch($status)
			{
				case 401:
					$message = 'You must be authorized to view this page.';
					break;
				case 404:
					$message = 'The requested URL ' . $_SERVER['REQUEST_URI'] . ' was not found.';
					break;
				case 500:
					$message = 'The server encountered an error processing your request.';
					break;
				case 501:
					$message = 'The requested method is not implemented.';
					break;
			}

			// servers don't always have a signature turned on (this is an apache directive "ServerSignature On")
			$signature = ($_SERVER['SERVER_SIGNATURE'] == '') ? $_SERVER['SERVER_SOFTWARE'] . ' Server at ' . $_SERVER['SERVER_NAME'] . ' Port ' . $_SERVER['SERVER_PORT'] : $_SERVER['SERVER_SIGNATURE'];

			// this should be templatized in a real-world solution
			$body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
						<html>
							<head>
								<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
								<title>' . $status . ' ' . RestUtils::getStatusCodeMessage($status) . '</title>
							</head>
							<body>
								<h1>' . RestUtils::getStatusCodeMessage($status) . '</h1>
								<p>' . $message . '</p>
								<hr />
								<address>' . $signature . '</address>
							</body>
						</html>';

			echo $body;
			exit;
		}
	}

	public static function getStatusCodeMessage($status)
	{
		// these could be stored in a .ini file and loaded
		// via parse_ini_file()... however, this will suffice
		// for an example
		$codes = Array(
		    100 => 'Continue',
		    101 => 'Switching Protocols',
		    200 => 'OK',
		    201 => 'Created',
		    202 => 'Accepted',
		    203 => 'Non-Authoritative Information',
		    204 => 'No Content',
		    205 => 'Reset Content',
		    206 => 'Partial Content',
		    300 => 'Multiple Choices',
		    301 => 'Moved Permanently',
		    302 => 'Found',
		    303 => 'See Other',
		    304 => 'Not Modified',
		    305 => 'Use Proxy',
		    306 => '(Unused)',
		    307 => 'Temporary Redirect',
		    400 => 'Bad Request',
		    401 => 'Unauthorized',
		    402 => 'Payment Required',
		    403 => 'Forbidden',
		    404 => 'Not Found',
		    405 => 'Method Not Allowed',
		    406 => 'Not Acceptable',
		    407 => 'Proxy Authentication Required',
		    408 => 'Request Timeout',
		    409 => 'Conflict',
		    410 => 'Gone',
		    411 => 'Length Required',
		    412 => 'Precondition Failed',
		    413 => 'Request Entity Too Large',
		    414 => 'Request-URI Too Long',
		    415 => 'Unsupported Media Type',
		    416 => 'Requested Range Not Satisfiable',
		    417 => 'Expectation Failed',
		    500 => 'Internal Server Error',
		    501 => 'Not Implemented',
		    502 => 'Bad Gateway',
		    503 => 'Service Unavailable',
		    504 => 'Gateway Timeout',
		    505 => 'HTTP Version Not Supported'
		);

		return (isset($codes[$status])) ? $codes[$status] : '';
	}
}

function getUserList($id)
{
	//$sql=mysql_query("SELECT exp_id,amount FROM member_expense where member_id='".$id."'") or die (mysql_error());
	$sql=mysql_query("SELECT DISTINCT member_expense.member_id FROM expense, member_expense WHERE expense.expense_creator_id ='".$id."'AND member_expense.exp_id = expense.exp_id AND member_expense.exp_paid ='N'")or die (mysql_error());
	$retArray=array();
	$tempArray1=array();
	$tempArray2=array();
	$tempArray3=array();
	$tempArray4=array();
	
	while($row = mysql_fetch_assoc($sql))
	{
		//array_push($retArray,$row);
		$tempArray1[]=$row['member_id'];
		//$finalArray[]=$retArray['amount'];
	}
	
    $sql=mysql_query("SELECT DISTINCT expense.expense_creator_id from member_expense,expense where member_expense.member_id='".$id."' and member_expense.exp_paid='N' AND expense.exp_id = member_expense.exp_id")or die (mysql_error());
    while($new = mysql_fetch_assoc($sql))
	{
	$tempArray2[]=$new['expense_creator_id'];
	}
	
	$tempArray3=array_merge($tempArray1,$tempArray2);
	$tempArray4=array_unique($tempArray3);
	$flag=0;
    
	$flagArray=array();
	$retArray['mem_id']=$id;
	
	foreach ($tempArray4 as $value)
	{	
	$flagArray[]="http://ec2-107-20-87-250.compute-1.amazonaws.com/report_det.php?id=".$id."&owe=".$value."";
    $flag++;
	}
	
	$flag=0;
	foreach ($tempArray4 as $value)
	{
	//echo $value."%%%%";
	$amount=0;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $flagArray[$flag]);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    $content = curl_exec($ch);
	curl_close($ch);
    $response = json_decode($content, true);
    
	//echo $response['Need_count']."....";
	if($response['Need_count']>0)
	{
	foreach($response['Need_from'] as $value1)
	{
    
	$name=$value1['mem_name'];
$uname=$value1['uname'];
	//echo $name.",,,";
	$id=$value1['member_id'];
	
	$amount=$amount+$value1['amount'];
	}
	}
	
	if($response['Owe_count']>0)
	{
	foreach($response['Owe_to'] as $value2)
	{
	
	$name=$value2['mem_name'];
	$uname=$value2['uname'];
	$id=$value2['expense_creator_id'];
	$amount=$amount-$value2['amount'];
	}
	}
	//echo $name."$$$$$$$$$$$$$$$$$$".$uname;
	$retArray['report'][$flag]['mem_id']=$id;
	$retArray['report'][$flag]['name']=$name;
	$retArray['report'][$flag]['uname']=$uname;
	if($amount>0)
	{
	$retArray['report'][$flag]['Need']=TRUE;
	$retArray['report'][$flag]['Owe']=FALSE;
	$retArray['report'][$flag]['amount']=$amount;
	}
	else if ($amount<0)
	{
	$retArray['report'][$flag]['Need']=FALSE;
	$retArray['report'][$flag]['Owe']=TRUE;
	$retArray['report'][$flag]['amount']=-$amount;
	}
	else if($amount==0)
	{
	$retArray['report'][$flag]['Need']=FALSE;
	$retArray['report'][$flag]['Owe']=FALSE;
	$retArray['report'][$flag]['amount']=0;
	}
	$flag++;
	}
	 
	/*
	foreach($tempArray as $value)
	{  //echo $value['exp_id']." "; 
		$sql=mysql_query("SELECT exp_name,date from expense where exp_id='".$value['exp_id']."'") or die (mysql_error());
		$row=mysql_fetch_assoc($sql);
		$row['amount']=$value['amount'];
		$finalArray[]=$row;
		
	}*/
	return $retArray;
	//return $obj;
	//return $tempArray4;
	//return $finalArray;
}
//echo json_encode(getUserList());



$data = RestUtils::processRequest();

/*if($auth!=$data->getData())
	    {RestUtils::sendResponse(401);
		}
*/
switch($data->getMethod())
{
	
	case 'get':
		$user_list = getUserList($data->getData()); // assume this returns an array
		RestUtils::sendResponse(200, json_encode($user_list), 'application/json');
		echo "sendresponsetrace";
		

		break;
	
}

?>

