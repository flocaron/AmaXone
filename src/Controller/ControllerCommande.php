<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\FPDF;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\Panier;
use App\E_Commerce\Model\DataObject\Commande;
use App\E_Commerce\Model\Repository\CommandeRepository;
use App\E_Commerce\Model\Repository\ProduitRepository;
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
                        "produits" => (new ProduitRepository())->selectAll(),
                        "produitsCommande" => (new CommandeRepository())->getProduitParCommande($_REQUEST['id']),
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
                "produits" => (new ProduitRepository())->selectAll(),
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
            if (isset($_REQUEST['id']) && isset($_REQUEST['date']) && isset($_REQUEST['statut']) && isset($_REQUEST['userLogin']) && isset($_REQUEST['produit'])) {
                $commande = new Commande();
                $commande->setId($_REQUEST['id']);
                $commande->setDate($_REQUEST['date']);
                $commande->setStatut($_REQUEST['statut']);
                $commande->setUserLogin($_REQUEST['userLogin']);
                if (is_null((new CommandeRepository())->select($_REQUEST['id']))) {
                    MessageFlash::ajouter("warning", "ID non trouvé !!");
                    self::afficheVue([
                        "commande" => $commande,
                        "action" => "update",
                        "produits" => (new ProduitRepository())->selectAll(),
                        "lastProduit" => Panier::filtreQte($_REQUEST['produit']),
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Modifier commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                    exit(1);
                }
                if (count(Panier::filtreQte($_REQUEST['produit'])) == 0) {
                    MessageFlash::ajouter("warning", "Faire une commande vide est impossible !!");
                    self::afficheVue([
                        "commande" => $commande,
                        "action" => "update",
                        "produits" => (new ProduitRepository())->selectAll(),
                        "lastProduit" => Panier::filtreQte($_REQUEST['produit']),
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Modifier commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                    exit(1);
                }
                $user = (new UserRepository())->select($_REQUEST['userLogin']);
                if (is_null($user)) {
                    MessageFlash::ajouter("danger", "Cet utilisateur n'existe pas !!");
                    self::afficheVue([
                        "commande" => $commande,
                        "action" => "update",
                        "produits" => (new ProduitRepository())->selectAll(),
                        "lastProduit" => Panier::filtreQte($_REQUEST['produit']),
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Modifier commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                    exit(1);
                }
                $bool = (new CommandeRepository())->update($commande);
                if ($bool) {
                    (new CommandeRepository())->updateProduitParCommande($_REQUEST['id'], Panier::filtreQte($_REQUEST['produit']));
                    MessageFlash::ajouter("success", "Commande bien modifié !");
                } else {
                    MessageFlash::ajouter("warning", "Modification echouée !");
                }
            } else {
                MessageFlash::ajouter("danger", "ID non renseigné !!");
            }
            header("Location: frontController.php?controller=commande&action=readAll");
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function created()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id']) && isset($_REQUEST['date']) && isset($_REQUEST['statut']) && isset($_REQUEST['userLogin']) && isset($_REQUEST['produit'])) {
                if (count(Panier::filtreQte($_REQUEST['produit'])) == 0) {
                    MessageFlash::ajouter("warning", "Faire une commande vide est impossible !!");
                    self::afficheVue([
                        "commande" => Commande::construireDepuisFormulaire($_REQUEST),
                        "action" => "create",
                        "produits" => (new ProduitRepository())->selectAll(),
                        "lastProduit" => Panier::filtreQte($_REQUEST['produit']),
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Créer commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                    exit(1);
                }
                $user = (new UserRepository())->select($_REQUEST['userLogin']);
                if (is_null($user)) {
                    MessageFlash::ajouter("danger", "Cet utilisateur n'existe pas !!");
                    self::afficheVue([
                        "commande" => Commande::construireDepuisFormulaire($_REQUEST),
                        "action" => "create",
                        "produits" => (new ProduitRepository())->selectAll(),
                        "lastProduit" => Panier::filtreQte($_REQUEST['produit']),
                        "users" => (new UserRepository())->selectAll(),
                        "pagetitle" => "Créer commande",
                        "cheminVueBody" => "commande/create.php",
                    ]);
                    exit(1);
                }
                $bool = (new CommandeRepository())->save(Commande::construireDepuisFormulaire($_REQUEST));
                if ($bool) {
                    (new CommandeRepository())->enregistrerCommande($_REQUEST['userLogin'], Panier::filtreQte($_REQUEST['produit']));
                    MessageFlash::ajouter("success", "Commande bien créé !");
                    header("Location: frontController.php?controller=commande&action=readAll");
                } else {
                    MessageFlash::ajouter("warning", "ID déjà utilisé !!");
                    self::afficheVue([
                        "commande" => Commande::construireDepuisFormulaire($_REQUEST),
                        "action" => "create",
                        "produits" => (new ProduitRepository())->selectAll(),
                        "lastProduit" => Panier::filtreQte($_REQUEST['produit']),
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
            if (Panier::nbPanier() > 0) {
                $total = 0;
                foreach (Panier::lirePanier() as $id => $qte) {
                    $total += (new ProduitRepository())->select($id)->getPrix() * $qte;
                }
                self::afficheVue([
                    "val" => [
                        "nom" => "",
                        "num" => "",
                        "mois" => "",
                        "an" => "",
                    ],
                    "total" => $total,
                    "pagetitle" => "Passer Commande",
                    "cheminVueBody" => "commande/formCB.php",
                ]);
            } else {
                MessageFlash::ajouter("info", "Vous ne pouvez pas commander avec un panier vide !");
                header("Location: frontController.php?action=affichePanier&controller=produit");
            }
        } else {
            MessageFlash::ajouter("warning", "Veuillez-vous connecter pour passer une commande");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function validerCommande() {
        if (ConnexionUtilisateur::estConnecte()) {
            if (Panier::nbPanier() > 0) {
                $total = 0;
                foreach (Panier::lirePanier() as $id => $qte) {
                    $total += (new ProduitRepository())->select($id)->getPrix() * $qte;
                }
                if (isset($_REQUEST['nom']) && isset($_REQUEST['num']) && isset($_REQUEST['mois']) && isset($_REQUEST['crypto']) && isset($_REQUEST['an'])) {
                    if (strlen($_REQUEST['crypto']) == 3) {
                        $bool = (new CommandeRepository)->save(new Commande(-1, date("Y-m-d"), "en cours", ConnexionUtilisateur::getLoginUtilisateurConnecte()));
                        if ($bool) {
                            (new CommandeRepository())->enregistrerCommande(ConnexionUtilisateur::getLoginUtilisateurConnecte(), Panier::lirePanier());
                            MessageFlash::ajouter("success", "Votre commande est enregistré !");
                            header("Location: frontController.php?action=catalogue&controller=categorie");
                        } else {
                            MessageFlash::ajouter("warning", "L'enregistrement a échoué");
                            header("Location: frontController.php?action=affichePanier&controller=produit");
                        }
                    } else {
                        MessageFlash::ajouter("warning", "le cryptogramme doit faire 3 chiffre !!");
                        self::afficheVue([
                            "val" => [
                                "nom" => $_REQUEST['nom'],
                                "num" => $_REQUEST['num'],
                                "mois" => $_REQUEST['mois'],
                                "an" => $_REQUEST['an'],
                            ],
                            "total" => $total,
                            "pagetitle" => "Passer Commande",
                            "cheminVueBody" => "commande/formCB.php",
                        ]);
                    }
                } else {
                    MessageFlash::ajouter("danger", "Il manque des informations de paiement !");
                    self::afficheVue([
                        "val" => [
                            "nom" => $_REQUEST['nom'],
                            "num" => $_REQUEST['num'],
                            "mois" => $_REQUEST['mois'],
                            "an" => $_REQUEST['an'],
                        ],
                        "total" => $total,
                        "pagetitle" => "Passer Commande",
                        "cheminVueBody" => "commande/formCB.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("info", "Vous ne pouvez pas commander avec un panier vide !");
                header("Location: frontController.php?action=affichePanier&controller=produit");
            }
        } else {
            MessageFlash::ajouter("warning", "Veuillez-vous connecter pour passer une commande");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function exporterPDF () {
        if (ConnexionUtilisateur::estConnecte()) {
            if (isset($_REQUEST['id'])) {
                $commande = (new CommandeRepository())->select($_REQUEST['id']);
                if (!is_null($commande)) {
                    if ($commande->getUserLogin() == ConnexionUtilisateur::getLoginUtilisateurConnecte() || ConnexionUtilisateur::estAdministrateur()) {

                        $user = (new UserRepository())->select($commande->getUserLogin());
                        $produits = (new CommandeRepository())->getProduitParCommande($commande->getId());

                        $pdf = new FPDF();
                        $pdf->AddPage();

                        $pdf->SetFont('Arial','B',16);
                        $pdf->Cell(40,10,'N' . chr(176) . ' Commande', 0, 1);
                        $pdf->SetFont('Arial','B',14);
                        $pdf->Cell(40,10,'QUITTANCE-' . $commande->getId(), 0, 1);

                        $pdf->SetFont('Arial','',12);
                        $pdf->Cell(40,10,'Nom : ' . $user->get('nom') . " " . $user->get('prenom'), 0, 1);
                        $pdf->Cell(40,10,'Email : ' . $user->get('email'), 0, 1);

                        $pdf->SetFont('Arial','B',12);
                        $pdf->Cell(40,10,'Articles :', 0, 1);
                        $pdf->SetFont('Arial','',11);

                        $total = 0;
                        foreach ($produits as $produitSerialize => $qte) {
                            $produit = unserialize($produitSerialize);

                            $pdf->Cell(40,10,'         - ' . $produit->getLibelle() . " -> " . $produit->getPrix() . chr(128) . " x$qte", 0, 1);

                            $total += $produit->getPrix();
                        }
                        $pdf->SetFont('Arial','B',12);
                        $pdf->Cell(40,10,'Date Quittance', 0, 1);
                        $pdf->SetFont('Arial','',11);
                        $pdf->Cell(40,10,$commande->getDate(), 0, 1);

                        $pdf->Cell(40, 10, "Montant Pay" . chr(233) . " : $total " . chr(128), 0, 1);

                        $pdf->Output("", "commande.pdf", true);

                    } else {
                        MessageFlash::ajouter("danger", "Vous n'etes pas le bon utilisateur connecté !");
                        header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode(ConnexionUtilisateur::getLoginUtilisateurConnecte()));
                    }
                } else {
                    MessageFlash::ajouter("warning", "Cette commande n'existe pas !");
                    header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode(ConnexionUtilisateur::getLoginUtilisateurConnecte()));
                }
            } else {
                MessageFlash::ajouter("danger", "Il manque l'id !");
                header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode(ConnexionUtilisateur::getLoginUtilisateurConnecte()));
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas connecté !");
            header("Location: frontController.php?action=login&controller=user");
        }

    }


}


// TODO export PDF

// TODO admin peut pas remove admin

// TODO search bar for products
// TODO tech support / SAV