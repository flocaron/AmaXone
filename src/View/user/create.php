<div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
        <div>
            <img class="mx-auto h-12 w-auto" src="../../../assets/images/alteer.png" alt="Your Company">
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900"><?php echo $action == "create" ? "Créer" : "Modifier" ?>
                un compte</h2>
        </div>
        <form class="mt-8 space-y-6" method="<?php echo $debug ? "get" : "post" ?>" action="frontController.php">>
            <input type="hidden" name="remember" value="true">
            <div class="-space-y-px rounded-md shadow-sm">
                <div>
                    <label for="login_id" class="sr-only">Identifiant</label>
                    <input type="text"
                           class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" <?php echo !isset($user) ? 'placeholder="jhon77"' : "value='" . htmlspecialchars($user->get('login')) . "'" ?>
                           name="login" id="login_id" <?php echo $action == "create" ? "required" : "readonly" ?> />
                </div>
                <div>
                    <label for="email_id" class="sr-only">Adresse Email</label>
                    <input id="email_id" name="email" type="email" autocomplete="email" required
                           class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        <?php echo !isset($user) ? 'au="jhon.richard77@gmail.com"' : "value='" . htmlspecialchars($user->get('email')) . "'" ?>
                    >
                </div>
                <?php
                if ($action == "create") {
                    ?>
                    <div>
                        <label for="mdp_id" class="sr-only">Mot de passe</label>
                        <input id="mdp_id" name="mdp" type="password" autocomplete="current-password" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>
                    <div>
                        <label for="mdp2_id" class="sr-only">Confirmation du mot de passe</label>
                        <input id="mdp2_id" name="mdp2" type="password" autocomplete="current-password" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>
                    <?php
                } else {
                    ?>
                    <div>
                        <label for="mdp_id" class="sr-only">Nouveau mot de passe</label>
                        <input id="mdp_id" name="mdpN" type="password" autocomplete="current-password" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>
                    <div>
                        <label for="mdp2_id" class="sr-only">Confirmation</label>
                        <input id="mdp2_id" name="mdpC" type="password" autocomplete="current-password" required
                               class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                        >
                    </div>
                    <?php
                }
                ?>

            </div>
            <div>
                <label for="nom_id" class="sr-only">Nom</label>
                <input id="nom_id" name="nom" type="text"
                       autocomplete="email" <?php echo !isset($user) ? 'placeholder="Doo"' : "value='" . htmlspecialchars($user->get('nom')) . "'" ?>
                       required
                       class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="prenom_id" class="sr-only">Prénom</label>
                <input id="prenom_id" name="prenom" type="text" autocomplete="email" required
                       class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" <?php echo !isset($user) ? 'placeholder="John"' : "value='" . htmlspecialchars($user->get('prenom')) . "'" ?>>
            </div>
            <?php
            if ($estAdmin) {
                ?>
                <p>
                    <label for="admin_id" class="sr-only">Admin</label> :
                    <input type="checkbox" name="estAdmin"
                           class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                           id="admin_id" <?php echo $action == "update" ? ($user->get('estAdmin') ? "checked" : "") : ""; ?> />
                </p>
                <?php
            }
            if ($action == "update") {
                ?>
                <p>
                    <label for="mdp_id" class="sr-only">Ancien mot de passe</label>
                    <input type="password"
                           class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                           name="mdp" id="mdp_id" required>
                </p>
                <?php
            }
            ?>

            <div>
                <input type="hidden" name="controller" value="user"/>
                <input type="hidden" name="action" value="<?php echo $action == "create" ? "created" : "updated" ?>"/>
                <button type="submit" value="Envoyer"
                        class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <!-- Heroicon name: mini/lock-closed -->
            <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd"
                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                    clip-rule="evenodd"/>
            </svg>
          </span>
                    S'enregistrer
                </button>
            </div>
        </form>
    </div>
</div>
