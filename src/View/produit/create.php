<div class="mt-10 sm:mt-0">
    <div class="mt-5 px-10 md:col-span-2 md:mt-0">
        <form enctype="multipart/form-data"
              action="frontController.php?action=<?php echo $action == "create" ? "created" : "updated" ?>&controller=produit"
              method="post">
            <div class="overflow-hidden shadow sm:rounded-md">
                <div class=" flex flex-col gap-6 bg-white px-4 py-5 sm:p-6">
                    <?php if ($action == "update") { ?>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="id" class="block text-sm font-medium text-gray-700">ID</label>
                            <input type="text" name="id" id="id" readonly
                                   value='<?php echo htmlspecialchars($produit->getId()) ?>'
                                   class="mt-1 block h-7 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                    <?php } else {
                        echo "<input type='hidden' name='id' value='-1' />";
                    } ?>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="libelle" class="block text-sm font-medium text-gray-700">Nom Produit</label>
                            <input type="text" name="libelle" id="libelle" required
                                <?php echo isset($produit) ? "value='" . htmlspecialchars($produit->getLibelle()) . "'" : "placeholder='ex: Casque Audio'" ?>
                                   class="mt-1 block h-7 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                            <input type="number" name="prix" id="prix" required
                                <?php echo isset($produit) ? "value='" . htmlspecialchars($produit->getPrix()) . "'" : "placeholder='36'" ?>
                                   class="mt-1 block h-7 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        </div>

                    </div>

                    <div class="flex flex-col gap-6">
                        <div>
                            <label for="about" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <input id="about" name="description"
                                          <?php echo isset($produit) ? "value='" . htmlspecialchars($produit->getDescription()) . "'" : "placeholder='ex: Superbe casque audio avec un son en stéréo defiant la chronique !'" ?>
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                            </div>
                        </div>
                        <label class="block text-sm font-medium text-gray-700">Image Article</label>
                        <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                     viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                          stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload"
                                           class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="file-upload" name="file-upload" type="file"
                                               class="sr-only" <?php echo $action == "create" ? "required" : "" ?>>
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

