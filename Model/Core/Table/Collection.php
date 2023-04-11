<?php

class Model_Core_Table_Collection
{
	
	protected $data = [];

	public function setData($data)
	{
		$this->data = array_merge($this->data,$data);
		return $this;
	}

	public function getData()
	{
		return $this->data;
	}

	public function count()
	{
		return count($this->data);
	}

	// public function getFirst($data)
	// {
	// 	return array_key_first(array $data);
	// }

}
?>