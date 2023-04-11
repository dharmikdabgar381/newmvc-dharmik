<?php

class Block_Core_Layout extends Block_Core_Templete
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/layout/1column.phtml');
		$this->prepareChildren();	
	}

	public function prepareChildren()
	{
		$head = new Block_Html_Head();
		$this->addChild('head', $head);

		$header = new Block_Html_Home();
		$this->addChild('header', $header);
		
		$content = new Block_Html_Content();
		$this->addChild('content', $content);


		$message = new Block_Html_Message();
		$this->addChild('message', $message);

		$right = new Block_Html_Right();
		$this->addChild('right', $right);

		$left = new Block_Html_Left();
		$this->addChild('left', $left);

		$footer = new Block_Html_Footer();
		$this->addChild('footer', $footer);
	}

	public function createBlock($blockName)
	{
		$blockName = 'Block_'.$blockName;
		$block = (new $blockName());
		$block->setLayout($this);
		return $block;
	}
}
?>