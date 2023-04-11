<?php

class Block_Customer_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('customer/grid.phtml');	
	}

	public function prepareChild()
	{
		$customerRow = Ccc::getModel('Customer');
		$query = 'SELECT * FROM `customer`';
		$customers = $customerRow->fetchAll($query);
		$this->setData($customers);
		return $this;
	}
}
?>