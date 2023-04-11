<?php
// require_once 'Core/Table.php';
// class Model_Product extends Model_Core_Table
// {
// 	function __construct()
// 	{
// 		$this->setTableName('product');
// 		$this->setPrimaryKey('product_id');
// 	}
// }



class Model_Product extends Model_Core_Table
{
	protected $tableName = "product";
	protected $primaryKey = "product_id";
	protected $resourceClass = "Model_Product_Resource";
	// protected $collectionClass = "Model_Payment_Collection";
}

?>