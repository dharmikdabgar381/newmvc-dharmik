<?php

class Block_Eav_Grid extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('eav/grid.phtml');	
	}

	public function prepareChild()
	{
		$attribute = Ccc::getModel('Eav_Attribute');
		$query = 'SELECT * FROM `eav_attribute`';
		$eavAttribute = $attribute->fetchAll($query);
		return $eavAttribute;
	}
}
?>