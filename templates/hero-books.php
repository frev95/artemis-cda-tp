<section class="py-8">
    <div class="container px-4 mx-auto">
        <div class="py-12 bg-indigo-500 rounded overflow-hidden">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 px-6 md:pl-12 lg:pr-0 mb-10 md:mb-0">
                    <h3 class="mb-2 text-6xl font-medium text-white">
                        <span>
                            <?= !empty($title) ? $title : 'Undefined' ?>
                        </span>
                    </h3>
                    <p class="text-xl font-medium text-blue-100">
                        <?= !empty($subtitle) ? $subtitle : 'Undefined' ?>
                    </p>
                </div>
                <div class="relative w-full md:w-1/2 px-12">
                    <img class="lg:absolute top-0 lg:mr-12 right-0 lg:-mt-24 lg:h-80 object-cover" src="artemis-assets/images/chart-folder.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>