 <?php
require_once 'Model/Core/Request.php';
class Controller_Core_Front
{
	public function init()
	{
		$request = new Model_Core_Request();
		$controllerName = $request->getControllerName();
		$controllerName = 'Controller_'.ucwords($controllerName,'_');
		$controllerPath = str_replace('_','/',$controllerName).'.php';
		
		require_once ($controllerPath);
		$controller = new $controllerName();
		$action = $request->getActionName();
		$action = $action.'Action';
		$controller->$action();
	}
}
?>
