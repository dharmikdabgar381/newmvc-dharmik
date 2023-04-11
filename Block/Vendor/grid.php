<?php

class Block_Vendor_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('vendor/grid.phtml');	
	}

	public function prepareChild()
	{
		$vendorRow = Ccc::getModel('Vendor');
		$query = 'SELECT * FROM `vendor`';
		$vendors = $vendorRow->fetchAll($query);
		$this->setData($vendors);
		return $this;
	}
}
?>