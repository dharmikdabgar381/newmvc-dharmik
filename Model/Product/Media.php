<?php
require_once 'Model/Core/Table.php';
class Model_Product_Media extends Model_Core_Table
{
	function __construct()
	{
		$this->setTableName('media');
		$this->setPrimaryKey('product_id');
	}

}
?>