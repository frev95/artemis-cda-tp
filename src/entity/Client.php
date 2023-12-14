<?php

/**
 * Class Publisher
 * Représentation d'un éditeur dans l'app Artemis
 */

namespace Artemis;

class Client
{
    // Properties
    public int $id;
    public string $name;
    public string $email;
    public string $deposit;

    // Constructor
    public function __construct(
        int $id,
        string $name,
        string $email,
        string $deposit
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->deposit = $deposit;
    }

    // Getters & Setters 
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getDeposit()
    {
        return $this->deposit;
    }
    public function setDeposit($deposit)
    {
        $this->deposit = $deposit;
        return $this;
    }

    // Methods
    public function getAllClients()
    {
        // Code
    }

    static public function getOneClient(int $id): array
    {
        $query = "SELECT Client.id AS ClientId,
                         Client.email AS BookEmail,
                         Client.name AS ClientName,
                         Client.deposit AS ClientDeposit
                  FROM Client WHERE Client.id = $id;";

        $book = Database::executePDO($query, 'one');
        return $book;
    }

    public function addClient(str $name, str $email, str $deposit)
    {
        $pdo = Database::getPDO();

        $query = "INSERT INTO Client (name, email, deposit)
                  VALUES (:name, :email, :deposit);";

        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':deposit', $deposit, PDO::PARAM_STR);

        $stmt->execute();
    }

    public function editClient(int $id)
    {
        $pdo = Database::getPDO();
        $query = "UPDATE Client 
                  SET name = :name, 
                      email = :email, 
                      deposit = :deposit 
                  WHERE id = $id;";

        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':name', $this->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':email', $this->getEmail(), PDO::PARAM_STR);
        $stmt->bindParam(':deposit', $this->getDeposit(), PDO::PARAM_STR);

        $stmt->execute();
    }

    public function deleteClient()
    {
        // Voir delete des éléments par type (entité)
    }
}
//Pas de code ici