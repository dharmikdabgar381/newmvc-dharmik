<?php

class Controller_Core_Action
{

	protected $adapter = null;
	protected $request = null;
	protected $message = null;
	protected $layout = null;
	protected $Row = null;
	protected $view = null;

	protected function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if($this->layout)
		{
			return $this->layout;
		}
		$layout = new Block_Core_Layout();
		$this->setLayout($layout);
		return $layout;
	}
	
	public function getView()
	{
		if($this->view)
		{
			return $this->view;
		}
		$view = Ccc::getModel('Core_View');
		$this->setView($view);
		return $view;
	}

	protected function setView(Model_Core_View $view)
	{
		$this->view = $view;
		return $this;
	}

	public function getMessageObject()
	{
		if($this->message)
		{
			return $this->message;
		}
		$message = Ccc::getModel('Core_Message');
		$this->setMessageObject($message);
		return $message;
	}

	public function setMessageObject(Model_Core_Message $message)	
	{
		$this->message = $message;
		return $this;
	}

	public function render()
	{
		return $this->getView()->render();
	}
	protected function redirect($url)
	{
		header("location:$url");
		exit();
	}

	public function setMessage(Model_Core_Message $message)
	{
		$this->message = $message;
		return $this;
	}

	public function getMessage()
	{
		if($this->message)
		{
			return $this->message;
		}
		$message = new Model_Core_Message();
		$this->setMessage($message);
		return $message;
	}

	protected function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{ 
		if($this->request)
		{
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}

	protected function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if($this->adapter)
		{
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function getTemplate($templatePath)
	{
		require_once 'View'.DS.$templatePath;
	}
}
?>