<?php
require_once "cart.php";
require_once "product.php";
require_once "cartItem.php";
require_once "define.php";
require_once 'store.php';
require_once 'database.php';
$db=database::getInstance();
$store= store::getInstance();
$store->loadProducts();
$cart= new cart();
if(isset($_GET["remove"])){
	if(array_key_exists($_GET["remove"], $cart->items)){
		$prod= $cart->items[$_GET["remove"]]->getProduct();
	$cart->removeProduct($prod);
	unset($_GET["remove"]);
	}
	header("location:".url."/index.php");
	exit();
}
if(isset($_GET['id'])){
	$store->inventory[$_GET["id"]]->addToCart($cart,2);
	echo "<pre>";
	print_r($cart);
	header("location:".url ."/index.php");
	exit();
}

?>