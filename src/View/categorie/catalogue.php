<div class="bg-gray-100">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:max-w-none lg:py-32">
            <h2 class="text-2xl font-bold text-gray-900">Categories</h2>
            <div class="mt-6 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-6 lg:space-y-0">
                <?php foreach ($inventaire as $categorie) { ?>
                    <div class="group relative my-3">
                        <div class="relative h-80 w-full overflow-hidden rounded-lg bg-white group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 sm:h-64 lg:aspect-w-1 lg:aspect-h-1">
                            <a href="frontController.php?controller=produit&action=catalogue&nom=<?= htmlspecialchars($categorie->getNom()) ?>">
                                <img src="<?php echo "../assets/images/categories/" . htmlspecialchars($categorie->getImgPath()); ?>"
                                     alt="Une categorie X" class="h-full w-full object-scale-down object-center">
                            </a>
                        </div>
                        <div class="flex flex-row justify-between">
                            <p class="text-base font-semibold text-gray-900"> <?php echo htmlspecialchars($categorie->getNom()); ?></p>
                            <a href='frontController.php?action=read&controller=categorie&nom=<?= rawurlencode($categorie->getNom()) ?>'>
                                <img src="../assets/images/icons/info.png" class="h-4 mt-1">
                            </a>
                        </div>
                    </div>
                <?php } ?>
                <?php if ($estAdmin) { ?>
                    <div class=" w-full items-center justify-center rounded-md object-center hover:shadow-lg transition duration-300 ease-in-out lg:aspect-none lg:h-80">
                        <a href="frontController.php?action=create&controller=categorie">
                            <img src="../assets/images/add.png"
                                 alt="Ajouter un produit"
                                 class="h-1/2 space-x-5">
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>