<?php

include "src/Product.php";
include "src/ProductList.php";

$productList = new ProductList();

if (isset($_POST['quantity'])) {
    $productName = $_POST['name'];
    $productQuantity = $_POST['quantity'];
};

?>

<html>

<head>
</head>

<body>
    <h1> Mes super produits </h1>

    <?php
    $productList->display();
    ?>

</body>

</html>