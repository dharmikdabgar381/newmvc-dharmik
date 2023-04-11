<?php

class Controller_Eav_Attribute extends Controller_Core_Action
{
	public function gridAction()
	{
		$attribute = Ccc::getModel('Eav_Attribute');
		$query = 'SELECT * FROM `eav_attribute`';
		$collection = $attribute->fetchAll($query);
		// echo "<pre>";
		// print_r($collection);
		// die();
	}
}
?>