<?php 

class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Customer_Grid();
		$content = $layout->getChild('content')->addChild('grid', $grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Customer_Edit();
		$content = $layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}


	public function editAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Customer_Edit();
		$customerRow = Ccc::getModel('Customer');
		$customerAddressRow = Ccc::getModel('Customer_Address');
		$request = $this->getRequest();
		$customer_id = $request->getParams('id');

		if(!$customer_id)
		{
			throw new Exception("Invaild Request.", 1);
		}

		if(!($customer = $customerRow->load($customer_id)) || !($customer_address = $customerAddressRow->load($customer_id,'customer_id')))
		{
			throw new Exception("Error Processing Request", 1);
		}

		$content = $layout->getChild('content')->addChild('edit',$edit);
		$edit->setData(['customer'=>$customer, 'customer_address'=>$customer_address]);
		$layout->render();
	}

	public function saveAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$url = Ccc::getModel('Core_Url');
			if(!$this->getRequest()->isPost())
			{
				throw new Exception("Invaild Request1.", 1);
			}

			if(!($customerData = $this->getRequest()->getPost('customer')))
			{
				throw new Exception("Invaild Request2.", 1);
			}

			if(!($customerAddressData = $this->getRequest()->getPost('customer_address')))
			{
				throw new Exception("Invaild Request3.", 1);
			}

			$customerRow = Ccc::getModel('Customer');
			$customerAddressRow = Ccc::getModel('Customer_Address');

			if($customer_id = $this->getRequest()->getParams('id'))
			{
				if(!($customerRow = $customerRow->load($customer_id)) || !($customerAddressRow = $customerAddressRow->load($customer_id,'customer_id')))
				{
					throw new Exception("Invaild Request4.", 1);
				}
			}

			if($customerRow->customer_id)
			{
				$customerRow->updated_at = date('Y-m-d H:i:s');
			}
			else
			{
				$customerRow->created_at = date('Y-m-d H:i:s');
			}

			$customerRow->setData($customerData);
			if(!($insert_id = $customerRow->save()))
			{
				throw new Exception("Invaild Request5.", 1);
			}
			if(!$customerAddressRow->address_id)
			{
				$customerAddressRow->customer_id = $insert_id;
			}

			$customerAddressRow->setData($customerAddressData);
			if(!$customerAddressRow->save())
			{
				throw new Exception("Invaild Request6.", 1);
			}
			$message->addMessage('Data Saved.', Model_Core_Message::SUCCESS);
			$this->redirect($url->getUrl('customer','grid'));
		} 

		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
		
	}

	public function deleteAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$customerModel = Ccc::getModel('Customer');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$customer_id = $request->getParams('id');

			if (!$customer_id) 
			{
				throw new Exception("ID could not get.", 1);
			}

			$customer = $customerModel->load($customer_id)->delete();

			if(!$customer)
			{
				throw new Exception("Data can not deleted.", 1);
			}
			$message->addMessage('Customer Deleted.',$message::SUCCESS);			
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
		$this->redirect($url->getUrl('customer','grid'));
	}
}
?>