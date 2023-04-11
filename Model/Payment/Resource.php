<?php

class Model_Payment_Resource extends Model_Core_Table_Resource
{
	function __construct()
	{
		$this->setTableName('payment');
		$this->setPrimaryKey('payment_id');
	}
}
?>