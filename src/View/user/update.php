<article id="form">
    <form method="get" action="frontController.php">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="login_id">Login</label> :
                <input type="text" value="<?php echo htmlspecialchars($user->get('login'));?>" name="login" id="login_id" readonly/>
            </p>
            <p>
                <label for="nom_id">Nom</label> :
                <input type="text" value="<?php echo htmlspecialchars($user->get('nom'));?>" name="nom" id="nom_id" required/>
            </p>
            <p>
                <label for="prenom_id">Prenom</label> :
                <input type="text" value="<?php echo htmlspecialchars($user->get('prenom'));?>" name="prenom" id="prenom_id" required/>
            </p>
            <p>
                <input type="hidden" name="controller" value="user" />
                <input type="hidden" name="action" value="updated" />
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>
    </form>
</article>