<?php

class Model_Core_Table
{
	protected $data = [];
	protected $resourceObject = null;
	protected $resourceClass = null;
	protected $collectionObject = null;
	protected $collectionClass = "Model_Core_Table_Collection";

	public function setData($data)
	{
		$this->data = array_merge($this->data,$data);
		return $this;
	}

	public function getData($key = null)
	{
		if($key == null)
		{
			return $this->data;
		}

		if(array_key_exists($key, $this->data))
		{
			return $this->data[$key];
		}

		return null;
	}

	public function __get($key)
	{
		if(array_key_exists($key, $this->data))
		{
			return $this->data[$key];
		}
		return null;
	}

	public function __set($key, $value)		
	{
		$this->data[$key] = $value;
	}

	public function __unset($key)
	{
		if(array_key_exists($key, $this->data))
		{
			unset($this->data[$key]);
		}
		return $this;
	}

	public function getTableName()
	{
		if($this->tableName)
		{
			return $this->tableName;
		}

		$this->getResourceObject()->getTableName();
		return $tableName;
	}

	public function getPrimaryKey()
	{
		if($this->primaryKey)
		{
			return $this->primaryKey;
		}

		$this->getResourceObject()->getPrimaryKey();
		return $primaryKey;
	}

	public function getResourceObject()
	{
		if($this->resourceObject)
		{
			return $this->resourceObject;
		}

		$resourceObject = new ($this->resourceClass)();

		$this->setResourceObject($resourceObject);
		return $resourceObject;
	}

	protected function setResourceObject($resourceObject)
	{
		$this->resourceObject = $resourceObject;
		return $this;
	}

	protected function setResourceClass($resourceClass)
	{
		$this->resourceClass = $resourceClass;
		return $this;
	}

	protected function setcollectionClass($collectionClass)
	{
		$this->collectionClass = $collectionClass;
		return $this;
	}

	public function getcollectionObject()
	{
		if($this->collectionObject)
		{
			return $this->collectionObject;
		}

		$collectionObject = new ($this->collectionClass)();
		$this->setcollectionObject($collectionObject);
		return $collectionObject;
	}

	protected function setcollectionObject($collectionObject)
	{
		$this->collectionObject = $collectionObject;
		return $this;
	}

	public function fetchAll($query)
	{
		$result = $this->getResourceObject()->fetchAll($query);
		if(!$result)
		{
			return false;
		}
		
		$rows = [];
		foreach($result as $row)
		{
			$rows[] = (new $this)->setData($row)->setResourceObject($this->getResourceObject())->setcollectionObject($this->getcollectionObject());
		}
		$collection = $this->getcollectionObject()->setData($rows);
		return $collection;
	}

	public function fetchRow($query)
	{
		$result = $this->getResourceObject()->fetchRow($query);
		if(!$result)
		{
			return false;
		}

		$this->data = $result;
		return $this;
	}

	public function load($id, $column = null)
	{
		$column = (!$column) ? $this->getPrimaryKey() : $column;
		$query = "SELECT * FROM {$this->getTableName()} WHERE `{$column}` = {$id}";
		$resource = $this->getResourceObject();
		$row = $resource->fetchRow($query);
		if($row)
		{
			$this->data = $row;
		}

		return $this;
	}

	public function save()
	{
		if(!array_key_exists($this->getPrimaryKey(), $this->data))
		{
			$insert = $this->getResourceObject()->insert($this->data);
			if($insert)
			{
				return $insert;
			}

			return null;
		}

		else
		{
			$id = $this->data[$this->getPrimaryKey()];
			if(!$id)
			{
				return false;
			}

			$update = $this->getResourceObject()->update($this->data, $id);
			if($update)
			{
				$this->load($id);
				return $this;
			}

			return null;
		}
	}

	public function delete()
	{
		$id = $this->data[$this->getPrimaryKey()];
		if(!$id)
		{
			return false;
		}

		$delete = $this->getResourceObject()->delete($id);
		return $delete;
	}
}
?>
