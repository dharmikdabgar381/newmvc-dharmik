<?php

class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Product_Grid();
		$content = $layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Product_Edit();
		$content = $layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
			$productRow = Ccc::getModel('Product');
			$request = $this->getRequest();
			$product_id = $request->getParams('id');

			if(!$product_id)
			{
				throw new Exception("Invaild Request.", 1);
			}

			if(!$data = $productRow->load($product_id))
			{
				throw new Exception("Invaild Request.", 1);
			}

			$edit = new Block_Product_Edit();
			$edit->setData($data);
			$content = $layout->getChild('content')->addChild('edit',$edit);
			$layout->render();	
		} 
		catch (Exception $e) 
		{
			$message = Ccc::getModel('Core_Message');
			$message->addMessage($e->getMessage(), $message::FAILURE);
			$this->redirect('index.php?c=product&a=grid');	
		}
	}

	public function saveAction()
	{
		$request = $this->getRequest();
		if(!$request->getPost())
		{
			throw new Exception("Error Processing Request", 1);
		}
		$id = $request->getParams('id');
		$productRow = Ccc::getModel('Product');
		$data = $request->getPost('product');
		$productRow->setData($data);
		if($id)
		{
			$idload = $productRow->load($id);
			$productRow->product_id = $idload->product_id;
			$productRow->updated_at = date("Y-m-d H:i:s");
		}

		$productRow->created_at = date("Y-m-d H:i:s");
		$productRow->setData($data);

		if(!$productRow->save())
		{
			throw new Exception("Invaild Request.", 1);
		}
		$message = Ccc::getModel('Core_Message');
		$message->addMessage('Data Saved.', $message::SUCCESS);
		$this->redirect('index.php?c=product&a=grid',null,[],true);
	}
	public function deleteAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$url = Ccc::getModel('Core_Url');
			$productRow = Ccc::getModel('Product');
			$request = $this->getRequest();
			$product_id = $request->getParams('id');
			
			if (!$product_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			
			$product = $productRow->load($product_id)->delete();
			
			if (!$product) 
			{
				throw new Exception("Product Could not Deleted.", 1);
			}
			
			$message->addMessage('Product Deleted.', $message::SUCCESS);	
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);	
		}
		$this->redirect($url->getUrl('product','grid'));

	}
}
?>