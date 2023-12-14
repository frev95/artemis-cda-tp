<?php

namespace Artemis;

require_once __DIR__ . '/src/entity/Book.php';


use Artemis\Book;

if (!isset($_GET['id'])) {
    header('Location: books.php');
    exit;
}
$book = Book::getOneBook($_GET['id']);

$pageTitle = $book['BookTitle'];

include __DIR__ . '/templates/header.php';

include __DIR__ . '/templates/hero-book.php';

?>

<div class="container px-4 mb-6 mx-auto">
    <div>
        <div class="px-4 sm:px-0">
            <h3 class="text-base font-semibold leading-7 text-gray-900">Information sur l'ouvrage</h3>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Les détails enregistrés à propos de ce livre</p>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Titre du livre</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?= !empty($book['BookTitle']) ? $book['BookTitle'] : 'Undefined' ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Description</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?= !empty($book['BookDescription']) ? $book['BookDescription'] : 'Undefined' ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">ISBN</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?= !empty($book['BookIsbn']) ? $book['BookIsbn'] : 'Undefined' ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">Editeur</dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?= !empty($book['PublisherName']) ? $book['PublisherName'] : 'Undefined' ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">
                        Auteur(e)
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?= !empty($book['AuthorName']) ? $book['AuthorName'] : 'Undefined' ?>
                    </dd>
                </div>
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm font-medium leading-6 text-gray-900">
                        Autres ouvrages de l'auteur(e)
                    </dt>
                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <!-- TODO: Renseignez les autres ouvrages de cet auteur -->
                        Renseignez les autres ouvrages de cet auteur
                    </dd>
                </div>
            </dl>
        </div>
    </div>

    <div class="my-6 flex items-center justify-start gap-x-6">
        <button type="button" onclick="showModal('edit')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Mettre à jour</button>
        <button type="button" onclick="showModal('delete')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Supprimer</button>
    </div>
</div>

<?php

include __DIR__ . '/templates/_partials/modal_edit.php';

include __DIR__ . '/templates/_partials/modal_delete.php';

include __DIR__ . '/templates/footer.php';
