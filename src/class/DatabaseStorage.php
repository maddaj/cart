<?php

class DatabaseStorage implements IStorage
{
    private $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        $db_user = "root";
        $db_passwd = "root";
        $db_host = "localhost";
        $db_port = "8889";
        $db_name = "cart";

        $this->pdo = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_passwd);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function saveCommands(array $commands): void
    {
        // On vide la BDD avant d'enregistrer une nouvelle fois la commande
        $this->pdo->query('DELETE FROM commande');
        // Pour chaque produit commandé, on insert les données correspondantes dans la BDD
        foreach ($commands as $command) {
            $query = $this->pdo->prepare("INSERT INTO commande VALUES (NULL, :name, :price, :quantity)");
            $query->execute([
                'name' => $command->getProduct()->getName(),
                'price' => $command->getProduct()->getPrice(),
                'quantity' => $command->getQuantity()
            ]);
        }
    }

    public function loadCommands(): array
    {
        $commands = [];

        $response = $this->pdo->query("SELECT * FROM commande");
        $result = $response->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            $product = new Product($row['name'], $row['price']);
            $command = new Command($product, $row['quantity']);
            $commands[$product->getName()] = $command;
        }
        return $commands;
    }
}
