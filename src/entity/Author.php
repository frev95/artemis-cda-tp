<?php

/**
 * Class Author
 * Représentation d'un auteur dans l'app Artemis
 */

namespace Artemis;

class Author
{
    // Properties
    public int $id;
    public string $name;
    public string $bio;

    // Constructor
    public function __construct(
        int $id,
        string $name,
        string $bio
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->bio = $bio;
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

    public function getBio()
    {
        return $this->bio;
    }
    public function setBio($bio)
    {
        $this->bio = $bio;
        return $this;
    }

    // Methods
    public function getAllAuthors() // Read
    {
        // Code
    }
    public function getOneAuthor() // Read
    {
        // Code
    }
    public function addAuthor() // Create
    {
        // Code
    }
    public function editAuthor() // Update
    {
        // Code
    }
    public function deleteAuthor() // Delete
    {
        // Code
    }
}
//Pas de code ici