<?php

ini_set('display_errors',1);
error_reporting(-1);

define('DATA_PATH', realpath(dirname(__FILE__).'/data'));
//echo DATA_PATH;
//echo "hello index";
$applications = array(
 	'APP001' => '1234');
//print_r($applications);
include_once ('models/TodoItem.php');
try
 {
 	$params = $_REQUEST;
 	$app_id = $params['app_id'];
 	//echo $app_id;
 	print_r($params);

	if(isset($applications[$app_id]))
	{
		throw new Exception('Application doesnot exist');
	}

// 	// //$params = json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $applications[$app_id],base64_decode($enc_request),MCRYPT_MODE_ECB)));

	if($params['action'] == NULL && $params['controller'] == NULL)
	{
		throw new Exception('Request is not valid');
	}

	$controller =  ucfirst(strtolower($params['controller']));
	$action = strtolower($params['action']).'Action';
	//echo $controller;
	//echo $action;

	if(file_exists("controllers/{$controller}.php"))
	{
		include_once ("controllers/{$controller}.php");
	} 
	else 
	{
		throw new Exception ('Controller is invalid');
	}

	$controller = new $controller($params);
	if (method_exists($controller, $action) === false)
	{
		throw new Exception ('Action is invalid');
	}
	//echo "new name";
	$result['data'] = $controller->$action();
	print_r ($result);
	$result['success'] = true;
	//$result = json_encode($result);
		//error_reporting(E_ALL);

} 
 catch (Exception $e)
 {
 	$result['success'] = false;
 	$result['errormsg'] = $e->getMessage();
 	echo $result['success'];
}

echo json_encode($result);
exit();
?>