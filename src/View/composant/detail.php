<h3> Détail de  <?php echo htmlspecialchars($composant->getId()); ?> : </h3>

<article>
    <?php
        echo "<p> Libelle = " . htmlspecialchars($composant->getLibelle()) . " </p>\n";
        echo "<p> Prix = " . htmlspecialchars($composant->getPrix()) . " </p>\n";
        echo "<p> ImgPath = " . htmlspecialchars($composant->getImgPath()) . " </p>\n";
        echo "<p> Description = " . htmlspecialchars($composant->getDescription()) . " </p>\n";
        echo "<div class='mt-5'>";
            echo "<p><a href='frontController.php?controller=composant&action=delete&id=" . rawurlencode($composant->getId()) . "' > supprimer </a></p>";
            echo "<p><a href='frontController.php?controller=composant&action=update&id=" . rawurlencode($composant->getId()) . "' > modifier </a></p>";
        echo "</div>";
    ?>

</article>

