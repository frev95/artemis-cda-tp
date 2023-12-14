<?php

namespace Artemis;

require_once __DIR__ . '/src/controller/Database.php';
require_once __DIR__ . '/src/entity/Book.php';

use Artemis\Database;
use Artemis\Book;

$authors = Database::getAll('Author');
$publishers = Database::getAll('Publisher');


if (isset($_POST['submit'])) {

    Book::addBook(
        $_POST['title'],
        $_POST['description'],
        $_POST['isbn'],
        $_POST['author'],
        $_POST['publisher']
    );
}

include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero.php';

?>

<div class="container px-4 mb-6 mx-auto">
    <form>
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Formulaire d'ajout d'un nouveau livre</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Remplissez les champs ci-dessous pour ajouter un nouveau livre</p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Titre du livre</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="isbn" class="block text-sm font-medium leading-6 text-gray-900">ISBN</label>
                        <div class="mt-2">
                            <input type="text" name="isbn" id="isbn" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" type="text" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </textarea>
                        </div>
                    </div>

                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Auteur(e)</label>
                        <div class="mt-2">
                            <select type="text" name="author" id="author" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <?php foreach ($authors as $author) : ?>
                                    <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="editor" class="block text-sm font-medium leading-6 text-gray-900">Maison d'édition</label>
                        <div class="mt-2">
                            <select type="text" name="editor" id="editor" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <?php foreach ($publishers as $publishers) : ?>
                                    <option value="<?= $publishers['id'] ?>"><?= $publishers['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
        </div>
    </form>
</div>


<?php

include __DIR__ . '/templates/footer.php';
