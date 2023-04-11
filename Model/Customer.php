<?php
class Model_Customer extends Model_Core_Table
{
	protected $tableName = "customer";
	protected $primaryKey = "customer_id";
	protected $resourceClass = "Model_Customer_Resource";
	// protected $collectionClass = "Model_Payment_Collection";
	
	public function fetchRow($query = null)
	{
		if($query == null)
		{
			$id = $_GET['id'];
			$query = "SELECT * FROM `{$this->tableName}` WHERE $this->primaryKey = $id";
		}
		$adapter = $this->getAdapter();
		$result = $adapter->fetchRow($query);
		return $result;

	}
}
?>