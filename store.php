<?php
class store
{
	public  array $inventory=[];
	public static $instance;

	private function __construct()
	{

	}
	public static function getInstance()
	{
		try {
			if(!self::$instance){
			self::$instance= new store();
			return self::$instance;
		}
		else{
			throw new Exception("another instance is already running");
		}
			
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	}
	public function addProduct(Product $product)
	{
	 $this->inventory[$product->getId()]=$product;
	}
	public function getProduct($id)
	{
		return $this->inventory[$id];
	}
	public  function loadProducts()
	{
		$sql="SELECT * FROM Product";
		$conn=database::$instance;
		$conn->execQuery($sql);
		 foreach ($conn->fetchObject("product") as $key => $product) {
		 	$this->inventory[$product->getId()]=$product;
		 }
		 return $this->inventory;

	}
}
?>