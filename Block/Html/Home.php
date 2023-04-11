<?php

class Block_Html_Home extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/home.phtml');	
	}
}
?>