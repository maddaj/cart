<?php

class Product
{
    private $name;
    private $price;

    public function __construct(String $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): String
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
