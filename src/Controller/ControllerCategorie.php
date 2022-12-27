<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Model\Repository\CategorieRepository;

class ControllerCategorie extends GenericController
{

    protected static function getNomController(): string
    {
        return "categorie";
    }

    public static function read()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['nom'])) {
                $categorie = (new CategorieRepository())->select($_REQUEST['nom']);
                if (is_null($categorie)) {
                    MessageFlash::ajouter("warning", "Nom non trouvé !!");
                    header("Location: frontController.php?action=readAll&controller=produit");
                } else {
                    self::afficheVue([
                        'categorie' => $categorie,
                        "pagetitle" => "Détail de {$categorie->getNom()}",
                        "cheminVueBody" => "categorie/detail.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Nom non renseigné !!");
                header("Location: frontController.php?action=readAll&controller=produit"); // TODO modif redirection vers vue catalogueCategorie
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function delete()
    {
        // TODO: Implement delete() method.
    }

    public static function create()
    {
        // TODO: Implement create() method.
    }

    public static function created()
    {
        // TODO: Implement created() method.
    }

    public static function update()
    {
        // TODO: Implement update() method.
    }

    public static function updated()
    {
        // TODO: Implement updated() method.
    }
}