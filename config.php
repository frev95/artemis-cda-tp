<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create('fr_FR');


if (isset($_POST['dsn'])) {
    $dsn = $_POST['dsn'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $datasource = $_POST['datasource'];

    // var_dump($_POST);
    // die();
    if ($datasource === 'fakerphp') {
        // Connection à la base de données
        try {
            $pdo = new PDO($dsn,$username,$password,[
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

            // Suppression de toutes les tables
            $pdo->query("SET FOREIGN_KEY_CHECKS = 0");
            $pdo->query("DROP TABLE IF EXISTS Loan");
            $pdo->query("DROP TABLE IF EXISTS Client");
            $pdo->query("DROP TABLE IF EXISTS Book");
            $pdo->query("DROP TABLE IF EXISTS Publisher");
            $pdo->query("DROP TABLE IF EXISTS Author");
            $pdo->query("SET FOREIGN_KEY_CHECKS = 1");

            // Création de la table Author
            $pdo->query("CREATE TABLE Author (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                bio TEXT NOT NULL
            )");

            // Insertion d'exemples d'auteurs
            for ($i = 1; $i <= 180; $i++) {
                $authorData = [
                    'name' => $faker->name(),
                    'bio' => $faker->text(),
                ];

                $pdo->prepare("INSERT INTO Author (name, bio) VALUES (:name, :bio)")
                    ->execute($authorData);
            }

            // Création de la table Publisher
            $pdo->query("CREATE TABLE Publisher (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL
            )");

            // Insertion d'exemples d'éditeurs
            for ($i = 1; $i <= 50; $i++) {
                $publisherData = [
                    'name' => $faker->company(),
                ];

                $pdo->prepare("INSERT INTO Publisher (name) VALUES (:name)")
                    ->execute($publisherData);
            }

            // Création de la table Book
            $pdo->query("CREATE TABLE Book (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT NOT NULL,
                ISBN VARCHAR(13) NOT NULL,
                author_id INT UNSIGNED NOT NULL,
                publisher_id INT UNSIGNED NOT NULL,
                FOREIGN KEY (author_id) REFERENCES Author(id),
                FOREIGN KEY (publisher_id) REFERENCES Publisher(id)
            )");

            // Insertion d'exemples de livres
            for ($i = 1; $i <= 200; $i++) {
                $bookData = [
                    'title' => $faker->sentence(2),
                    'description' => $faker->text(),
                    'ISBN' => $faker->isbn13(),
                    'author_id' => rand(1, 180),
                    'publisher_id' => rand(1, 50),
                ];

                $pdo->prepare("INSERT INTO Book (title, description, ISBN, author_id, publisher_id) VALUES (:title, :description, :ISBN, :author_id, :publisher_id)")
                    ->execute($bookData);
            }

            // Création de la table Client
            $pdo->query("CREATE TABLE Client (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                deposit BOOLEAN NOT NULL
            )");

            // Insertion d'exemples de clients
            for ($i = 1; $i <= 50; $i++) {
                $clientData = [
                    'name' => $faker->name(),
                    'email' => $faker->email(),
                    'deposit' => rand(true, false)
                ];

                $pdo->prepare("INSERT INTO Client (name, email, deposit) VALUES (:name, :email, :deposit)")
                    ->execute($clientData);
            }

            // Création de la table Loan
            $pdo->query("CREATE TABLE Loan (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                client_id INT UNSIGNED NOT NULL,
                book_id INT UNSIGNED NOT NULL,
                start_date DATE NOT NULL,
                end_date DATE NOT NULL,
                returned BOOLEAN NOT NULL DEFAULT FALSE,
                archived BOOLEAN NOT NULL DEFAULT FALSE,
                FOREIGN KEY (client_id) REFERENCES Client(id),
                FOREIGN KEY (book_id) REFERENCES Book(id)
            )");

            // Insertion d'exemples de prêts
            for ($i = 1; $i <= 50; $i++) {
                $startTimestamp = rand(strtotime("-365 days"), time());
                $startDate = date("Y-m-d", $startTimestamp);

                $endTimestamp = strtotime("+1 month", $startTimestamp);
                $endDate = date("Y-m-d", $endTimestamp);

                $loanData = [
                    'client_id' => rand(1, 50),
                    'book_id' => rand(1, 200),
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'returned' => rand(true, false),
                    'archived' => rand(true, false)
                ];

                $pdo->prepare("INSERT INTO Loan (client_id, book_id, start_date, end_date, returned, archived) VALUES (:client_id, :book_id, :start_date, :end_date, :returned, :archived)")
                    ->execute($loanData);
            }
            header('Location: index.php');
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    } else if ($datasource === 'other') {
        echo '<h1>Récupérez le fichier SQL dans le dossier /data</h1>';
        echo '<h2>Importez le dans votre base de données</h2>';
        exit();
    }
} else {
    echo <<<HTML
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <title>TP• Artemis</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400&display=swap">
        <link rel="stylesheet" href="css/tailwind/tailwind.min.css">
        <link rel="icon" type="image/png" sizes="32x32" href="shuffle-for-tailwind.png">
        <script src="js/main.js"></script>
    </head>

    <body class="antialiased bg-body text-body font-body">
        <div class="w-full flex justify-center items-center py-5 bg-gray-800">
            <img src="/artemis-assets/logos/artemis-logo.svg" width="300">
        </div>
        <form action="" method="POST" class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Configuration</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Vous êtes sur le point de commencer votre TP. Veuillez remplir les champs ci-dessous pour commencer.
                    </p>
                    
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label for="dsn" class="block text-sm font-medium leading-6 text-gray-900">
                                Renseignez les infos de votre base de données
                            </label>
                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                Assurez-vous d'avoir créé une base de données avant de continuer.
                            </p>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">PDO : </span>
                                    <input type="text" name="dsn" id="dsn" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="mysql:host=localhost;dbname=artemis_tp;charset=utf8mb4" required>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="username" class="block text-sm font-medium leading-6 text-gray-900">
                                Votre nom d'utilisateur d'utilisateur de la base de données
                            </label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">Username : </span>
                                    <input type="text" name="username" id="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="root" required>
                                </div>
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                                Votre mot de passe (si vous n'en avez pas, laissez vide)
                            </label>
                            <div class="mt-2">
                                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                                    <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">Password : </span>
                                    <input type="text" name="password" id="password" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Génération de données fictives</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Nous allons générer des données fictives pour remplir votre base de données. Veuillez choisir votre configuration. Pour FakerPHP, assurez-vous d'avoir lanceé la commande <code>composer install</code> avant de continuer.
                    </p>

                    <div class="mt-10 space-y-10">
                        <select id="datasource" name="datasource" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                            <option value="fakerphp">FakerPHP</option>
                            <option value="other">Autre</option>
                        </select>
                    </div>
                </div>

                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Important</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Les instructions pour la réalisation du TP sont dans le fichier README.md</p>
                    <p class="mt-1 text-sm leading-6 text-gray-600">
                        Si vous avez des questions, n'hésitez pas à me contacter par mail à <a href="mailto:hello@agiliteach.org" class="text-indigo-600 hover:text-indigo-500">hello@agiliteach.org</a>
                    </p>
                </div>

            </div>

            <div class="mt-6 flex items-center justify-start gap-x-6">
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Valider</button>
            </div>
        </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="js/charts-demo.js"></script>
    </body>

</html>

HTML;
}
