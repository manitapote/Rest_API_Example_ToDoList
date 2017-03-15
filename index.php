<?php

ini_set('display_errors',1);
error_reporting(-1);
//echo "server index";

define('DATA_PATH', realpath(dirname(__FILE__).'/data'));

$applications = array(
 	'APP001' => '1234');
include_once ('models/TodoItem.php');
try
 {
	//print_r("test\n");
 	$params = $_REQUEST;
 	//cho "From todoitem</br></br>";
 	//print_r($params);
 	$app_id = $params['app_id'];
	if(isset($applications[$app_id]))
	{
		throw new Exception('Application doesnot exist');
	}

	if($params['action'] == NULL && $params['controller'] == NULL)
	{
		throw new Exception('Request is not valid');
	}

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
	if (method_exists($controller, $action) === false)
	{
		throw new Exception ('Action is invalid');
	}
	$result['data'] = $controller->$action();
	$result['success'] = true;
	$result = json_encode($result);
	print_r($result);
	//return($result); 
} 
 catch (Exception $e)
{
 	$result['success'] = false;
 	$result['errormsg'] = $e->getMessage();
 	echo $result['success']; 
}
//print_r($result);
exit();
?>