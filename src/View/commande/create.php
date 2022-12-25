<article>
    <form method="<?php echo $debug ? "get" : "post" ?>" action="frontController.php">
        <fieldset>
            <legend><?php echo $action == "create" ? "Création" : "Modification" ?> d'une commande :</legend>
            <?php
            if ($action == "update") {
                ?>
                <p>
                    <label for="id_id">ID</label> :
                    <input type="text" value='<?php echo htmlspecialchars($commande->getId()) ?>' name="id" id="id_id"
                           readonly/>
                </p>
                <?php
            }
            ?>
            <?php //echo !isset($commande) ? 'placeholder="jhon77"' : "value='" . htmlspecialchars($commande->getUserLogin()) . "'" ?>

            <p>
                <label for="date_id">Date</label> :
                <input type="date" value='<?php echo htmlspecialchars($commande->getId()) ?>' name="date" id="date_id"
                       required/>
            </p>
            <p>
                <label for="statut_id">Statut</label> :
                <input type="text" value='<?php echo htmlspecialchars($commande->getStatut()) ?>' name="statut" id="statut_id"
                       required/>
            </p>
            <p>
                <label for="login_id">Login</label> :
                <input type="text" value='<?php echo htmlspecialchars($commande->getUserLogin()) ?>' name="date" id="date_id"
                       required/>
            </p>


            <p>
                <input type="hidden" name="controller" value="commande"/>
                <input type="hidden" name="action" value="<?php echo $action == "create" ? "created" : "updated" ?>"/>
                <input type="submit" value="Envoyer"/>
            </p>
        </fieldset>
    </form>
</article>
