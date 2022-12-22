<?php
echo "<ul>";
$total = 0;
foreach ($panierComposant as $composantSerialize => $qte) {
    $composant = unserialize($composantSerialize);
    echo "<li> " .
        '<div style="width: 100px; height: 100px">' .
        "<img src='../assets/images/" .
        htmlspecialchars($composant->getImgPath()) .
        "' alt='..' >" .
        "</div> <p>" .
        htmlspecialchars($composant->getLibelle()) .
        " Prix = " .
        htmlspecialchars($composant->getPrix()) .
        "€ Quantité = " .
        $qte .
        "<a href='frontController.php?action=addPanier&controller=composant&id=" .
        rawurlencode($composant->getId()) .
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
        "<input type='hidden' name='controller' value='composant' />" .
        "<input type='hidden' name='id' value='" . htmlspecialchars($composant->getId()) . "' />" .
        "<input type='submit' value='addAll' />" .
        "</form>";

    echo "<a href='frontController.php?action=removePanier&controller=composant&id=" .
        rawurlencode($composant->getId()) .
        "'> rm </a>" .
        "<a href='frontController.php?action=removeAllPanier&controller=composant&id=" .
        rawurlencode($composant->getId()) .
        "'> rmAll </a>" .
        "</p> </li>\n";

    $total += $composant->getPrix() * $qte;

}
echo "</ul>";
echo "<p> Total = " . $total . "€ </p>";
echo "<p> <a href='frontController.php?action=viderPanier&controller=composant'> Vider Panier </a> </p>";
if ($estConnecte) {
    echo "<p> <a href='frontController.php?action=replacePanier&controller=composant'> Recuperer Panier </a> </p>";
}
