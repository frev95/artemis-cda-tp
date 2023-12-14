<?php

/**
 * Class Publisher
 * Représentation d'un éditeur dans l'app Artemis
 */

namespace Artemis;

class Publisher
{
    // Properties
    public int $id;
    public string $name;

    // Constructor
    public function __construct(
        int $id, 
        string $name
        )
    {
        $this->id = $id;
        $this->name = $name;
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

    // Methods
    public function getAllPublishers()
    {
        // Code
    }
    public function getOnePublisher()
    {
        // Code
    }
    public function addPublisher()
    {
        // Code
    }
    public function editPublisher()
    {
        // Code
    }
    public function deletePublisher()
    {
        // Code
    }
}
//Pas de code ici