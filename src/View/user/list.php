<h2> 🧔 Liste des utilisateurs 🧔 </h2>

<article>
    <ol>
        <?php
        foreach ($users as $user)
            echo '<li> <a href="frontController.php?controller=user&action=delete&login='
                . rawurlencode($user->get('login'))
                . '" > ❌ </a> <a href="frontController.php?controller=user&action=update&login='
                . rawurlencode($user->get('login'))
                . '" > ✅ </a> Utilisateurs de login <a href=\'frontController.php?controller=user&action=read&login='
                . rawurlencode($user->get('login'))
                . "'>"
                . htmlspecialchars($user->get('login'))
                . '</a>.</li>'
                . "\n";
        ?>
        <li> <a href="frontController.php?action=create&controller=user"> Créer un nouvel utilisateur </a> </li>
    </ol>
</article>

