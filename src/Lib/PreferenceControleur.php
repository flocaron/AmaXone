<?php

namespace App\E_Commerce\Lib;

use App\E_Commerce\Model\HTTP\Cookie;

class PreferenceControleur {

    private static string $clePreference = "preference";

    private static array $controller = ["user", "produit", "commande", "categorie"];

    public static function enregistrer(string $preference) : void
    {
        Cookie::enregistrer(static::$clePreference, $preference);
    }

    public static function lire() : string
    {
        return self::existe() ? (in_array(Cookie::lire(static::$clePreference), static::$controller) ? Cookie::lire(static::$clePreference) : 'user') : 'user';
    }

    public static function existe() : bool
    {
        return Cookie::contient(static::$clePreference);
    }

    public static function supprimer() : void
    {
        Cookie::supprimer(static::$clePreference);
    }
}