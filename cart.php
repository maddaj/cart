<?php

include "src/class/Product.php";
include "src/class/ProductList.php";
include "src/class/Command.php";
include "src/class/Cart.php";
include "src/interface/IStorage.php";
include "src/class/DatabaseStorage.php";
include "src/class/SessionStorage.php";

$cart = new Cart();

?>

<html>

<head>
</head>

<body>

    <h1> Panier </h1>

    <?php $cart->display(); ?>
</body>

</html>