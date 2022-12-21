<?php

namespace App\E_Commerce\Lib;

use App\E_Commerce\Model\HTTP\Session;
use App\E_Commerce\Model\Repository\UserRepository;

class Panier
{

    /*
        Session['_panier'] = [
            "id"  => qte,
        ]


     */
    private static string $clePanier = "_panier";

    public static function ajouter(int $idComposant) {
        if (self::exist()) {
            $panier = self::lirePanier();
            if (self::contient($idComposant)) {
                $panier[$idComposant] = $panier[$idComposant] + 1;
            } else {
                $panier[$idComposant] = 1;
            }
        } else {
            $panier = [];
            $panier[$idComposant] = 1;
        }
        Session::getInstance()->enregistrer(static::$clePanier, $panier);
    }

    public static function retirer(int $idComposant) {
        if (self::exist()) {
            if (self::contient($idComposant)) {
                $panier = self::lirePanier();
                if ($panier[$idComposant] == 1) {
                    unset($panier[$idComposant]);
                } else {
                    $panier[$idComposant] = $panier[$idComposant] - 1;
                }
            }
            Session::getInstance()->enregistrer(static::$clePanier, $panier);
        }
    }

    public static function contient(int $idComposant) : bool{
        return isset(self::lirePanier()[$idComposant]);
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

    public static function replacePanier() : void {
        $lastPanier = (new UserRepository)->getLastPanier(ConnexionUtilisateur::getLoginUtilisateurConnecte());
        Session::getInstance()->enregistrer(static::$clePanier, is_null($lastPanier) ? [] : unserialize($lastPanier));
    }

    public static function viderPanier() : void
    {
        Session::getInstance()->supprimer(static::$clePanier);
    }

    public static function enregistrePanier(array $panier = []) : void {
        if (count($panier) == 0) {
            (new UserRepository())->setLastPanier(ConnexionUtilisateur::getLoginUtilisateurConnecte(), serialize(Panier::lirePanier()));
        } else {
            (new UserRepository())->setLastPanier(ConnexionUtilisateur::getLoginUtilisateurConnecte(), serialize($panier));
        }
    }


}