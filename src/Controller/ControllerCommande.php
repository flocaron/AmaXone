<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\Panier;
use App\E_Commerce\Model\DataObject\Commande;
use App\E_Commerce\Model\Repository\CommandeRepository;
use App\E_Commerce\Model\Repository\UserRepository;

class ControllerCommande extends GenericController
{

    protected static function getNomController(): string
    {
        return "commande";
    }

    public static function read()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id'])) {
                $commande = (new CommandeRepository)->select($_REQUEST['id']);
                if (is_null($commande)) {
                    MessageFlash::ajouter("warning", "id non trouvé !!");
                    header("Location: frontController.php?action=readAll&controller=produit");
                } else {
                    self::afficheVue([
                        "produits" => (new CommandeRepository())->getProduitParCommande($_REQUEST['id']),
                        'commande' => $commande,
                        "pagetitle" => "Détail de {$commande->getId()}",
                        "cheminVueBody" => "commande/detail.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "id non renseigné !!");
                header("Location: frontController.php?action=readAll&controller=produit");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }

    }


    public static function delete()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id'])) {
                if (isset($_REQUEST['verif'])) {
                    $bool = (new CommandeRepository())->delete($_REQUEST['id']);
                    if ($bool) {
                        MessageFlash::ajouter("success", "Commande bien supprimé !");
                    } else {
                        MessageFlash::ajouter("warning", "ID non trouvé !!");
                    }
                } else {
                    MessageFlash::ajouter("info", "Etes-vous sur ? " .
                        " <a href='frontController.php?action=delete&controller=commande&id=" .
                        rawurlencode($_REQUEST['id']) . "&verif'> oui </a> " .
                        " <a href='frontController.php?action=readAll&controller=commande'> non</a>"
                    );
                }
            } else {
                MessageFlash::ajouter("danger", "ID non renseigné !!");
            }
            header("Location: frontController.php?action=readAll&controller=commande");
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function update()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id'])) {
                $commande = (new CommandeRepository)->select($_REQUEST['id']);
                if (is_null($commande)) {
                    MessageFlash::ajouter("warning", "ID non trouvé !!");
                    header("Location: frontController.php?action=readAll&controller=commande");
                } else {
                    self::afficheVue([
                        "commande" => $commande,
                        "action" => "update",
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Modifier commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "id non renseigné !!");
                header("Location: frontController.php?action=readAll&controller=commande");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function create()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            self::afficheVue([
                "action" => "create",
                "users" => (new UserRepository())->selectAll(),
                "pagetitle" => "Créer Commande",
                "cheminVueBody" => "commande/create.php",
            ]);
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function updated()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id']) && isset($_REQUEST['date']) && isset($_REQUEST['statut']) && isset($_REQUEST['userLogin'])) {
                $commande = new Commande();
                $commande->setId($_REQUEST['id']);
                $commande->setDate($_REQUEST['date']);
                $commande->setStatut($_REQUEST['statut']);
                $commande->setUserLogin($_REQUEST['userLogin']);
                $bool = (new CommandeRepository())->update($commande);
                if ($bool) {
                    MessageFlash::ajouter("success", "Commande bien modifié !");
                    header("Location: frontController.php?controller=commande&action=readAll");
                } else {
                    MessageFlash::ajouter("warning", "ID non trouvé !!");
                    self::afficheVue([
                        "commande" => $commande,
                        "action" => "update",
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Modifier commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "ID non renseigné !!");
                header("Location: frontController.php?controller=commande&action=readAll");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function created()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id']) && isset($_REQUEST['date']) && isset($_REQUEST['statut']) && isset($_REQUEST['userLogin'])) {
                $bool = (new CommandeRepository())->save(Commande::construireDepuisFormulaire($_REQUEST));
                if ($bool) {
                    MessageFlash::ajouter("success", "Commande bien créé !");
                    header("Location: frontController.php?controller=commande&action=readAll");
                } else {
                    MessageFlash::ajouter("warning", "ID déjà utilisé !!");
                    self::afficheVue([
                        "commande" => Commande::construireDepuisFormulaire($_REQUEST),
                        "action" => "create",
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Créer Commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "ID non renseigné !!");
                header("Location: frontController.php?controller=commande&action=readAll");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }


    public static function passerCommande()
    {
        if (ConnexionUtilisateur::estConnecte()) {
            $bool = (new CommandeRepository)->save(new Commande(-1, date("Y-m-d"), "en cours", ConnexionUtilisateur::getLoginUtilisateurConnecte()));
            if ($bool) {
                (new CommandeRepository())->enregistrerCommande(ConnexionUtilisateur::getLoginUtilisateurConnecte(), Panier::lirePanier());
                MessageFlash::ajouter("success", "Votre commande est enregistré !");
                header("Location: frontController.php?action=catalogue&controller=produit");
            } else {
                MessageFlash::ajouter("warning", "L'enregistrement a échoué");
                header("Location: frontController.php?action=affichePanier&controller=produit");
            }
            /*
                } else {
                    MessageFlash::ajouter("info", "Valider ? <a href='frontController.php?action=passerCommande&verif&controller=commande'>oui</a> <a href='frontController.php?action=affichePanier&controller=produit'>non</a>");
                    header("Location: frontController.php?action=affichePanier&controller=produit");
                }
            */
        } else {
            MessageFlash::ajouter("warning", "Veuillez-vous connecter pour passer une commande");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

}


// TODO formulaire de paiement
// TODO modifier produit par commandes