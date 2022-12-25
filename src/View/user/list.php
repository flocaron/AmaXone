<article >
    <div class="flex m-3">
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=user"> Utilisateurs </a></div>
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=produit"> Produits </a></div>
        <div class="ml-5"> <a href="frontController.php?action=readAll&controller=commande"> Commandes </a></div>
    </div>


    <h2 class="m-4"> 🧔 Liste des utilisateurs 🧔 </h2>

    <ol>
        <?php
        foreach ($users as $user)
            echo '<li> <a href="frontController.php?controller=user&action=delete&login='
                . rawurlencode($user->get('login'))
                . '" > ❌ </a> <a href="frontController.php?controller=user&action=update&login='
                . rawurlencode($user->get('login'))
                . '" > ✅ </a> Utilisateurs de login <a href=\'frontController.php?controller=user&action=read&login='
                . rawurlencode($user->get('login'))
                . "'><span "
                . ($user->get('estAdmin') ? "style='color: red;'" : "")
                . " >"
                . htmlspecialchars($user->get('login'))
                . '</span> </a>.</li>'
                . "\n";
        ?>
        <li><a href="frontController.php?action=create&controller=user"> Créer un nouvel utilisateur </a></li>
    </ol>
</article>

