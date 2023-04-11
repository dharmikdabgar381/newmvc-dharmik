<?php

class Block_Customer_Edit extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('customer/edit.phtml');	
	}

	public function prepareChild()
	{
		$customerRow = Ccc::getModel('Customer');
		$customerAddressRow = Ccc::getModel('Customer_Address');
		$this->setData(['customer'=>$customerRow, 'customer_address'=>$customerAddressRow]);
	}
}
?>