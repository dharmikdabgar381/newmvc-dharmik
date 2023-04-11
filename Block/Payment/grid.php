<?php

class Block_Payment_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('payment/grid.phtml');	
	}

	public function prepareChild()
	{
		$paymentRow = Ccc::getModel('Payment');
		$query = 'SELECT * FROM `payment`';
		$paymentMethods = $paymentRow->fetchAll($query);
		$this->setData($paymentMethods);
		return $this;
	}
}
?>