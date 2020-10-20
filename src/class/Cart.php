<?php

class Cart
{
    private $commands = [];
    private $sessionStorage;

    public function __construct()
    {
        $this->sessionStorage = new SessionStorage();

        if (empty($this->sessionStorage->loadCommands()) == false) {
            $this->commands = $this->sessionStorage->loadCommands();
        }
    }

    public function addProduct(Product $product, int $quantity): void
    {
        if (array_key_exists($product->getName(), $this->commands)) {
            $command = $this->commands[$product->getName()];
            $command->addQuantity($quantity);
        } else {
            $command = new Command($product, $quantity);
            $this->commands[$product->getName()] = $command;
        }
        $this->sessionStorage->saveCommands($this->commands);
    }

    public function getTotalPriceWithTax(): float
    {
        $tva = 0.2;
        $total = 0;

        foreach ($this->commands as $command) {
            $total += $command->getTotalPrice();
        }

        $total = $total +  $total * $tva;
        return $total;
    }

    public function display(): void
    {
        if (!empty($this->commands)) {
            echo "<table>";
            echo "<tr> <th> Nom </th> <th> Prix unitaire </th> <th> Quantité </th><th> total </th></tr>";
            foreach ($this->commands as $command) {
                echo "<tr>";
                echo "<td>" . $command->getProduct()->getName() . "</td>";
                echo "<td>" . $command->getProduct()->getPrice() . "</td>";
                echo "<td>" . $command->getQuantity() . "</td>";
                echo "<td>" . $command->getTotalPrice() . " €</td>";
                echo "</tr>";
            }
            echo "</table>";

            echo "<p> Total : {$this->getTotalPriceWithTax()} </p>";
        } else {
            echo "<p> Panier Vide </p>";
        }
    }
}
