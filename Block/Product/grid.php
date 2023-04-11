<?php

class Block_Product_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('product/grid.phtml');	
	}

	public function prepareChild()
	{
		$productRow = Ccc::getModel('Product');
		$query = 'SELECT * FROM `product`';
		$products = $productRow->fetchAll($query);
		$this->setData($products);
		return $this;
	}
}
?>