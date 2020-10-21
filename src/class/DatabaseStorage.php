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
        $db_user = "****";
        $db_passwd = "****";
        $db_host = "localhost";
        $db_port = "****";
        $db_name = "****";

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
            // On recréer un produit
            $product = new Product($row['name'], $row['price']);
            // On recréer une commande qui utilise le produit en ajoutant la quantité
            $command = new Command($product, $row['quantity']);
            // On recréer un tableau associatif (clé/valeur) en le "rangeant" par nom de produit
            $commands[$product->getName()] = $command;
        }
        return $commands;
    }
}
