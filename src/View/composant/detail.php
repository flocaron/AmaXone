<h3> Détail de <?php echo htmlspecialchars($composant->getId()); ?> : </h3>

<article>
    <?php
    echo "<p> Libelle = " . htmlspecialchars($composant->getLibelle()) . " </p>\n";
    echo "<p> Prix = " . htmlspecialchars($composant->getPrix()) . " </p>\n";
    echo "<p> ImgPath = " . htmlspecialchars($composant->getImgPath()) . " </p>\n";
    echo "<p> Description = " . htmlspecialchars($composant->getDescription()) . " </p>\n";
    if ($estAdmin) {
        echo "<div class='mt-5'>" .
            "<a href='frontController.php?controller=composant&action=delete&id=" . rawurlencode($composant->getId()) . "' > ❌ </a>" .
            "<a href='frontController.php?controller=composant&action=update&id=" . rawurlencode($composant->getId()) . "' > ✅ </a>" .
            "</div>";
    }
    ?>

</article>

