<article id="form">
    <form method="get" action="frontController.php">
        <fieldset>
            <legend>Mon formulaire :</legend>
            <p>
                <label for="login_id">Login</label> :
                <input type="text" placeholder="jhon77" name="login" id="login_id" required/>
            </p>
            <p>
                <label for="email_id">Email</label> :
                <input type="email" placeholder="jhon.richard77@gmail.com" name="email" id="email_id" required/>
            </p>
            <p>
                <label for="mdp_id">Mot de passe</label> :
                <input type="password" name="mdp" id="mdp_id" required>
            </p>
            <p>
                <label for="mdp2_id">Confirmation</label> :
                <input type="password" name="mdp2" id="mdp2_id" required>
            </p>
            <p>
                <label for="nom_id">Nom</label> :
                <input type="text" placeholder="Doo" name="nom" id="nom_id" required/>
            </p>
            <p>
                <label for="prenom_id">Prenom</label> :
                <input type="text" placeholder="John" name="prenom" id="prenom_id" required/>
            </p>
            <?php
            if ($estAdmin) {
                ?>
                <p>
                    <label for="admin_id">Admin</label> :
                    <input type="checkbox" name="estAdmin" id="admin_id"/>
                </p>
                <?php
            }
            ?>
            <p>
                <input type="hidden" name="controller" value="user" />
                <input type="hidden" name="action" value="created" />
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset>
    </form>
</article>

<!-- TODO fusioner create et update views -->