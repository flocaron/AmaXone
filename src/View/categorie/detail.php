<h3> Détail de <?php echo htmlspecialchars($categorie->getNom()); ?> : </h3>

<article>
    <?php
    echo "<p> Nom = " . htmlspecialchars($categorie->getNom()) . " </p>\n";
    echo "<p> Description = " . htmlspecialchars($categorie->getDescription()) . " </p>\n";
    echo "<p> Image Path = " . htmlspecialchars($categorie->getImgPath()) . " </p>\n";

    if ($estAdmin) {
        echo "<div class='mt-5'>" .
            "<a href='frontController.php?controller=categorie&action=delete&nom=" . rawurlencode($categorie->getNom()) . "' > ❌ </a>" .
            "<a href='frontController.php?controller=categorie&action=update&nom=" . rawurlencode($categorie->getNom()) . "' > ✅ </a>" .
            "</div>";
    }
    ?>
</article>

