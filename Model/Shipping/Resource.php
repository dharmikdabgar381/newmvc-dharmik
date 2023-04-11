<?php

class Model_Shipping_Resource extends Model_Core_Table_Resource
{
	function __construct()
	{
		$this->setTableName('shipping');
		$this->setPrimaryKey('shipping_id');
	}
}
?>