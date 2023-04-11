<?php

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = new Block_Vendor_Grid();
		$content = $layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Vendor_Edit();
		$content = $layout->getChild('content')->addChild('edit',$edit);
		$layout->render();
	}

	public function editAction()
	{
		$layout = $this->getLayout();
		$edit = new Block_Vendor_Edit();
		$vendorRow = Ccc::getModel('Vendor');
		$vendorAddressRow = Ccc::getModel('Vendor_Address');
		$request = $this->getRequest();
		$vendor_id = $request->getParams('id');

		if(!$vendor_id)
		{
			throw new Exception("Invaild Request.", 1);
		}

		if(!($vendor = $vendorRow->load($vendor_id)) || !($vendor_address = $vendorAddressRow->load($vendor_id,'vendor_id')))
		{
			throw new Exception("Invaild Request.", 1);
		}

		$content = $layout->getChild('content')->addChild('edit',$edit);
		$edit->setData(['vendor'=>$vendor, 'vendor_address'=>$vendor_address]);
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
				throw new Exception("Invaild Request 1.", 1);
			}

			if(!($vendorData = $this->getRequest()->getPost('vendor')))
			{
				throw new Exception("Invaild Request 2.", 1);
			}

			if(!($vendorAddressData = $this->getRequest()->getPost('vendor_address')))
			{
				throw new Exception("Invaild Request 3.", 1);
			}

			$vendorRow = Ccc::getModel('Vendor');
			$vendorAddressRow = Ccc::getModel('Vendor_Address');

			if($vendor_id = $this->getRequest()->getParams('id'))
			{
				if(!($vendorRow = $vendorRow->load($vendor_id)) || !($vendorAddressRow = $vendorAddressRow->load($vendor_id,'vendor_id')))
				{
					throw new Exception("Invaild Request 4.", 1);
				}
			}

			if($vendorRow->vendor_id)
			{
				$vendorRow->updated_at = date("Y-m-d H:i:s");
			}
			else
			{
				$vendorRow->created_at = date('Y-m-d H:i:s');
			}
			$vendorRow->setData($vendorData);
			if(!($insert_id = $vendorRow->save()))
			{
				throw new Exception("Invaild Request 5.", 1);
			}

			if(!$vendorAddressRow->address_id)
			{
				$vendorAddressRow->vendor_id = $insert_id;
			}

			$vendorAddressRow->setData($vendorAddressData);
			if(!$vendorAddressRow->save())
			{
				throw new Exception("Invaild Request 6.", 1);
			}

			$message->addMessage('Data Saved.',$message::SUCCESS);
			$this->redirect($url->getUrl('vendor','grid'));
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(),$message::FAILURE);
		}
	}
	
	
	public function deleteAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$vendorRow = Ccc::getModel('Vendor');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$vendor_id = $request->getParams('id');
			if (!$vendor_id) 
			{
				throw new Exception("Invaild Request", 1);
			}

			$vendor = $vendorRow->load($vendor_id)->delete();
			if(!$vendor_id)
			{
				throw new Exception("Invaild Request", 1);
			}
			$message->addMessage('Vendor Deleted.', $message::SUCCESS);
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
		$this->redirect($url->getUrl('vendor','grid'));
	}
}
?>
