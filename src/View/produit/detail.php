<div class="flex items-center justify-center w-full">
    <div class="w-full p-4">
        <div class="flex flex-col justify-center p-10 bg-white rounded-lg shadow-2xl card">
            <div class="prod-title">
                <p class="text-2xl font-bold text-gray-900 uppercase">
                    <?php echo htmlspecialchars($produit->getLibelle()); ?>
                </p>
                <p class="text-sm mt-5 text-gray-400 uppercase">
                <?php echo htmlspecialchars($produit->getDescription()); ?>
                </p>
            </div>
            <div class="prod-img mt-5">
                <img src="<?php echo "../assets/images/produits/" . htmlspecialchars($produit->getImgPath()); ?>" class="object-cover object-center w-full" alt=".."/>
            </div>
            <div class="grid gap-10 prod-info">
                <div class="flex flex-col items-center justify-between text-gray-900 md:flex-row mt-10">
                    <p class="text-xl font-bold">
                        <?php echo htmlspecialchars($produit->getPrix()) . " €"; ?>
                    </p>
                    <button class="px-6 py-2 uppercase transition duration-200 ease-in border-2 border-gray-900 rounded-full hover:bg-gray-800 hover:text-white focus:outline-none">
                        <a href="frontController.php?controller=produit&action=addPanier&nom=<?= rawurlencode($produit->getCategorie()) ?>&id=<?php echo rawurlencode($produit->getId()); ?>">
                            Ajouter au Panier </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
