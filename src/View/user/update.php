<article id="form">
    <form method="get" action="frontController.php">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="login_id">Login</label> :
                <input type="text" value="<?php echo htmlspecialchars($user->get('login'));?>" name="login" id="login_id" readonly/>
            </p>
            <p>
                <label for="email_id">Email</label> :
                <input type="email" value="<?php echo htmlspecialchars($user->get('email'));?>" name="email" id="email_id" required/>
            </p>
            <p>
                <label for="mdp_id">Nouveau mot de passe</label> :
                <input type="password" name="mdpN" id="mdp_id">
            </p>
            <p>
                <label for="mdp2_id">Confirmation</label> :
                <input type="password" name="mdpC" id="mdp2_id">
            </p>
            <p>
                <label for="nom_id">Nom</label> :
                <input type="text" value="<?php echo htmlspecialchars($user->get('nom'));?>" name="nom" id="nom_id" required/>
            </p>
            <p>
                <label for="prenom_id">Prenom</label> :
                <input type="text" value="<?php echo htmlspecialchars($user->get('prenom'));?>" name="prenom" id="prenom_id" required/>
            </p>
            <?php
            if ($estAdmin) {
                ?>
                <p>
                    <label for="admin_id">Admin</label> :
                    <input type="checkbox" name="estAdmin" id="admin_id" <?php echo $user->get('estAdmin') ? "checked" : ""; ?>/>
                </p>
                <?php
            }
            ?>
            <p>
                <label for="mdp_id">Ancien mot de passe</label> :
                <input type="password" name="mdp" id="mdp_id" required>
            </p>
            <p>
                <input type="hidden" name="controller" value="user" />
                <input type="hidden" name="action" value="updated" />
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>
    </form>
</article>