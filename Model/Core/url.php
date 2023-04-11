<?php
require_once 'Request.php';
class Model_Core_Url 
{
	public function getCurrentUrl()
	{
		$path = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return $path;
	}

	public function getUrl($c = null, $a = null, $params = [], $reset = false)
	{
		$request = new Model_Core_Request();
		$final = $request->getParams();

		$require = [];

		if($reset)
		{
			$final = [];
		}

		if($c == null)
		{
			$require['c'] = $request->getControllerName();
		}
		else
		{
			$require['c'] = $c;
		}

		if($a == null)
		{
			$require['a'] = $request->getActionName();
		}
		else
		{
			$require['a'] = $a;
		}

		$final = array_merge($final, $require);
		if($params)
		{
			$final = array_merge($final, $params);
		}
		$path = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].trim($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']).http_build_query($final);
		return $path;
	}

}

?>