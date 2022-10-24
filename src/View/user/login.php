<article id="form">
    <form action="frontController.php" method="get">
        <fieldset>
            <legend>  Se connecter : </legend>
            <p>
                <label for="login_id">Login</label> :
                <input type="text" name="login" id="login_id" required/>
            </p>
            <p>
                <label for="mdp_id">Mot de passe</label> :
                <input type="password" name="mdp" id="mdp_id" required/>
            </p>

            <p>

                <input type="submit" value="se connecter"/>
            </p>
        </fieldset>
    </form>
</article>