<?php

class Model_Customer_Resource extends Model_Core_Table_Resource
{
	function __construct()
	{
		$this->setTableName('customer');
		$this->setPrimaryKey('customer_id');
	}
}
?>