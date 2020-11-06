<?php

class cart
{
	public array $items=[];
	/**
	*@param Product $product
	*@param int $quantity
	*@return cartItem
	*/

	function __construct()
	{
		$this->loadCart();
	}
	private function findOne($Id)
	{
		return array_key_exists($Id,$this->items) ? $this->items[$Id] : null;
	}

	public function addProduct(Product $product,int $quantity)
	{
		$cartItem=$this->findOne($product->getid());
		if($cartItem==null){
			$cartItem= new cartItem();
			$cartItem->setProduct($product);
			$cartItem->setQuantity($quantity);
			$this->items[$product->getId()]=$cartItem;
			$db= database::$instance;
			$sql="INSERT INTO cartItem (productId,quantity) values(:productId,:quantity)";
			$arr=array("productId"=>$product->getId(),"quantity"=>$quantity);
			$db->execQuery($sql,$arr);
			return;
		}
		$cartItem->increaseQuantity($quantity);
	}
	public function removeProduct(Product $product)
	{
		$db=database::$instance;
		$sql= "DELETE from cartItem where productId=:productId";
		$db->execQuery($sql,["productId"=>$product->getId()]);
		unset($this->items[$product->getId()]);
		return $this->items;
	}
	public function getTotalQuantity() :int
	{
		$sum=0;
		foreach ($this->items as $item) {
			$sum+=$item->getQuantity();
		}
		return $sum;
	}
	public function getTotalSum() : float
	{
		$total=00.00;
		foreach ($this->items as $item) {
			$total +=$item->getProduct()->getPrice() * $item->getQuantity();
		}
		return $total;
	}
	public function loadCart()
	{
		$db=database::$instance;
		$store= store::$instance;
		$sql="SELECT productId,quantity from cartItem";
		$db->execQuery($sql);
		foreach ($db->load_data() as $key => $value) {
			if(isset($value["productId"])){
				$cartItem= new cartItem();
				$cartItem->setProduct($store->inventory[$value["productId"]]);
				$cartItem->setQuantity($value["quantity"]);
				$this->items[$value["productId"]]=$cartItem;
			}
		}
		return $this->items;
	}
}

?>