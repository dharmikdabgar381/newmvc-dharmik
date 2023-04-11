<?php

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		
		try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$message = Ccc::getModel('Core_Message');
			$query = "SELECT * FROM `category`";
			$categories = $categoryRow->fetchAll($query);

			if(!$categories)
			{
				throw new Exception("Data Could not fetch.", 1);
			}
			$this->getView()->setTemplate('Category/category-grid.phtml')->setData($categories);
			$this->render();
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
	}
	public function addAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$message = Ccc::getModel('Core_Message');
			$query = "SELECT * FROM `category`";
			$categories = $categoryRow->fetchAll($query);

			if(!$categories)
			{
				throw new Exception("Data Could not fetch.", 1);
			}
			$this->getView()->setTemplate('Category/category-add.phtml')->setData($categories);
			$this->render();
		} 

		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
	}
	public function insertAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('category_Row');
			$message = Ccc::getModel('Core_Message');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$category = $request->getPost('category');

			if (!$category) 
			{
				throw new Exception("Invaild Request", 1);
			}
			
			$categoryRow->setData($category);
			$category_id = $categoryRow->save();
			
			if(!$category_id)
			{
				throw new Exception("Invaild Request.", 1);
			}
			$message->addMessage("Data Inserted.", $message::SUCCESS);
		} 

		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
		$this->redirect($url->getUrl('category','grid'));
	}

	public function editAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$category_id = $request->getParams('id');

			if(!$category_id)
			{
				throw new Exception("ID could not get.", 1);	
			}

			$query = "SELECT * FROM `category` WHERE `category_id` = {$category_id}";
			$category = $categoryRow->fetchRow($query); 
			
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
		$this->getView()->setTemplate('Category/category-edit.phtml')->setData($category);
		$this->render();
		
	}
	public function updateAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$url = Ccc::getModel('Core_Url');
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$category = $request->getPost('category');
			$category_id = $category['category_id'];

			if (!isset($category)) 
			{
				throw new Exception("Invaild Request.", 1);
			}

			$dateTime = date("Y-m-d H:i:s");
			$categoryRow->setData($category);
			$category = $categoryRow->save();

			if(!$category)
			{
				throw new Exception("Invaild Request.", 1);
			}
			$message->addMessage("Data Updated.", $message::SUCCESS);			
		} 

		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);	
		}
		$this->redirect($url->getUrl('category','grid'));
	}
	public function deleteAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$url = Ccc::getModel('Core_Url');
			$message = Ccc::getModel('Core_Message');
			$request = $this->getRequest();
			$category_id = $request->getParams('id');

			if (!$category_id) 
			{
				throw new Exception("ID could not get.", 1);
			}

			$category = $categoryRow->load($category_id)->delete();

			if(!$category)
			{
				throw new Exception("Data can not deleted.", 1);
			}
			$message->addMessage("Data deleted.", $message::SUCCESS);
		} 
		
		catch (Exception $e) 
		{
			$message->addMessage($e->getMessage(), $message::FAILURE);
		}
		$this->redirect($url->getUrl('category','grid'));
	}
}
?>