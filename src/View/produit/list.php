<article >
    <div class="flex m-3">
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=user"> Utilisateurs </a></div>
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=produit"> Produits </a></div>
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=commande"> Commandes </a></div>
    </div>


    <h2 class="m-4"> 🧔 Liste des produits 🧔 </h2>

    <ol>
        <?php
        foreach ($produits as $produit)
            echo '<li> <a href="frontController.php?controller=produit&action=delete&id='
                . rawurlencode($produit->getId())
                . '" > ❌ </a> <a href="frontController.php?controller=produit&action=update&id='
                . rawurlencode($produit->getId())
                . '" > ✅ </a> Produit <a href=\'frontController.php?controller=produit&action=read&id='
                . rawurlencode($produit->getId())
                . "'> "
                . htmlspecialchars($produit->getLibelle())
                . " </a></li>\n";
        ?>
        <li><a href="frontController.php?action=create&controller=produit"> Créer un nouveau produit </a></li>
    </ol>
</article>

