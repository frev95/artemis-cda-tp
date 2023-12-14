<?php

/**
 * Class Book
 * Représentation d'un livre dans l'app Artemis
 */

namespace Artemis;

require_once __DIR__ . '/../controller/Database.php';

use PDO;
use Artemis\Database;

class Book
{
    // Properties
        private int $id;
        private string $title;
        private string $description;
        private string $ISBN;
        private int $author_id;
        private int $publisher_id;

    // Constructor
        public function __construct(
            string $title,
            string $description,
            string $ISBN,
            int $author_id,
            int $publisher_id
        ) {
            $this->title = $title;
            $this->description = $description;
            $this->ISBN = $ISBN;
            $this->author_id = $author_id;
            $this->publisher_id = $publisher_id;
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

        public function getTitle()
        {
            return $this->title;
        }
        public function setTitle($title)
        {
            $this->title = $title;
            return $this;
        }

        public function getDescription()
        {
            return $this->description;
        }
        public function setDescription($description)
        {
            $this->description = $description;
            return $this;
        }

        public function getISBN()
        {
            return $this->ISBN;
        }
        public function setISBN($ISBN)
        {
            $this->ISBN = $ISBN;
            return $this;
        }

        public function getAuthor_id()
        {
            return $this->author_id;
        }
        public function setAuthor_id($author_id)
        {
            $this->author_id = $author_id;
            return $this;
        }

        public function getPublisher_id()
        {
            return $this->publisher_id;
        }
        public function setPublisher_id($publisher_id)
        {
            $this->publisher_id = $publisher_id;
            return $this;
        }

    /**
     * Méthode statique permettant de rechercher un livre
     * @param string $keyword
     * @return array
     */
    static public function searchBooks($keyword): array
    {
        $pdo = Database::getPDO();
        $query = "SELECT
                    Book.id AS BookId,
                    Book.title AS BookTitle,
                    Book.description AS BookDescription,
                    Book.isbn AS BookIsbn,
                    Author.name AS AuthorName,
                    Publisher.name AS PublisherName
                FROM Book JOIN Author ON Book.author_id = Author.id
                JOIN Publisher ON Book.publisher_id = Publisher.id
                WHERE Book.title LIKE '%$keyword%'
                ORDER BY Book.title ASC;
                ";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $books;
    }

    /**
     * Méthode statique permettant de récupérer tous les livres
     * @return array
     */
    static public function getAllBooks(): array
    {
        $query = "SELECT
                    Book.id AS BookId,
                    Book.title AS BookTitle,
                    Book.description AS BookDescription,
                    Book.isbn AS BookIsbn,
                    Author.name AS AuthorName,
                    Publisher.name AS PublisherName
                FROM Book JOIN Author ON Book.author_id = Author.id
                JOIN Publisher ON Book.publisher_id = Publisher.id
                ORDER BY Book.title ASC;
                ";
        $books = Database::executePDO($query, 'all');
        return $books;
    }

    /**
     * Méthode statique permettant de récupérer un livre
     * @param int $id
     * @return array
     */
    static public function getOneBook(int $id): array
    {
        $query = "SELECT
                    Book.id AS BookId,
                    Book.author_id AS AuthorId,
                    Book.publisher_id AS PublisherId,
                    Book.title AS BookTitle,
                    Book.description AS BookDescription,
                    Book.isbn AS BookIsbn,
                    Author.name AS AuthorName,
                    Publisher.name AS PublisherName
                FROM Book JOIN Author ON Book.author_id = Author.id
                JOIN Publisher ON Book.publisher_id = Publisher.id
                WHERE Book.id = $id;
        ";
        $book = Database::executePDO($query, 'one');
        return $book;
    }

    /**
     * Méthode statique permettant d'ajouter un livre
     * @param string $title
     * @param string $description
     * @param string $ISBN
     * @param int $author_id
     * @param int $publisher_id
     * @return void
     */
    static public function addBook($title, $description, $ISBN, $author_id, $publisher_id)
    {
        $pdo = Database::getPDO();
        $query = "INSERT INTO Book (
                title, description, ISBN, author_id, publisher_id
                ) VALUES (
                    :title, :description, :ISBN, :author_id, :publisher_id
                );";

        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':ISBN', $ISBN, PDO::PARAM_STR);
        $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->bindParam(':publisher_id', $publisher_id, PDO::PARAM_INT);

        $stmt->execute();
    }



    public function editBook(int $id)
    {
        $pdo = Database::getPDO();
        $query = "UPDATE Book 
                SET title = :title, 
                description = :description, 
                ISBN = :ISBN, 
                author_id = :author_id, 
                publisher_id = :publisher_id 
                WHERE id = $id;
                ";


        $stmt = $pdo->prepare($query);
        
        $stmt->bindParam(':title', $this->getTitle(), PDO::PARAM_STR);
        $stmt->bindParam(':description', $this->getDescription(), PDO::PARAM_STR);
        $stmt->bindParam(':ISBN', $this->getISBN(), PDO::PARAM_STR);
        $stmt->bindParam(':author_id', $this->getAuthor_id(), PDO::PARAM_INT);
        $stmt->bindParam(':publisher_id', $this->getPublisher_id(), PDO::PARAM_INT);

        $stmt->execute();
    }

}
// Code interdit après l'accolade