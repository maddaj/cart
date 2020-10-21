<?php

class SessionStorage implements IStorage
{
    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        session_start();
    }

    public function saveCommands(array $commands): void
    {
        $_SESSION['cart'] = $commands;
    }

    public function loadCommands(): array
    {
        if (isset($_SESSION['cart']))
            return $_SESSION['cart'];
        else
            return [];
    }
}
