<?php
require_once 'Core/Table.php';
class Model_Category extends Model_Core_Table
{
	function __construct()
	{
		$this->setTableName('category');
		$this->setPrimaryKey('category_id');
	}

	public function insert($data = [])
	{
		if(!$data)
		{
			throw new Exception("Data Not Found.", 1);
		}
		$keys = "`".implode("`, `", array_keys($data))."`";
		$values = "'".implode("','", array_values($data))."'";
		$dateTime = date("Y-m-d H:i:s");
		$query = "INSERT INTO `{$this->tableName}`({$keys}) VALUES ({$values})"; 
		$adapter = $this->getAdapter();
		$result = $adapter->insert($query);
		
		return $result;
	}
}
?>