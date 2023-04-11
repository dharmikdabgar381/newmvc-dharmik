<?php
require_once 'Model/Core/Table.php';
class Model_Vendor_Address extends Model_Core_Table
{
	protected $tableName = "vendor_address";
	protected $primaryKey = "address_id";
	protected $resourceClass = "Model_Vendor_Address_Resource";

	public function insert($data = [])
	{
		if(!$data)
		{
			throw new Exception("Data Not Found.", 1);
		}
		$keys = "`".implode("`, `", array_keys($data))."`";
		$values = "'".implode("','", array_values($data))."'"; 
		$query = "INSERT INTO `{$this->tableName}`({$keys}) VALUES ({$values})";
		$adapter = $this->getAdapter();
		$result = $adapter->insert($query);
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