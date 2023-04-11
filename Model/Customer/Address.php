<?php
require_once 'Model/Core/Table.php';
class Model_Customer_Address extends Model_Core_Table
{
	protected $tableName = "customer_address";
	protected $primaryKey = "address_id";
	protected $resourceClass = "Model_Customer_Address_resource";

	public function insert($data = [])
	{
		if (!$data) 
		{
			throw new Exception("unable to find data", 1);
		}
		$keys = "`".implode("`, `", array_keys($data))."`";
		$values = "'".implode("','", array_values($data))."'";
		$query = "INSERT INTO `{$this->getTableName()}`({$keys}) VALUES ({$values})";
		
		$result = $this->getAdapter()->insert($query);

		if (!$result) 
		{
			throw new Exception('result not found', 1);
			
		}
		return $result;
	}

	public function fetchRow($query = null)
	{
		if($query == null)
		{
			$id = $_GET['id'];
			$query = "SELECT * FROM `{$this->tableName}` WHERE $this->referanceKey = $id";
		}
		$adapter = $this->getAdapter();
		$result = $adapter->fetchRow($query);
		return $result;

	}
}
?>