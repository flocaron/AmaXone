<div class="bg-white">
    <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold items-center tracking-tight text-gray-900">Notre Catalogue</h2>
        <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            <?php foreach ($produits as $produit) { ?>
                <div class="group relative">
                    <div class="min-h-80 aspect-w-1 aspect-h-1 w-full rounded-md hover:shadow-lg transition duration-300 ease-in-out lg:aspect-none lg:h-80">
                        <a href="frontController.php?controller=produit&action=read&id=<?php echo rawurlencode($produit->getId()); ?>">
                            <img src="<?php echo "../assets/images/" . htmlspecialchars($produit->getImgPath()); ?>"
                                 alt=".."
                                 class="h-full w-full object-fit object-scale-down object-center lg:h-full lg:w-full">
                        </a>

                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <p class=" py-1.5 px-1.5 leading-none text-center whitespace-nowrap align-baseline font-bold bg-blue-600 text-white rounded">
                            <?php echo htmlspecialchars($produit->getLibelle()); ?> </p>
                        <p class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($produit->getPrix()) . " €"; ?></p>
                        <a href="frontController.php?controller=produit&action=addPanier&read&id=<?php echo rawurlencode($produit->getId()); ?>">
                            <img src="../assets/images/panier.svg"
                                 class="max-w-xs hover:scale-110 transition duration-300 ease-in-out" alt="panier">
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        foreach ($produits as $produit)
            echo '<li> <a href="frontController.php?controller=produit&action=delete&id='
                . rawurlencode($produit->getId())
                . '" > ❌ </a> <a href="frontController.php?controller=produit&action=update&id='
                . rawurlencode($produit->getId())
                . '" > ✅ </a> Produit <a href=\'frontController.php?controller=produit&action=read&id='
                . rawurlencode($produit->getId())
                . "'> "
                . htmlspecialchars($produit->getLibelle())
                . " </a></li>\n";
        ?>
        <li><a href="frontController.php?action=create&controller=produit"> Créer un nouveau produit </a></li>
    </div>
</div>

