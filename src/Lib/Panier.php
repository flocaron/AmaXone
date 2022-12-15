<?php

namespace App\Covoiturage\Lib;

use App\Covoiturage\Model\HTTP\Session;

class Panier
{
    private static string $clePanier = "_panier";

    public static function ajouter(int $idComposant) {
        $panier = self::lirePanier();
        $panier[] = $idComposant;
        Session::getInstance()->enregistrer(static::$clePanier, $panier);
    }

    public static function retirer(int $idComposant) {
        $panier = self::lirePanier();
        if (($key = array_search($idComposant, $panier)) !== false) {
            unset($panier[$key]);
        }
        Session::getInstance()->enregistrer(static::$clePanier, $panier);
    }

    public static function lirePanier() : array {
        return Session::getInstance()->lire(static::$clePanier);
    }


}