<h3> Détail de  <?php echo htmlspecialchars($user->get('login')); ?> : </h3>

<article>
    <?php
        echo "<p> Login = " . htmlspecialchars($user->get('login')) . " </p>\n";
        echo "<p> Email = " . htmlspecialchars($user->get('email')) . " </p>\n";
        if ($estAdmin) {
            echo "<p> EmailAValider = " . htmlspecialchars($user->get('emailAValider')) . " </p>\n";
            echo "<p> Nonce = " . htmlspecialchars($user->get('nonce')) . " </p>\n";
        }
        echo "<p> Nom = " . htmlspecialchars($user->get('nom')) . " </p>\n";
        echo "<p> Prenom = " . htmlspecialchars($user->get('prenom')) . " </p>\n";

        echo '<p> <a href="frontController.php?controller=user&action=delete&login='
                . rawurlencode($user->get('login'))
                . '" > ❌ </a> <a href="frontController.php?controller=user&action=update&login='
                . rawurlencode($user->get('login'))
                . '" > ✅ </a> </p>';
        ?>

        <div class="mt-5"> Historique des commandes :

        <?php
        /*
        foreach ($commandes as $commande) {
            echo "<p> Commande <a href='frontController.php?action=read&controller=commande&id=" .
                rawurlencode($commande->getId()) .
                "'> " .
                htmlspecialchars($commande->getId()) .
                "</a> du " .
                htmlspecialchars($commande->getDate()) .
                " </p>";
        }
        */

        foreach ($commandes as $commandeSerialize => $tab ) {
            $commande = unserialize($commandeSerialize);
            echo "<p class='mt-4'> <div> Commande " . htmlspecialchars($commande->getId()) . " du " . htmlspecialchars($commande->getDate()) . ", avec les produits suivants :</div>";
            $total = 0;
            foreach ($tab as $tabProduit) {
                foreach ($tabProduit as $produitSerialize => $qte ) {
                    $produit = unserialize($produitSerialize);
                    echo "<div> -> "
                        . htmlspecialchars($produit->getLibelle())
                        . " "
                        . htmlspecialchars($produit->getPrix())
                        . "€ x$qte </div>";
                    $total += $produit->getPrix() * $qte;
                }
            }
            echo "<div> Total = {$total}€</div>";
            echo "</p>";

        }


    ?>
        </div>
</article>

