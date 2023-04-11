<?php

class Block_Eav_Edit extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setData(Ccc::getModel('Eav_Attribute'));
		$this->setTemplate('eav/edit.phtml');	
	}
}
?>