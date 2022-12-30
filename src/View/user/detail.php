<article class="grid grid-cols-2 gap-1">
    <!-- profil utilisateur !-->
    <div class="mt-5 p-10">
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Votre profil</h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo "Login: " . htmlspecialchars($user->get('login')); ?></p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo "Email: " . htmlspecialchars($user->get('email')); ?></p>
            <?php if ($estAdmin) { ?>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo "Nonce: " . htmlspecialchars($user->get('nonce')); ?></p>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo "Email à valider: " . htmlspecialchars($user->get('emailAValider')); ?></p>
            <?php } ?>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo "Nom: " . htmlspecialchars($user->get('nom')); ?></p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400"><?php echo "Prenom: " . htmlspecialchars($user->get('prenom')); ?></p>
            <div class="grid grid-cols-2 gap-4 ">
            <a <?php echo "href=frontController.php?controller=user&action=update&login=" . rawurlencode($user->get('login')) ?>
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Modifier le profil
                <svg class="ml-2" fill="#000000" height="32px" width="32px" id="Layer_1"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 70 70" xml:space="preserve">

                        <g id="SVGRepo_iconCarrier">
                            <g>
                                <path d="M57.583,34.959c-1.104,0-2,0.896-2,2v25.624h-49v-49H32.41c1.104,0,2-0.896,2-2s-0.896-2-2-2h-27 c-1.104,0-2.827,1.271-2.827,2.376v53c0,1.104,1.722,1.624,2.827,1.624h53c1.104,0,1.174-0.52,1.174-1.624v-28 C59.583,35.854,58.688,34.959,57.583,34.959z"/>
                                <path d="M66.253,13.116L57.769,4.63c-0.75-0.75-1.768-1.172-2.829-1.172c-1.061,0-2.078,0.421-2.828,1.172L17.648,39.093 c-0.459,0.458-0.799,1.021-0.992,1.642l-3.543,11.404c-0.427,1.375-0.082,2.874,0.904,3.924c0.765,0.815,1.825,1.263,2.916,1.263 c0.314,0,0.63-0.037,0.943-0.112l12.028-2.918c0.714-0.174,1.366-0.54,1.885-1.06l34.462-34.463 C67.814,17.211,67.814,14.679,66.253,13.116z M48.575,13.822l1.414,1.415L23.17,42.057l-1.415-1.415L48.575,13.822z M51.403,16.651 l2.829,2.829L27.413,46.3l-2.829-2.829L51.403,16.651z M16.933,53.325l1.132-3.645l2.712,2.712L16.933,53.325z M23.054,51.84 l-4.318-4.316l1.676-5.396l6.293,6.293l0,0.001c0,0,0,0,0.001,0.001l2.038,2.038L23.054,51.84z M30.241,49.128l-1.414-1.414 l26.82-26.82l1.414,1.414L30.241,49.128z M58.475,20.894l-8.485-8.485l4.95-4.95l8.484,8.486L58.475,20.894z"/>
                                <path d="M34.41,55.583c0,0.553,0.447,1,1,1h14c0.553,0,1-0.447,1-1s-0.447-1-1-1h-14C34.857,54.583,34.41,55.03,34.41,55.583z"/>
                                <path d="M39.409,49.583c0,0.553,0.447,1,1,1h9c0.553,0,1-0.447,1-1s-0.447-1-1-1h-9C39.856,48.583,39.409,49.03,39.409,49.583z"/>
                                <path d="M49.409,45.583c0.553,0,1-0.447,1-1s-0.447-1-1-1h-4c-0.553,0-1,0.447-1,1s0.447,1,1,1H49.409z"/>
                            </g>
                        </g>

                </svg>
            </a>
            <a <?php echo "href=frontController.php?controller=user&action=delete&login=" . rawurlencode($user->get('login')) ?>
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Supprimer le compte
                <svg class="ml-2" fill="#000000" height="32px" width="32px" id="Layer_1"
                     xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 512 512" xml:space="preserve"><g
                            id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M42.7,469.3c0,23.5,19.1,42.7,42.7,42.7h341.3c23.5,0,42.7-19.1,42.7-42.7V192H42.7V469.3z M362.7,256h42.7v192h-42.7V256z M234.7,256h42.7v192h-42.7V256z M106.7,256h42.7v192h-42.7V256z M490.7,85.3h-128V42.7C362.7,19.1,343.5,0,320,0H192 c-23.5,0-42.7,19.1-42.7,42.7v42.7h-128C9.5,85.3,0,94.9,0,106.7V128c0,11.8,9.5,21.3,21.3,21.3h469.3c11.8,0,21.3-9.5,21.3-21.3 v-21.3C512,94.9,502.5,85.3,490.7,85.3z M320,85.3H192V42.7h128V85.3z"></path>
                    </g></svg>
                </svg>
            </a>
        </div>
    </div>


    </div>
    <!-- Historique des commandes !-->
    <div class="mt-5 p-4">
        <h2 class="text-2xl font-bold items-center tracking-tight text-gray-900">Historique des commandes</h2>
        <div class="flex flex-row gap-2 mt-5 flex-wrap">
            <?php
            foreach ($commandes

                     as $commandeSerialize => $tab) {
                $commande = unserialize($commandeSerialize);
                $total = 0; ?>
                <div class="m-auto h-full w-full max-w-md bg-white shadow p-2 border-t-4 border-green-600 rounded">
                    <div class="flex flex-wrap p-2 w-full gap-4">
                        <div class="flex flex-col w-full">
                            <div class="flex flex-col">
                                <h4 class="text-xs font-bold">N° Commande</h4>
                                <h1 class="text-md font-bold">
                                    QUITTANCE-<?php echo htmlspecialchars($commande->getId()) ?></h1>
                            </div>
                            <h4 class="text-xs font-bold">Articles</h4>
                            <?php foreach ($tab

                            as $tabProduit) {
                            foreach ($tabProduit

                            as $produitSerialize => $qte) {
                            $produit = unserialize($produitSerialize);
                            ?>
                            <h1 class="text-xs">- <?php
                                echo htmlspecialchars($produit->getLibelle())
                                    . " "
                                    . htmlspecialchars($produit->getPrix())
                                    . "€ x$qte";
                                $total += $produit->getPrix() * $qte;
                                }
                                } ?>

                                <div class="flex flex-col">
                                    <h4 class="text-xs font-bold">Date Quittance</h4>
                                    <h1 class="text-md"><?php echo htmlspecialchars($commande->getDate()) ?>
                                </div>
                                <div class="p-4 border-t flex mt-4">
                                    <div class="flex flex-col">
                                        <h4 class="text-xs font-semibold">Montant payé</h4>
                                        <h1 class="text-lg font-mono text-green-600"><?php echo $total ?> euros</h1>
                                    </div>
                                </div>

                        </div>

                    </div>
                </div>
            <?php } ?>
</article>

