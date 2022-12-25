<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Config\Conf;
use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\Panier;
use App\E_Commerce\Lib\PreferenceControleur;

abstract class GenericController
{
    protected static function afficheVue(array $parametres = []): void {
        $parametres["msgFlash"] = MessageFlash::lireTousMessages();
        $parametres["estConnecte"] = ConnexionUtilisateur::estConnecte();
        $parametres["estAdmin"] = ConnexionUtilisateur::estAdministrateur();
        $parametres["loginUser"] = ConnexionUtilisateur::getLoginUtilisateurConnecte();
        $parametres["nbPanier"] = Panier::nbPanier();
        $parametres["debug"] = Conf::getDebug();
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/view.php"; // Charge la vue
    }

    public static function welcome() {
        self::afficheVue([
            "pagetitle" => "Bienvenue",
            "cheminVueBody" => "user/welcome.php",
        ]);
    }

    public static function formulairePreference() {
        self::afficheVue([
            "pagetitle" => "Preference",
            "cheminVueBody" => "user/formulairePreference.php",
            "preference" => PreferenceControleur::lire(),
        ]);
    }

    public static function enregistrerPreference() {
        if (isset($_REQUEST['controleur_defaut'])) {
            PreferenceControleur::enregistrer($_REQUEST['controleur_defaut']);
            MessageFlash::ajouter("success", "Préférence choisit !");
            header("Location: frontController.php?action=readAll");
        } else {
            MessageFlash::ajouter("warning", "Préférence non renseignée !");
            header("Location: frontController.php?action=formulairePreference");
        }
    }

    public abstract static function readAll();

    public abstract static function read();

    public abstract static function delete();

    public abstract static function create();

    public abstract static function created();

    public abstract static function update();

    public abstract static function updated();


}