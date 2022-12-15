<?php

namespace App\E_Commerce\Lib;

use App\E_Commerce\Model\HTTP\Cookie;

class PreferenceControleur {

    private static string $clePreference = "preference";

    public static function enregistrer(string $preference) : void
    {
        Cookie::enregistrer(static::$clePreference, $preference);
    }

    public static function lire() : string
    {
        return self::existe() ? Cookie::lire(static::$clePreference) : 'user';
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