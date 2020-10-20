<?php

class ProductList
{
    private $products = [];

    public function __construct()
    {
        array_push($this->products, new Product('Coca', 1.5));
        $this->products[] = new Product('Frites', 3);
        $this->products[] = new Product('Salade', 4);
        $this->products[] = new Product('Glace', 4);
    }

    public function display(): void
    {
        echo "<ul>";
        foreach ($this->products as $product) {
            echo "
            <li> 
                {$product->getName()} {$product->getPrice()}
                <form action='' method='POST'>
                    <label for='quantity'>Quantité</label>
                    <input type='text' name='quantity' id='quantity'>
                    <button>Ajouter</button>
                </form>
            </li>";
        }
        echo "</ul>";
    }
}
