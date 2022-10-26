<?php require __DIR__ . "/../nav.php" ?>
<div class="bg-white">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold items-center tracking-tight text-gray-900">Notre Catalogue</h2>
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <?php foreach ($inventaire

                           as $produit) { ?>

                <div class="group relative">
                    <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-80">
                        <img src="<?php echo "assets/" . $produit->getImgPath(); ?>"
                             alt=".."
                             class="h-full w-full object-fit object-scale-down object-center lg:h-full lg:w-full">
                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700">
                                <a href="frontController.php?controller=composant&action=read&id=<?php echo $produit->getId(); ?>"">
                                <span aria-hidden="true" class="absolute inset-0"></span>
                                <?php echo $produit->getLibelle(); ?>
                                </a>
                            </h3>
                        </div>
                        <p class="text-sm font-medium text-gray-900"><?php echo $produit->getPrix() . " €"; ?></p>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
