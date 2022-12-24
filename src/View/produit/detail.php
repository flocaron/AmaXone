<h3> Détail de <?php echo htmlspecialchars($produit->getId()); ?> : </h3>

<article>
    <?php
    echo "<p> Libelle = " . htmlspecialchars($produit->getLibelle()) . " </p>\n";
    echo "<p> Prix = " . htmlspecialchars($produit->getPrix()) . " </p>\n";
    echo "<p> ImgPath = " . htmlspecialchars($produit->getImgPath()) . " </p>\n";
    echo "<p> Description = " . htmlspecialchars($produit->getDescription()) . " </p>\n";
    if ($estAdmin) {
        echo "<div class='mt-5'>" .
            "<a href='frontController.php?controller=produit&action=delete&id=" . rawurlencode($produit->getId()) . "' > ❌ </a>" .
            "<a href='frontController.php?controller=produit&action=update&id=" . rawurlencode($produit->getId()) . "' > ✅ </a>" .
            "</div>";
    }
    ?>

</article>

