<article >
    <?php require __DIR__ . "/../panelAdminNavBar.php"; ?>


    <h2 class="m-4"> ✉ Liste des commandes ✉ </h2>

    <ol>
        <?php
        foreach ($commandes as $commande)
            echo '<li> <a href="frontController.php?controller=commande&action=delete&id='
                . rawurlencode($commande->getId())
                . '" > ❌ </a> <a href="frontController.php?controller=commande&action=update&id='
                . rawurlencode($commande->getId())
                . '" > ✅ </a> Commande '
                . ' <a href=\'frontController.php?controller=commande&action=read&id='
                . rawurlencode($commande->getId())
                . "'> N°"
                . htmlspecialchars($commande->getId())
                . " </a> "
                . "</li>\n";
        ?>
        <li><a href="frontController.php?action=create&controller=commande"> Créer une nouvelle commande </a></li>
    </ol>
</article>

