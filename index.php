<?php
require_once "cart.php";
require_once "product.php";
require_once "cartItem.php";
require_once "define.php";
require_once 'store.php';
require_once 'database.php';

//=========================================================================
database::getInstance();
$store= store::getInstance();
$store->loadproducts();
$cart= new cart();
//$cart->loadCart();
//=========================================================================

?>
<!-----------------------------------------view------------------------>
<!DOCTYPE html>
<html>
<head>
  <title>shopping Cart</title>
  <link rel="stylesheet" type="text/css" href="<?php echo url;?>/public/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo url;?>/public/css/style.css">
    <script type="text/javascript" src="<?php echo url;?>/public/js/jquery.js"></script>
  <style type="text/css">
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
  </style>
</head>
<body style="overflow-x: hidden;">
  <section class="A">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">Fixed navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
  
  </nav>
  <!------------------------------------cart-------------------------------->
<section class="B">
<section class="cart-area">
  <?php foreach ($cart->items as $key => $cartItem): ?>
     <form class="cart-item" method="GET" action="process.php">
    <div class="cart-img"><img src="<?php echo url?>/public/img/<?php echo $cartItem->getProduct()->img?>" class="image"></div>
    <div class="box">
      <div class="cart-details"><span>price:<?php echo $cartItem->getProduct()->getPrice(); ?></span><span>price:<?php echo $cartItem->getProduct()->getTitle(); ?></span></div>
      <input type="hidden" name="remove" value="<?php echo $cartItem->getProduct()->getId()?>">
      <div class="remove-btn"><button type="submit">remove</button></div>
    </div>
    <div class="amount">
      <div class="add-btn"><span>^</span></div>
      <div class="quantity"><span><?php echo $cartItem->getQuantity();?></span></div>
      <div class="sub-btn" style="transform: rotate(180deg);"><span>^</span></div>
    </div>
  </form>
  <?php endforeach ?>
  <div class="total" style="text-align: center;">
    <span>total Amount:<?php echo $cart->getTotalSum(); ?></span>
  </div>
  <div class="check-out">
    <button type="button" class="check-out-btn btn-primary btn-block"> check out</button>
  </div>
</section>
<!------------------------------------end of cart------------------------->


  <!-------------------welcome screen------------------->
    
<!---------------------------------------------------end of welcome screen------------------------------------------------------>

<!-------------------show items------------------>

<section class="contain">
  <?php foreach ($store->loadproducts() as $key => $product): ?>
    <form class="fluid-container" action="<?php echo url;?>/process.php" method="GET">
    <div class="product">
      <div class="product-img">
        <img src="<?php echo url?>/public/img/<?php echo $product->img;?>" class="image">
      </div>
      <div class="product-details">
        <div class="line"></div>
        <span>title:<?php echo $product->getTitle() ?? ""; ?></span>
      <div class="line"></div>
      <span>price:<?php echo $product->getPrice() ?? "";?></span>
      <div class="line"></div>
      </div>
    </div>
    <div class="fluid-bottom">
      <input type="hidden" name="id" value="<?php echo $product->getId();?>">
      <span class="product-amount"> Remaing:<?php echo $product->getAmount();?></span><button  class="product-btn" type="submit"> add to cart</button>
    </div>
  </form>
<?php endforeach ?>
  

</section>
</section>

<!------------------------------------------------end of show items------------>










</section>

<script type="text/javascript" src="<?php echo url;?>/public/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo url;?>/public/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo url;?>/public/js/main.js"></script>
</body>

</html>
<?php

?>
