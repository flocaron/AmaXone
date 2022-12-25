<h3> Détail de <?php echo htmlspecialchars($commande->getId()); ?> : </h3>

<article>
    <?php
    echo "<p> Date = " . htmlspecialchars($commande->getDate()) . " </p>\n";
    echo "<p> Statut = " . htmlspecialchars($commande->getStatut()) . " </p>\n";
    echo "<p> Login = " . htmlspecialchars($commande->getUserLogin()) . " </p>\n";

    if ($estAdmin) {
        echo "<div class='mt-5'>" .
            "<a href='frontController.php?controller=commande&action=delete&id=" . rawurlencode($commande->getId()) . "' > ❌ </a>" .
            "<a href='frontController.php?controller=commande&action=update&id=" . rawurlencode($commande->getId()) . "' > ✅ </a>" .
            "</div>";
    }
    ?>

    <h4> Produits commandés : </h4>
    <?php
    echo "<ul>";
    $total = 0;
    foreach ($produitCommande as $produitSerialize => $qte) {
        $produit = unserialize($produitSerialize);
        echo "<li> " .
            htmlspecialchars($produit->getLibelle()) .
            " Prix = " .
            htmlspecialchars($produit->getPrix()) .
            "€ Quantité = $qte </li>";

        $total += $produit->getPrix() * $qte;
    }
    echo "</ul>";
    echo "<p> Total = " . $total . "€ </p>";

    ?>

</article>

