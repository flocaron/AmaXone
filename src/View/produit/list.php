<div class="bg-white">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold items-center tracking-tight text-gray-900">Notre Catalogue</h2>
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <?php foreach ($inventaire as $produit) { ?>
                <div class="group relative">
                    <div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md group-hover:opacity-75 lg:aspect-none lg:h-80">
                        <a href="frontController.php?controller=produit&action=read&id=<?php echo rawurlencode($produit->getId()); ?>">
                            <img src="<?php echo "../assets/images/" . htmlspecialchars($produit->getImgPath()); ?>"
                                 alt=".."
                                 class="h-full w-full object-fit object-scale-down object-center lg:h-full lg:w-full">
                        </a>

                    </div>
                    <div class="mt-4 flex justify-between">
                        <div>
                        </div>
                        <?php echo htmlspecialchars($produit->getLibelle()); ?>
                        <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($produit->getPrix()) . " €"; ?></p>
                    </div>
                    <p class="text-sm font-medium text-gray-900"><a
                                href="frontController.php?controller=produit&action=addPanier&read&id=<?php echo rawurlencode($produit->getId()); ?>">Ajouter
                            au panier</a></p>

                </div>
            <?php } ?>
        </div>
        <?php
        if ($estAdmin) {
            echo "<a href='frontController.php?action=create&controller=produit'> Nouveau Produit </a>";
        }
        ?>
    </div>
</div>
