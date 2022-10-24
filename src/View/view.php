<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"> </script>
    <title><?php echo $pagetitle;?></title>
</head>
<body>

<header>
    <nav>
        <a href="frontController.php"> Accueil </a>
        <a href="frontController.php?action=readAll&controller=user"> Gestion des utilisateurs </a>
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
       <h3 class="font-normal hover:font-bold">AmaXone ™ Inc.</h3>
    </p>
</footer>

</body>
</html>