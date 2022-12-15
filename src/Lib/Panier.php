<?php

namespace App\E_Commerce\Lib;

use App\E_Commerce\Model\HTTP\Session;

class Panier
{
    private static string $clePanier = "_panier";

    public static function ajouter(int $idComposant) {
        if (self::exist()) {
            $panier = self::lirePanier();
        } else {
            $panier = [];
        }
        $panier[] = $idComposant;
        Session::getInstance()->enregistrer(static::$clePanier, $panier);
    }

    public static function retirer(int $idComposant) {
        if (self::exist()) {
            $panier = self::lirePanier();
            if (($key = array_search($idComposant, $panier)) !== false) {
                unset($panier[$key]);
            }
            Session::getInstance()->enregistrer(static::$clePanier, $panier);
        }
    }

    public static function exist() : bool {
        return Session::getInstance()->contient(static::$clePanier);
    }

    public static function lirePanier() : array {
        if (self::exist()) {
            return Session::getInstance()->lire(static::$clePanier);
        }
        return [];
    }


}