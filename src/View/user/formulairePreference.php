<article>
    <form action="frontController.php" method="<?php echo $debug ? "get" : "post" ?>" >
        <fieldset class="m-5">
            <legend> Préférence :</legend>

            <div class="flex m-5">
                <div class="ml-3">
                    <input type="radio" name="controleur_defaut" value="user" id="user_id" <?php echo $preference == "user" ? "checked" : "" ?> />
                    <label for="user_id">Utilisateurs</label>
                </div>
                <div class="ml-3">
                    <input type="radio" name="controleur_defaut" value="produit" id="produit_id" <?php echo $preference == "produit" ? "checked" : "" ?> />
                    <label for="produit_id">Produits</label>
                </div>
                <div class="ml-3">
                    <input type="radio" name="controleur_defaut" value="commande" id="commande_id" <?php echo $preference == "commande" ? "checked" : "" ?> />
                    <label for="commande_id">Commandes</label>
                </div>
                <div class="ml-3">
                    <input type="radio" name="controleur_defaut" value="categorie" id="categorie_id" <?php echo $preference == "categorie" ? "checked" : "" ?> />
                    <label for="categorie_id">Catégories</label>
                </div>
            </div>

            <p>
                <input type="hidden" name="action" value="enregistrerPreference"/>
                <input type="submit" value="Envoyer"/>
            </p>

        </fieldset>
    </form>
</article>

