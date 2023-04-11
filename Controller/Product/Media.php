<?php
require_once 'Model/Core/Adapter.php';
require_once 'Model/Core/Request.php';
require_once 'Controller/Core/Action.php';
require_once 'Model/Product/Media.php';

class Controller_Product_Media extends Controller_Core_Action
{
	protected $productMedia = [];
	public function setProductMedia($productMedia)
	{
		$this->productMedia = $productMedia;
		return $this;
	}

	public function getProductMedia()
	{
		return $this->productMedia;
	}
	
	public function gridAction()
	{
		$productMediaModel = new Model_Product_Media();
		$request = $this->getRequest();
		$product_id = $request->getParams('id');
		$query = "SELECT * FROM `media` WHERE `product_id` = {$product_id}";
		$images = $productMediaModel->fetchAll($query);
		$this->setProductMedia($images);

		require_once 'View/product-media/product-image-grid.phtml';
	}
	public function addAction()
	{
		$this->getTemplate('product-media/product-image-add.phtml');
	}
	public function insertAction()
	{
		$request = $this->getRequest();
		if(!$request->isPost())
		{
			throw new Exception("Invaild Request.", 1);
		}
		$data = $request->getPost('media');
		$data['created_at'] = date("Y-m-d H:i:s");
		$productMediaModel = new Model_Product_Media();
		$mediaId = $productMediaModel->insert($data);
		if(!$mediaId)
		{
			throw new Exception("Invaild Request.", 1);
		}
		//upload image
		echo "<pre>";
		$files = $_FILES['media']['name']['uploadImage'];
		// print_r($files);die();
		$stringArray = explode('.', $files);
		$extension =  $stringArray[1];
		$fileName = $mediaId.'.'.$extension;
		$dest = 'media/'.$fileName;
		$tmp_name = $_FILES['media']['tmp_name']['uploadImage'];
		$upload = move_uploaded_file($tmp_name, $dest);
		$data['uploadImage'] = $fileName;
		$condition['product_id'] = $data['product_id'];
		$condition['media_id'] = $mediaId;
		$productMediaModel->update($data,$condition);
		$this->redirect("index.php?c=product_media&a=grid&id={$data['product_id']}");
	}
	public function updateAction()
	{
		// $adapter = $this->adapter();
		$request = $this->getRequest();
		$thumbnailId = $request->getPost('thumbnail');
		$smallId = $request->getPost('small');
		$baseId = $request->getPost('base');
		$gallery = $request->getPost('gallery');
		$product_id = $request->getPost('product_id');

		$adapter = new Model_Core_Adapter();
		$query = "UPDATE `media` SET `thumbnail`=0,`small`=0,`base`=0,`gallery`=0";
		$update = $adapter->update($query);

		$query = "UPDATE `media` SET `thumbnail`= 1 WHERE `media_id`='{$thumbnailId}'";
		$update = $adapter->update($query);

		$query = "UPDATE `media` SET `small`= 1 WHERE `media_id`='{$smallId}'";
		$update = $adapter->update($query);

		$query = "UPDATE `media` SET `base`= 1 WHERE `media_id`='{$baseId}'";
		$update = $adapter->update($query);

		foreach ($gallery as $key => $value) 
		{
			$query = "UPDATE `media` SET `gallery`= 1 WHERE `media_id`='{$value}'";
			$update = $adapter->update($query);
		}
		if (!$query) 
		{
			throw new Exception("Invaild Request", 1);
			
		}
		$this->redirect("index.php?c=product_media&a=grid&product_id={$product_id}");
	}
}
?>