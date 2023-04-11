<?php

class Controller_Payment extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Payment_Grid();
		$content = $layout->getChild('content')->addChild('grid', $grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Payment_Edit();
		$content = $layout->getChild('content')->addChild('edit', $edit);
		$layout->render();
	}
	
	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
			$paymentRow = Ccc::getModel('Payment');
			$request = $this->getRequest();
			$payment_id = $request->getParams('id');
		

			if(!$payment_id)
			{
				throw new Exception("ID could not get.", 1);
			}

			if(!$data = $paymentRow->load($payment_id))
			{
				throw new Exception("Invaild Request.", 1);
			}

			$edit = new Block_Payment_Edit();
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
			throw new Exception("Error Processing Request", 1);
		}
		$id = $request->getParams('id');
		$paymentRow = Ccc::getModel('Payment');
		$data = $request->getPost('payment');
		$paymentRow->setData($data);
		if($id)
		{
			$idLoad = $paymentRow->load($id);
			print_r($idLoad);
			$paymentRow->payment_id = $idLoad->payment_id;
			$paymentRow->updated_at = date("Y-m-d H:i:s");
		}

		
		$paymentRow->created_at = date("Y-m-d H:i:s");
		$paymentRow->setData($data);

		if(!$paymentRow->save())
		{
			throw new Exception("Invaild Request.", 1);
		}
		$message = Ccc::getModel('Core_Message');
		$message->addMessage("Data Saved.", $message::SUCCESS);
		$this->redirect('index.php?c=payment&a=grid', null, [] ,true);
	}
	
	public function deleteAction()
	{
		try 
		{
			$paymentRow = Ccc::getModel('Payment');
			$url = Ccc::getModel('Core_Url');
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$payment_id = $request->getParams('id');
			
			if (!$payment_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			
			$payment = $paymentRow->load($payment_id)->delete();
			
			if(!$payment)
			{
				throw new Exception("Data can not deleted.", 1);
			}
			$message->addMessage('Data deleted.', $message::SUCCESS);
		}

		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
		$this->redirect($url->getUrl('payment','grid'));
	}
}
?>