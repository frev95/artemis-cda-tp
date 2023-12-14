<?php

namespace Artemis;

require_once __DIR__ . '/../../src/controller/Database.php';

$authors = Database::getAll('Author');
$publishers = Database::getAll('Publisher');

?>

<div id="modal-edit" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?= !empty($book['BookId']) ? $book['BookId'] : 'Undefined' ?>" />
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Formulaire d'ajout d'un nouveau livre</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Remplissez les champs ci-dessous pour ajouter un nouveau livre</p>
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-8">
                                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Titre du livre</label>
                                        <div class="mt-2">
                                            <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= !empty($book['BookTitle']) ? $book['BookTitle'] : 'Undefined' ?>">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-8">
                                        <label for="isbn" class="block text-sm font-medium leading-6 text-gray-900">ISBN</label>
                                        <div class="mt-2">
                                            <input type="text" name="isbn" id="isbn" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= !empty($book['BookIsbn']) ? $book['BookIsbn'] : 'Undefined' ?>">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-8">
                                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                        <div class="mt-2">
                                            <textarea id="description" name="description" type="text" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= !empty($book['BookDescription']) ? $book['BookDescription'] : 'Undefined' ?></textarea>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3 sm:col-start-1">
                                        <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Auteur(e)</label>
                                        <div class="mt-2">
                                            <select name="author" id="author" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="<?= !empty($book['AuthorId']) ? $book['AuthorId'] : 'Undefined' ?>"><?= !empty($book['AuthorName']) ? $book['AuthorName'] : 'Undefined' ?></option>
                                                <?php foreach ($authors as $author) : ?>
                                                    <option value="<?= $author['id'] ?>"><?= $author['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <label for="editor" class="block text-sm font-medium leading-6 text-gray-900">Maison d'édition</label>
                                        <div class="mt-2">
                                            <select name="publisher" id="publisher" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                <option value="<?= !empty($book['PublisherId']) ? $book['PublisherId'] : 'Undefined' ?>"><?= !empty($book['PublisherName']) ? $book['PublisherName'] : 'Undefined' ?></option>
                                                <?php foreach ($publishers as $publisher) : ?>
                                                    <option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse gap-x-3 sm:px-6">
                        <button type="submit" class="inline-flex rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                        <button type="button" onclick="hideModal('edit')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>