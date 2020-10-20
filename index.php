<?php

include "src/class/Product.php";
include "src/class/ProductList.php";
include "src/class/Command.php";
include "src/class/Cart.php";
include "src/class/SessionStorage.php";

$productList = new ProductList();

$cart = new Cart();

// traitement du formulaire

if (isset($_POST['quantity'])) {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];

    // Encapsulation

    $product = $productList->getProductByIndex($index);
    $cart->addProduct($product, $quantity);
}

?>

<html>

<head>
</head>

<body>

    <h1> Mes super produits </h1>

    <a href="cart.php"> Voir le panier </a>

    <?php
    $productList->display();
    ?>
</body>

</html>