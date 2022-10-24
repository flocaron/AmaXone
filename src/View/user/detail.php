<h3> Détail de  <?php echo htmlspecialchars($user->get('login')); ?> : </h3>

<article>
    <?php
        echo "<p> Login = " . htmlspecialchars($user->get('login')) . " </p>\n";
        echo "<p> Email = " . htmlspecialchars($user->get('email')) . " </p>\n";
        echo "<p> Nom = " . htmlspecialchars($user->get('nom')) . " </p>\n";
        echo "<p> Prenom = " . htmlspecialchars($user->get('prenom')) . " </p>\n";
    ?>
</article>

