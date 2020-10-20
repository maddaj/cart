<?php

class SessionStorage implements IStorage
{
    public function __construct()
    {
        session_start();
    }

    public function connect(): void
    {
    }

    public function saveCommands(Command $commands): void
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
