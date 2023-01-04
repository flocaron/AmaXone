<!DOCTYPE html>
<html class="scroll-smooth bg-gray-800" lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpg" href="../assets/images/alteer.png"/>
    <link rel="stylesheet" href="../assets/CSS/style.css"/>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
    <title><?php use App\E_Commerce\Lib\MessageFlash;

        echo $pagetitle; ?></title>
</head>
<body class="bg-white">
<header>
    <nav class=" sticky bg-gray-800 z-40 w-full">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8 items-center">
            <div class="relative flex h-16 items-center justify-around">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <a href="frontController.php">
                        <img src="../assets/images/alteer.png" alt="..."
                             class="block aspect-auto object-cover h-10 w-auto">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block items-center">
                        <div class="flex space-x-4 mt-4 items-center">
                            <a href="frontController.php?action=catalogue&controller=categorie"
                               class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                               aria-current="page">Catalogue</a>
                        </div>
                    </div>
                    <?php
                    if ($estAdmin && $estConnecte) { ?>
                        <div class="hidden sm:ml-6 sm:block items-center">
                            <div class="flex space-x-4 mt-4 items-center">
                                <a href="frontController.php?action=readAll"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Panel Admin</a>
                            </div>
                        </div>
                        <div class="hidden sm:ml-6 sm:block items-center">
                            <div class="flex space-x-4 mt-4 items-center">
                                <a href="frontController.php?action=formulairePreference"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Preference Controller</a>
                            </div>
                        </div>
                        <?php
                    } ?>
                    <?php
                    if (!$estConnecte) {
                        ?>
                        <div class="hidden sm:ml-6 sm:block items-center">
                            <div class="flex space-x-4 mt-4 items-center">
                                <a href="frontController.php?action=login&controller=user"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Se connecter</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="hidden sm:ml-6 sm:block items-center">
                            <div class="flex space-x-4 mt-4 items-center">
                                <a href="frontController.php?action=read&controller=user&login=<?php echo rawurlencode($loginUser); ?>"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Profil</a>
                            </div>
                        </div>
                        <div class="hidden sm:ml-6 sm:block items-center">
                            <div class="flex space-x-4 mt-4 items-center">
                                <a href="frontController.php?action=logout&controller=user"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Se Deconnecter</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="inline-flex relative">
                            <div class="absolute inline-block top-2 left-4 bottom-auto translate-x-3/4 -translate-y-1/2 rotate-0 skew-x-0 skew-y-0 scale-x-100 scale-y-100 py-1 px-2.5 text-xs leading-none text-center whitespace-nowrap align-baseline font-bold bg-indigo-700 text-white rounded-full z-10"><?php echo $nbPanier ?></div>
                            <a href="frontController.php?action=affichePanier&controller=produit"
                               class="inline-block px-7 py-3 leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                <img src="../assets/images/cart.jpeg" alt="..."
                                     class=" mt-2 block aspect-auto object-cover h-8 rounded-full w-auto"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<main>
    <section>
        <?php foreach ($msgFlash as $type => $subTab) {
            foreach ($subTab as $msg) { ?>
                <div class="flex bottom-20 left-10 fixed z-40" role="alert">
                    <div class="m-auto">
                        <div class="transition ease-in-out delay-150 bg-white hover:-translate-y-1 hover:text-white hover:scale-110 hover:bg-blue-600 duration-300 rounded-lg border-gray-300 border p-3 shadow-lg">
                            <div class="flex flex-row">
                                <div class="px-2">
                                    <img src="../assets/images/icons/<?php echo $type?>.png" alt="..."
                                         class=" mt-2 block aspect-auto object-cover h-8 rounded-full w-auto">
                                </div>
                                <div class="ml-2 mr-6">
                                    <span class="font-semibold"><?php echo $msg ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </section>
    <section>
        <?php
        require __DIR__ . "/{$cheminVueBody}";
        ?>
    </section>
</main>
<footer class="relative w-full bottom-0 z-5 text-center">
    <div class="bg-gray-800 text-center p-4 text-white">
        <h6>
            © 2022 Copyright: Florimond Caron & Dimitri Copley
        </h6>
    </div>
</footer>
</body>
</html>