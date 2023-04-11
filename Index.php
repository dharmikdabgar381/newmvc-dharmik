<?php
require_once 'Controller/Core/Front.php';
define("DS", DIRECTORY_SEPARATOR);
session_start();

spl_autoload_register(function($class_name)
{
	$classPath = str_replace('_','/',$class_name);
	require_once "{$classPath}.php";
}
);

class Ccc
{
	public static function init()
	{
		$front = new Controller_Core_Front();
		$front->init();
	}

	public static function getModel($className)
	{
		$className = 'Model_'.$className;
		return (new $className());
	}

	public static function getSingleton($className)
	{
		$className = 'Model_'.$className;

		if (array_key_exists($className, $GLOBALS)) 
		{
			return $GLOBALS[$className];
		}
		$GLOBALS[$className] = (new $className());
		return $GLOBALS[$className];      
	}

	public function register($key, $value)
	{
		$GLOBALS[$key] = $value;
	}

	public function getregistry($key)
	{
		if(array_key_exists($key, $GLOBALS))
		{
			return $GLOBALS[$key];
		}
		return false;
	}
}
Ccc::init();
?>
