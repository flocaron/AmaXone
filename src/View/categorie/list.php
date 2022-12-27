<article >
    <?php require __DIR__ . "/../panelAdminNavBar.php"; ?>


    <h2 class="m-4"> 🧔 Liste des catégories 🧔 </h2>

    <ol>
        <?php
        foreach ($categories as $categorie)
            echo '<li> <a href="frontController.php?controller=categorie&action=delete&nom='
                . rawurlencode($categorie->getNom())
                . '" > ❌ </a> <a href="frontController.php?controller=categorie&action=update&nom='
                . rawurlencode($categorie->getNom())
                . '" > ✅ </a> Catégorie '
                . ' <a href=\'frontController.php?controller=categorie&action=read&nom='
                . rawurlencode($categorie->getNom())
                . "'> "
                . htmlspecialchars($categorie->getNom())
                . " </a> "
                . "</li>\n";
        ?>
        <li><a href="frontController.php?action=create&controller=categorie"> Créer une nouvelle categorie </a></li>
    </ol>
</article>

