<?php

namespace Artemis;

require_once __DIR__ . '/src/entity/Book.php';

use Artemis\Book;

if (!empty($_POST['title'])) {
  $book = new Book(
    $_POST['title'],
    $_POST['description'],
    $_POST['isbn'],
    $_POST['author'],
    $_POST['publisher']
  );
  $book->editBook($_POST['id']);
  header('Location: book.php?id=' . $_POST['id']);
}
