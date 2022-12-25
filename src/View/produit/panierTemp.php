<?php
echo "<ul>";
$total = 0;
foreach ($panierProduit as $produitSerialize => $qte) {
    $produit = unserialize($produitSerialize);
    echo "<li> " .
        '<div style="width: 100px; height: 100px">' .
        "<img src='../assets/images/" .
        htmlspecialchars($produit->getImgPath()) .
        "' alt='..' >" .
        "</div> <p>" .
        htmlspecialchars($produit->getLibelle()) .
        " Prix = " .
        htmlspecialchars($produit->getPrix()) .
        "€ Quantité = " .
        $qte .
        "<a href='frontController.php?action=addPanier&controller=produit&id=" .
        rawurlencode($produit->getId()) .
        "'> addOne </a>" .
        "<a href='frontController.php?action=removePanier&controller=produit&id=" .
        rawurlencode($produit->getId()) .
        "'> rmOne </a>";

    echo "<form style='display: inline;' method='" .
        ($debug ? "get" : "post") .
        "' action='frontController.php'> " .
        " <select name='qte'> ";

    for ($i = 1; $i < 100; $i++) {
        echo "<option value='$i' " . ($i == $qte ? "selected" : "") . " > $i </option>";
    }

    echo " </select> " .
        "<input type='hidden' name='action' value='addAllPanier' />" .
        "<input type='hidden' name='controller' value='produit' />" .
        "<input type='hidden' name='id' value='" . htmlspecialchars($produit->getId()) . "' />" .
        "<input type='submit' value='addAll' />" .
        "</form>";

    echo "<a href='frontController.php?action=removeAllPanier&controller=produit&id=" .
        rawurlencode($produit->getId()) .
        "'> rmAll </a>" .
        "</p> </li>\n";

    $total += $produit->getPrix() * $qte;

}
echo "</ul>";
echo "<p> Total = " . $total . "€ </p>";
echo "<p> <a href='frontController.php?action=viderPanier&controller=produit'> Vider Panier </a> </p>";
if ($estConnecte) {
    echo "<p> <a href='frontController.php?action=replacePanier&controller=produit'> Recuperer Panier </a> </p>";
    echo "<p> <a href='frontController.php?action=passerCommande&controller=commande'> Passer Commande </a> </p>";
} else {
    echo "<p> <a href='frontController.php?action=login&controller=user'> Passer Commande </a> </p>";
}

// si pas connecte affiche lien vers login page
// puis redirection vers passerCommande
