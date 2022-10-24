<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?php echo $pageTitle;?></title>
</head>
<body>

<header>
    <nav>
        <a href="frontController.php?action=readAll&controller=composant"> Gestion des composants </a>
        <a href="frontController.php?action=login&controller=user"> Se connecter </a>
    </nav>
</header>

<main>
    <section>
        <?php
            require __DIR__ . "/{$cheminVueBody}";
        ?>
    </section>
</main>

<footer>
    <p id="foot">
        Site de covoiturage de Bakaaa
    </p>
</footer>

</body>
</html>