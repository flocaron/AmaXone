<article>
    <form method="<?php echo $debug ? "get" : "post" ?>" action="frontController.php">
        <fieldset> Formulaire de Paiement </fieldset>

        <p>
            <label for="nom_id"> Nom de la carte </label>
            <input id="nom_id" type="text" name="nom" value="<?= htmlspecialchars($val['nom']) ?>" required />
        </p>
        <p>
            <label for="num_id"> Numéro de la carte </label>
            <input id="num_id" type="number" name="num" value="<?= htmlspecialchars($val['num']) ?>" required />
        </p>
        <p>
            <label for="date_id"> Date d'expiration </label>
            <input id="date_id" type="date" name="date" value="<?= htmlspecialchars($val['date']) ?>" required />
        </p>
        <p>
            <label for="crypto_id"> Cryptogramme </label>
            <input id="crypto_id" type="number" name="crypto" value="<?= htmlspecialchars($val['crypto']) ?>" required />
        </p>
        <p>
            <label for="sur_id"> Etes-vous sur ? </label>
            <input id="sur_id" type="checkbox" name="sur" required />
        </p>
        <p> Total :  <?= $total ?> €</p>
        <p>
            <input type="hidden" name="action" value="validerCommande" />
            <input type="hidden" name="controller" value="commande" />
            <input type="submit" value="Commander" />
        </p>
    </form>