<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/jpg" href="../assets/images/alteer.png"/>
    <link rel="stylesheet" href="../assets/CSS/style.css"/>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.2.4/dist/cdn.min.js"></script>
    <title><?php echo $pagetitle; ?></title>
</head>
<body>
<header>
    <nav class="bg-gray-800 z-5">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img src="../assets/images/alteer.png" alt="..."
                             class="block aspect-auto object-cover h-10 w-auto">
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="frontController.php"
                               class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                               aria-current="page">Accueil</a>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <a href="frontController.php?action=affichePanier&controller=composant"
                               class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                               aria-current="page">Panier</a>
                        </div>
                    </div>
                    <?php
                    if (!$estConnecte) {
                        ?>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <a href="frontController.php?action=login&controller=user"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Se connecter</a>
                            </div>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <a href="frontController.php?action=read&controller=user&login=<?php echo rawurlencode($loginUser); ?>"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Profil</a>
                            </div>
                        </div>
                        <?php
                        if ($estAdmin) {
                            ?>
                            <div class="hidden sm:ml-6 sm:block">
                                <div class="flex space-x-4">
                                    <a href="frontController.php?action=readAll&controller=user"
                                       class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                       aria-current="page">Panel Admin</a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="hidden sm:ml-6 sm:block">
                            <div class="flex space-x-4">
                                <a href="frontController.php?action=logout&controller=user"
                                   class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                   aria-current="page">Deconnecter</a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>
</header>
<main>
    <section>
        <p>
            <?php
            foreach ($msgFlash as $type => $subTab) {
                foreach ($subTab as $msg) {
                    echo "<div class='alert alert-$type'> $msg </div>";
                }
            }
            ?>
        </p>
    </section>
    <section>
        <?php
        require __DIR__ . "/{$cheminVueBody}";
        ?>
    </section>
</main>
<footer>
    <p style="text-align: right;"> E-Commerce Site of CARON Florimond and COPLEY Dimitri </p>
    <div>
        <div>
            <a href="frontController.php"> Page d’accueil </a>
        </div>
        <div>
            <a href="#"> Politique de confidentialité </a>
        </div>
    </div>
</footer>
</body>
</html>