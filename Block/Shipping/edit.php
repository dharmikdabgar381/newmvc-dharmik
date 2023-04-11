<?php

class Block_Shipping_Edit extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setData(Ccc::getModel('Shipping'));
		$this->setTemplate('shipping-method/edit.phtml');	
	}
}
?>