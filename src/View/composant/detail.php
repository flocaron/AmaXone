<h3> Détail de  <?php echo htmlspecialchars($composant->getID()); ?> : </h3>

<article>
    <?php
        echo "<p> Libelle = " . htmlspecialchars($composant->getLibelle()) . " </p>\n";
        echo "<p> Prix = " . htmlspecialchars($composant->getPrix()) . " </p>\n";
        echo "<p> ImgPath = " . htmlspecialchars($composant->getImgPath()) . " </p>\n";
        echo "<p> Description = " . htmlspecialchars($composant->getDescription()) . " </p>\n";
    ?>
</article>

