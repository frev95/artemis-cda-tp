<?php

namespace Artemis;

?>

<div id="modal-edit" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <form action="edit_client.php" method="post">
                    <input type="hidden" name="id" value="<?= !empty($book['ClientId']) ? $book['ClientId'] : 'Undefined' ?>" />
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Formulaire d'édition d'un client</h2>
                                <p class="mt-1 text-sm leading-6 text-gray-600">Pour ajouter un nouveau client ou modifier les données d'un client existant</p>
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-8">
                                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nom du client</label>
                                        <div class="mt-2">
                                            <input type="text" name="name" id="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= !empty($client['ClientName']) ? $client['ClientName'] : 'Undefined' ?>">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-8">
                                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email du client</label>
                                        <div class="mt-2">
                                            <input type="text" name="email" id="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= !empty($client['ClientEmail']) ? $client['ClientEmail'] : 'Undefined' ?>">
                                        </div>
                                    </div>

                                    <div class="sm:col-span-8">
                                        <label for="deposit" class="block text-sm font-medium leading-6 text-gray-900">Caution ?</label>
                                        <div class="mt-2">
                                            <textarea id="deposit" name="deposit" type="text" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= !empty($client['ClientDeposit']) ? $client['ClientDeposit'] : 'Undefined' ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse gap-x-3 sm:px-6">
                        <button type="submit" class="inline-flex rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enregistrer</button>
                        <button type="button" onclick="hideModal('edit_client')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>