<?php

class Block_Payment_Edit extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setData(Ccc::getModel('Payment'));
		$this->setTemplate('payment/edit.phtml');	
	}
}
?>