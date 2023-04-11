<?php

class Controller_Attribute extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Eav_Grid');
		
		$content = $layout->getChild('content')->addChild('grid', $grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Eav_Edit');
		$content = $layout->getChild('content')->addChild('edit', $edit);
		$layout->render();
	}

	public function saveAction()
	{
		
	}
}
?>