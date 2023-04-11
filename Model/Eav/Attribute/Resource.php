<?php

class Model_Eav_Attribute_Resource extends Model_Core_Table_Resource
{
	function __construct()
	{
		$this->setTableName('eav_attribute');
		$this->setPrimaryKey('attribute_id');
	}
}

?>