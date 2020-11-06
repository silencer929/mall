<?php
class cartItem
{
	private Product $product;
	private int $quantity;

	function __construct(int $quantity=1)
	{
		//$this->product=$product;
		$this->quantity=$quantity;
	}
	public function setProduct(Product $product): void
	{
		$this->product=$product;
	}
	public function getProduct()
	{
		return $this->product;
	}
	public function setQuantity($quantity=1) :void
	{
		$this->quantity=$quantity;
	}
	public function getQuantity()
	{
		return $this->quantity;
	}
	public function increaseQuantity($quantity) :void
	{
		if($this->getQuantity() + $quantity> $this->product->getAmount()){
			throw new Exception("maximum limit exceed");
		}
		$this->quantity+=$quantity;
	}
	public function decreaseQuantity()
	{

	}
}

?>