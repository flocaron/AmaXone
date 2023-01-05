<div class="flex items-center justify-center w-full">
    <div class="w-full p-4">
        <div class="flex flex-col justify-center p-10 bg-white rounded-lg shadow-2xl card">
            <div class="prod-title">
                <p class="text-2xl font-bold text-gray-900 uppercase">
                    <?php echo htmlspecialchars($categorie->getNom()); ?>
                </p>
                <p class="text-sm mt-5 text-gray-400 uppercase">
                    <?php echo htmlspecialchars($categorie->getDescription()); ?>
                </p>
            </div>
            <div class="prod-img mt-5">
                <img src="<?php echo "../assets/images/categories/" .htmlspecialchars($categorie->getImgPath()); ?>"
                     class="aspect-video w-1/2" alt=".."/>
            </div>
        </div>
    </div>
</div>
