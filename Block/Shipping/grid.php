<?php

class Block_Shipping_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('shipping-method/grid.phtml');	
	}

	public function prepareChild()
	{
		$shippingRow = Ccc::getModel('Shipping');
		$query = 'SELECT * FROM `shipping`';
		$shippingMethods = $shippingRow->fetchAll($query);
		$this->setData($shippingMethods);
		return $this;
	}
}
?>