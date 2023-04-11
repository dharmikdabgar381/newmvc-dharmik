<?php

class Model_Payment extends Model_Core_Table
{
	protected $tableName = "payment";
	protected $primaryKey = "payment_id";
	protected $resourceClass = "Model_Payment_Resource";
	// protected $collectionClass = "Model_Payment_Collection";
}
?>