<?php

class Model_Product_Resource extends Model_Core_Table_Resource
{
	function __construct()
	{
		$this->setTableName('product');
		$this->setPrimaryKey('product_id');
	}
}
?>