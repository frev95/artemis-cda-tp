<?php

namespace Artemis;

require_once __DIR__ . '/src/entity/Client.php';

use Artemis\Client;

if (!empty($_POST['name'])) {
  $client = new Client(
    $_POST['name'],
    $_POST['email'],
    $_POST['deposit']
  );
  $client->editClient($_POST['id']);
  header('Location: client.php?id=' . $_POST['id']);
}
