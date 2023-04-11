<?php

class Block_Html_Right extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('Html/right.phtml');	
	}
}
?>