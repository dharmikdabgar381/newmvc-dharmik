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

<<<<<<< HEAD
=======

if (!(Ccc::getModel('Core_Request')->getParams('c')) || !(Ccc::getModel('Core_Request')->getParams('a'))) {
	header('Location:http://localhost/newmvc-dharmik/index.php?c=product&a=grid');
	exit();
}

>>>>>>> 2e47b54a6a80cbafd2379c5b2b85aa25f3e82b20
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
