<?php

class Controller_Shipping extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Shipping_Grid();
		$content = $layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Shipping_Edit();
		$content = $layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
			$shippingRow = Ccc::getModel('Shipping');
			$request = $this->getRequest();
			$shipping_id = $request->getParams('id');
			
			if(!$shipping_id)
			{
				throw new Exception("ID could not get.", 1);
			}
			
			if(!$data = $shippingRow->load($shipping_id))
			{
				throw new Exception("Invaild Request.", 1);
			}

			$edit = new Block_Shipping_Edit();
			$edit->setData($data);
			$content = $layout->getChild('content')->addChild('edit',$edit);
			$layout->render();
		} 

		catch (Exception $e) 
		{
			$message = Ccc::getModel('Core_Message');
			$message->addMessage($e->getMessage(), $message::FAILURE);	
			$this->redirect('index.php?c=payment&a=grid');		
		}
	}

	public function saveAction()
	{
		$request = $this->getRequest();
		if(!$request->getPost())
		{
			throw new Exception("Invaild Request.", 1);
		}
		$id = $request->getParams('id');
		$shippingRow = Ccc::getModel('Shipping');
		$data = $request->getPost('shipping');
		$shippingRow->setData($data);
		if($id)
		{
			$idLoad = $shippingRow->load($id);
			$shippingRow->shipping_id = $idLoad->shipping_id;
			$shippingRow->updated_at = date("Y-m-d H:i:s");
		}

		$shippingRow->created_at = date("Y-m-d H:i:s");
		$shippingRow->setData($data);
		if(!$shippingRow->save())
		{
			throw new Exception("Invaild Request.", 1);
		}

		$message = Ccc::getModel('Core_Message');
		$message->addMessage("Data Saved.", $message::SUCCESS);
		$this->redirect('index.php?c=shipping&a=grid',null,[],true);
	}

	public function deleteAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$shippingRow = Ccc::getModel('Shipping');
			$url = Ccc::getModel('Core_Url');
 			$request = $this->getRequest();
			$shipping_id = $request->getParams('id');

			if (!$shipping_id) 
			{
				throw new Exception("Invaild Request", 1);
			}

			$shipping = $shippingRow->load($shipping_id)->delete();

			if (!$shipping) 
			{
				throw new Exception("Invaild Request", 1);
			}
			$message->addMessage('Shipping Method Deleted.',$message::SUCCESS);
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage() ,$message::FAILURE);
		}
		$this->redirect("index.php?c=shipping&a=grid");
	}
}
?>