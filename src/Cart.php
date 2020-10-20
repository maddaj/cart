<?php

class Cart
{
    private $command = [];

    public function __construct()
    {
    }

    public function display(): void
    {
    }

    public function addProduct(Product $product, int $quantity)
    {
        $command = new Command($product, $quantity);
        $this->commands[] = $command;
    }

    public function getCommand(): array
    {
        return $this->command;
    }

    public function setCommand(array $command)
    {
        $this->command = $command;
    }
}
