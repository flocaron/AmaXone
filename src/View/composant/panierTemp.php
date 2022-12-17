<?php
echo "<ul>";
$total = 0;
foreach ($panierComposant as $composantSerialize => $qte) {
     $composant = unserialize($composantSerialize);
     echo "<li> " .
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
    "</li>";

     $total += $composant->getPrix() * $qte;

 }
echo "</ul>";
echo "Total = " . $total;
