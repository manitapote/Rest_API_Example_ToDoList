<?php
define('DATA_PATH', realpath(dirname(__FILE__).'/data'));
//echo DATA_PATH;
//echo "hello index";
$applications = array(
	'APPOO1' => '28e336ac6c9423d946ba02d19c6a2632');
include_once ('models/TodoItem.php');
	//echo "true  sfsd";
try
{
	$enc_request = $_REQUEST['enc_request'];
	$app_id = $_REQUEST['app_id']; 

	if(!isset($applications[$app_id]))
	{
		throw new Exception('Application doesnot exist');
	}

	$params = json_decode(trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $applications[$app_id],base64_decode($enc_request),MCRYPT_MODE_ECB)));

	if($params == false || ) isset($params->controller) == false || isset($params->action) == false)
	{
		throw new Exception('Request is not valid');
	}

	$params = (array)$params;
	//$params = $_REQUEST;
	$controller =  ucfirst(strtolower($params['controller']));
	$action = strtolower($params['action']).'Action';

	if(file_exists("controllers/{$controller}.php"))
	{
		include_once ("controllers/{$controller}.php");
	} 
	else 
	{
		throw new Exception ('Controller is invalid');
	}

	$controller = new $controller($params);
	if($controller)
	{
		echo" conroller";
	}

	if (method_exists($controller, $action) === false)
	{
		throw new Exception ('Action is invalid');
	}

	$result['data'] = $controller->$action();
		//print_r ($result);
	$result['success'] = true;
		//error_reporting(E_ALL);

	} 
catch (Exception $e)
{
	$result['success'] = false;
	$result['errormsg'] = $e->getMessage();
	//echo $result;
}

//echo json_decode($result);
exit();
?>