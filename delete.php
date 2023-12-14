<?php

use Artemis\Database;

require_once __DIR__ . '/src/controller/Database.php';

if (!empty($_POST['id'])) {
  if (isset($_POST['type']) && $_POST['type'] === 'book') {
    Database::delete($_POST['type'], $_POST['id'], 'Loan');
  } elseif (isset($_POST['type']) && $_POST['type'] === 'author') {
    Database::delete($_POST['type'], $_POST['id'], 'Book');
  } elseif (isset($_POST['type']) && $_POST['type'] === 'client') {
    Database::delete($_POST['type'], $_POST['id'], 'Loan');
  } else {
    Database::delete($_POST['type'], $_POST['id']);
  }
  header('Location: index.php');
}
