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
         htmlspecialchars($composant->getLibelle())  .
         " Prix = " .
         htmlspecialchars($composant->getPrix())  .
         " Quantité = " .
         $qte .
         "<a href='frontController.php?action=addPanier&controller=composant&id=" .
         rawurlencode($composant->getId()) .
         "'> add </a>" .
         "<a href='frontController.php?action=removePanier&controller=composant&id=" .
         rawurlencode($composant->getId()) .
         "'> rm </a>" .
    "</p> </li>\n";

     $total += $composant->getPrix() * $qte;

 }
echo "</ul>";
echo "<p> Total = " . $total . " </p>";
echo "<p> <a href='frontController.php?action=viderPanier&controller=composant'> Vider Panier </a> </p>";