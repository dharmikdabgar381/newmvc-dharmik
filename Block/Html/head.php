<?php

class Block_Html_Head extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/head.phtml');	
	}
}
?>