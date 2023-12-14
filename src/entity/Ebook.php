<?php

/**
 * Child class of Book
 * Représentation d'un livre numérique dans l'app Artemis
 */
require __DIR__ . '/Book.php';

use Artemis\Book;

class Ebook extends Book
{
    // Properties
    public bool $isAugmented;
    public int $availability;
    public bool $isDownloadable;

    // Constructor
    public function __construct(
        public int $id,
        string $title,
        string $description,
        string $ISBN,
        int $author_id,
        int $publisher_id,
        bool $isAugmented,
        int $availability,
        bool $isDownloadable
    ) {
        parent::__construct(
            $id,
            $title,
            $description,
            $ISBN,
            $author_id,
            $publisher_id
        );
        $this->isAugmented = $isAugmented;
        $this->availability = $availability;
        $this->isDownloadable = $isDownloadable;
    }

    // Methods
    public function getIsAugmented(): bool
    {
        return $this->isAugmented;
    }
    public function setIsAugmented($isAugmented): self
    {
        $this->isAugmented = $isAugmented;
        return $this;
    }

    public function getAvailability(): int
    {
        return $this->availability;
    }
    public function setAvailability($availability): self
    {
        $this->availability = $availability;
        return $this;
    }

    public function getIsDownloadable(): bool
    {
        return $this->isDownloadable;
    }
    public function setIsDownloadable($isDownloadable): self
    {
        $this->isDownloadable = $isDownloadable;
        return $this;
    }
}
