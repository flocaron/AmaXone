<article >
    <div class="flex m-3">
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=user"> Utilisateurs </a></div>
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=produit"> Produits </a></div>
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=commande"> Commandes </a></div>
    </div>


    <h2> 🧔 Liste des commandes 🧔 </h2>

    <ol>
        <?php
        foreach ($commandes as $commande)
            echo '<li> <a href="frontController.php?controller=commande&action=delete&id='
                . rawurlencode($commande->getId())
                . '" > ❌ </a> <a href="frontController.php?controller=commande&action=update&id='
                . rawurlencode($commande->getId())
                . '" > ✅ </a> Commande '
                . " de "
                . htmlspecialchars($commande->getUserLogin())
                . " le "
                . ' <a href=\'frontController.php?controller=commande&action=read&id='
                . rawurlencode($commande->getId())
                . "'> "
                . htmlspecialchars($commande->getDate())
                . " </a> "
                . "</li>\n";
        ?>
        <li><a href="frontController.php?action=create&controller=commande"> Créer une nouvelle commande </a></li>
    </ol>
</article>

