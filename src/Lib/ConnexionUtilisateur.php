<?php

namespace App\E_Commerce\Lib;

use App\E_Commerce\Model\HTTP\Session;
use App\E_Commerce\Model\Repository\UserRepository;

class ConnexionUtilisateur
{
    // L'utilisateur connecté sera enregistré en session associé à la clé suivante
    private static string $cleConnexion = "_utilisateurConnecte";

    public static function connecter(string $loginUtilisateur): void
    {
        Session::getInstance()->enregistrer(static::$cleConnexion, (new UserRepository())->select($loginUtilisateur));


        $lastPanier = (new UserRepository)->getLastPanier($loginUtilisateur);
        Panier::replacePanier(is_null($lastPanier) ? [] : unserialize($lastPanier) );
    }

    public static function deconnecter(): void
    {
        (new UserRepository())->setLastPanier(ConnexionUtilisateur::getLoginUtilisateurConnecte(), serialize(Panier::lirePanier()));
        Session::getInstance()->detruire();
        Session::getInstance()->supprimer(static::$cleConnexion);
        MessageFlash::ajouter("success", "Vous-etes deconnecté !");

    }

    public static function estConnecte(): bool
    {
        return Session::getInstance()->contient(static::$cleConnexion);
    }

    public static function getLoginUtilisateurConnecte(): ?string
    {
        return self::estConnecte() ? Session::getInstance()->lire(static::$cleConnexion)->get('login') : null;
    }

    public static function estUtilisateur($login): bool
    {
        return self::estConnecte() && strcmp(self::getLoginUtilisateurConnecte(), $login) == 0;
    }

    public static function estAdministrateur() : bool
    {
        return self::estConnecte() && Session::getInstance()->lire(static::$cleConnexion)->get('estAdmin');
    }

}