<?php

class Block_Html_Left extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/left.phtml');	
	}
}
?>