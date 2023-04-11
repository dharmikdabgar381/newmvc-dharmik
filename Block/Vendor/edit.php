<?php

class Block_Vendor_Edit extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('vendor/edit.phtml');	
	}

	public function prepareChild()
	{
		$vendorRow = Ccc::getModel('Vendor');
		$vendorAddressRow = Ccc::getModel('Vendor_Address');
		$this->setData(['vendor'=>$vendorRow, 'vendor_address'=>$vendorAddressRow]);
	}
}
?>