<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../src/CSS/style.css">
    <link rel="icon" type="image/png" href="../src/Icon/icon.jpg">
    <title><?php echo $pagetitle; ?></title>
</head>
<body>

<header>
    <nav>
        <a href="frontController.php?action=readAll&controller=voiture"> Gestion des voitures </a>
        <a href="frontController.php?action=readAll&controller=user"> Gestion des utilisateurs </a>
        <a href="frontController.php?action=readAll&controller=trajet"> Gestion des trajets </a>
        <a href="frontController.php?action=login&controller=user"> Se connecter </a>
    </nav>
</header>

<main>
    <section>
        <?php
            require __DIR__ . "/view.php";
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