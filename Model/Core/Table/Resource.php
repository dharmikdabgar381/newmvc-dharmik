   <?php
require_once 'Model/Core/Adapter.php';
class Model_Core_Table_Resource
{
	public $adapter = null;
	public $tableName = null;
	public $primaryKey = null;

	protected function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if($this->adapter)
		{
			return $this->adapter;
		}
		$adapter = new Model_Core_Adapter();
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function setReferanceKey($referanceKey)
	{
		$this->referanceKey = $referanceKey;
		return $this;
	}

	public function getReferanceKey()
	{
		return $this->referanceKey;
	}

	public function fetchAll($query = null)
	{
		if($query == null)
		{
			$query = "SELECT * FROM `{$this->tableName}` ORDER BY `$this->primaryKey` DESC";
		}
		$adapter = $this->getAdapter();
		$result = $adapter->fetchAll($query);
		return $result;
	}

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

	public function update($data = [], $condition = null)
	{
		if(!$data && !$condition)
		{
			throw new Exception("Data Not Found", 1);
		}
		$args = [];
		foreach ($data as $key => $value) {
			$args[] = "`$key` = '$value'";
		}
		if(is_array($condition))
		{
			$where = [];
			foreach ($condition as $key => $value) 
			{
				$where[] = "`{$key}` = '{$value}'";
			}
			$whereString = implode(" AND ", $where);
		}
		else
		{
			$whereString = "`{$this->primaryKey}` = {$condition}";
		}
		$updatedData = implode(', ',$args);
		$query = "UPDATE `{$this->tableName}` SET {$updatedData} WHERE $whereString";
		$adapter = $this->getAdapter();
		$result = $adapter->update($query);
		return $result;

	}

	public function delete($condition = [])
	{
		if(!$condition)
		{
			throw new Exception("Record can not be deleted.", 1);
			
		}
		if(is_array($condition))
		{
			$where = [];
			foreach ($condition as $key => $value) 
			{
				$where[] = "`{$key}` = '{$value}'";
			}
			$whereString = implode(" AND ", $where);
		}
		else
		{
			$whereString = "`{$this->primaryKey}` = {$condition}";
		}
		$query = "DELETE FROM `{$this->tableName}` WHERE $whereString";
		$adapter = $this->getAdapter();
		$result = $adapter->delete($query);
		return $result;
	}

	public function load($value, $column=null)
	{
		$column=(!$column) ? $this->getPrimaryKey() : $column;

		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}` = {$value}";
		
		$result = $this->getAdapter()->fetchRow($query);
		return $result;
	}
}
?>