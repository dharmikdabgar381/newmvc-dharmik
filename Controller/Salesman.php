<?php

class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$message = Ccc::getModel('Core_Message');
			$query = "SELECT * FROM `salesman`";
			$salesmen = $salesmanRow->fetchAll($query);

			if(!$salesmen)
			{
				throw new Exception("Salesman could not fetch.", 1);
			}
			$this->getView()->setTemplate('salesman/salesman-grid.phtml')->setData($salesmen);
			$this->render();
		} 


		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);			
		}
	}

	public function addAction()
	{
		$this->getView()->setTemplate('salesman/salesman-add.phtml');
			$this->render();

	}

	public function insertAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$url = Ccc::getModel('Core_Url');
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$request = $this->getRequest();
			$salesman = $request->getPost('salesman');
			
			if (!$salesman) 
			{
				throw new Exception("Invaild Request", 1);
			}

			$salesmanRow->setData($salesman);
			$salesmanRow->created_at = date("Y-m-d H:i:s");
			$salesman = $salesmanRow->save();
			
			if(!$salesman)
			{
				throw new Exception("data could not inserted.", 1);
			}
			
			$salesmanAddressRow = Ccc::getModel('Salesman_Address_Row');
			$salesman_address = $request->getPost('salesman_address');
			$salesman_address['salesman_id'] = $salesman;
			$salesmanAddressRow->setData($salesman_address);
			$Address = $salesmanAddressRow->save();
			
			if(!$Address)
			{
				throw new Exception("Address could not inserted.", 1);
			}
			$message->addMessage('Salesman Added.',Model_Core_Message::SUCCESS);			
		} 
		catch (Exception $e) 
		{
			$message->addMessage('Customer Added failed.',Model_Core_Message::FAILURE);
		}
		$this->redirect($url->getUrl('salesman','grid'));
	}

	public function editAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$request = $this->getRequest();
			$salesman_id = $request->getParams('id');
			$query = "SELECT * FROM `salesman` WHERE `salesman_id` = {$salesman_id}";
			$salesmen = $salesmanRow->fetchRow($query);
			
			if(!$salesmen)
			{
				throw new Exception("Invaild Request.", 1);
			}

			$salesmanAddressRow = Ccc::getModel('Salesman_Address_Row');
			$query = "SELECT * FROM `salesman_address` WHERE `salesman_id` = {$salesman_id}";
			$salesmenAddress = $salesmanAddressRow->fetchRow($query);
			$this->getView()->setTemplate('salesman/salesman-edit.phtml')->setData(['salesman' => $salesmen, 'salesman_address'=>$salesmenAddress]);
			$this->render();
		} 

		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
	}
	
	public function updateAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$salesman = $request->getPost('salesman');
			$salesman['updated_at'] = date("Y-m-d H:i:s");
			$id = $salesman['salesman_id'];

			if (!$id) 
			{
				throw new Exception("Invaild Request", 1);
			}

			$salesmanRow->setData($salesman);
			$salesman = $salesmanRow->save();

			if (!$salesman)
			{
				throw new Exception("Invaild Request", 1);
			}

			$salesmanAddressRow = Ccc::getModel('Salesman_Address_Row');
			$address = $request->getPost('salesman_address');
			$salesmanAddressRow->setData($address);
			$result = $salesmanAddressRow->save();

			if (!$result) 
			{
				throw new Exception("Invaild Request.", 1);
			}
			$message->addMessage('Salesman Updated.',$message::SUCCESS);			
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);			
		}
		
		$this->redirect($url->getUrl('salesman','grid'));
	}

	public function deleteAction()
	{
		try 
		{
			$message = Ccc::getModel('Core_Message');
			$salesmanModel = Ccc::getModel('Salesman_Row');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$salesman_id = $request->getParams('id');
			
			if (!$salesman_id) 
			{
				throw new Exception("Invaild Request", 1);
			}
			
			$salesman = $salesmanModel->load($salesman_id)->delete();
			
			if(!$salesman)
			{
				throw new Exception("Invaild Request", 1);
			}
			$message->addMessage('Salesman Deleted.',Model_Core_Message::SUCCESS);			
		} 
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::SUCCESS);			
		}
		$this->redirect($url->getUrl('salesman','grid'));

	}
	public function salesmanGridAction()
	{
		$adapter = $this->adapter();
		$query = "SELECT * FROM `salesman`";
		$salesmen = $adapter->fetchAll($query);
		$query = "SELECT P.`product_id`,P.`product_name`,P.`sku`,P.`cost`,P.`price`,SP.`entity_id`,SP.`salesman_price`,S.`salesman_id`,S.`first_name` FROM `product` P 
		LEFT JOIN `salesman_price` SP ON P.product_id = SP.product_id
		LEFT JOIN `salesman` S ON SP.salesman_id = S.salesman_id GROUP BY P.product_id";
		$products = $adapter->fetchAll($query);
		require_once 'View/salesman-price/salesman-price-grid.phtml';
	}
	public function salesmanPriceUpdateAction()
	{
		$adapter = $this->adapter();
		$request = $this->getRequest();
		$price = $request->getPost('price');
		$salesman_id = $request->getParams('salesman_id');
		$remove = $request->getPost('remove');
		if($request->getPost('delete'))
		{
			foreach($remove as $key=>$value)
			{
				$query = "DELETE FROM `salesman_price` WHERE `salesman_id`='{$salesman_id}' AND `product_id`='{$value}'";
				$resulte = $adapter->delete($query); 
			}
		}
		else
		{
		foreach($price as $key=>$value)
		{
			$query = "SELECT `entity_id` FROM `salesman_price` WHERE `product_id`='{$key}' AND `salesman_id`='{$salesman_id}'";
			$result = $adapter->fetchAll($query);
			if($result)
			{
				$updateQuery = "UPDATE `salesman_price` SET `salesman_price`='{$value}' WHERE `product_id`='{$key}' AND `salesman_id`='{$salesman_id}'";
				$result = $adapter->update($updateQuery);
			}
			else
			{
				if($value != '')
				{
					$insertQuery = "INSERT INTO `salesman_price`(`salesman_id`, `product_id`, `salesman_price`) VALUES ('{$salesman_id}','{$key}','{$value}')";
					$result = $adapter->insert($insertQuery); 
				}
			}

		}
	}
	$this->redirect("salesman.php?a=salesmanGrid&salesman_id=$salesman_id");
	}
}
?>