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
        "'> add </a>";

    echo "<form style='display: inline;' method='" .
        ($debug ? "get" : "post") .
        "' action='frontController.php'> " .
        " <select name='qte'> ";

    echo "<option value='$qte' > $qte </option>";
    for ($i = 1; $i < 100; $i++) {
        if ($i == $qte) {
            continue;
        }
        echo "<option value='$i' > $i </option>";
    }

    echo " </select> " .
        "<input type='hidden' name='action' value='addAllPanier' />" .
        "<input type='hidden' name='controller' value='produit' />" .
        "<input type='hidden' name='id' value='" . htmlspecialchars($produit->getId()) . "' />" .
        "<input type='submit' value='addAll' />" .
        "</form>";

    echo "<a href='frontController.php?action=removePanier&controller=produit&id=" .
        rawurlencode($produit->getId()) .
        "'> rm </a>" .
        "<a href='frontController.php?action=removeAllPanier&controller=produit&id=" .
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
}
