<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>TEST</title>
</head>
<body>

<header>
    <nav>
        <h1 class="text-3xl font-bold underline">
            Hello world!
        </h1>
        <a href="frontController.php?action=readAll&controller=voiture"> Gestion des voitures </a>
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