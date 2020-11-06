<?php
class Product
{
	private int $productId;
	private string $title='';
	private float $price;
	private int $amount;
	public string $img='';
	/**
	*@param cart $cart
	*@param int $quantity
	*@return void
	*@return cartItem
	*/

	function __construct($id=0,$title="",$price=0.00,$amount=0,$img="")
	{
		/*$this->productId=$id;
		$this->title=$title;
		$this->price=$price;
		$this->amount=$amount;
		$this->img=$img;*/
	}
	public function setId($id)
	{
		$this->productId=$id;
	}
	public function getId() : int
	{
		return $this->productId;
	}
	public function setTitle($title) : void
	{
		$this->title=$title;
	}
	public function getTitle() :string
	{
		return $this->title;
	}
	public function setPrice($price) :void
	{
		$this->price=$price;
	}
	public function getPrice() : float
	{
		return $this->price;
	}
	public function setAmount($amount) :void
	{
		$this->amount=$amount;
	}
	public function getAmount() :int
	{
		return $this->amount;
	}
	public function addToCart(cart $cart,int $quantity)
	{
		$cart->addProduct($this,$quantity);
	}
	public function removeFromCart(cart $cart)
	{
		$cart->removeProduct($this);
	}
	public function add_into_inventory()
	{
		$store= store::$instance;
		$store->addProduct($this);
	}
}

?>