<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\Panier;
use App\E_Commerce\Model\Repository\ComposantRepository;
use App\E_Commerce\Model\DataObject\Composant;
use App\E_Commerce\Model\Repository\UserRepository;


class ControllerComposant extends GenericController
{

    public static function readAll()
    {
        $composants = (new ComposantRepository())->selectAll();
        self::afficheVue([
            'inventaire' => $composants,
            "pagetitle" => "Catalogue",
            "cheminVueBody" => "composant/list.php",
        ]);
    }

    public static function read()
    {
        if (isset($_REQUEST['id'])) {
            $composant = (new ComposantRepository)->select($_REQUEST['id']);
            if (is_null($composant)) {
                MessageFlash::ajouter("warning", "id non trouvée !!");
                header("Location: frontController.php?action=readAll&controller=composant");
            } else {
                self::afficheVue([
                    'composant' => $composant,
                    "pagetitle" => "Détail de {$composant->getId()}",
                    "cheminVueBody" => "composant/detail.php",
                ]);
            }
        } else {
            MessageFlash::ajouter("danger", "id non renseignée !!");
            header("Location: frontController.php?action=readAll&controller=composant");
        }
    }

    public static function delete()
    {
        if (isset($_REQUEST['id'])) {
            if (ConnexionUtilisateur::estAdministrateur()) {
                if (isset($_REQUEST['verif'])) {
                    $bool = (new ComposantRepository())->delete($_REQUEST['id']);
                    if ($bool) {
                        MessageFlash::ajouter("success", "Composant bien supprimé !");
                    } else {
                        MessageFlash::ajouter("warning", "ID non trouvé !!");
                    }
                } else {
                    MessageFlash::ajouter("info", "Etes-vous sur ? " .
                        " <a href='frontController.php?action=delete&controller=composant&id=" .
                        rawurlencode($_REQUEST['id']) . "&verif'> oui </a> " .
                        " <a href='frontController.php?action=readAll&controller=composant'> non</a>"
                    );
                }
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            }
        } else {
            MessageFlash::ajouter("danger", "ID non renseigné !!");
        }
        header("Location: frontController.php?action=readAll&controller=composant");
    }

    public static function update()
    {
        if (isset($_REQUEST['id'])) {
            if (ConnexionUtilisateur::estAdministrateur()) {
                $composant = (new ComposantRepository)->select($_REQUEST['id']);
                if (is_null($composant)) {
                    MessageFlash::ajouter("warning", "ID non trouvé !!");
                    header("Location: frontController.php?action=readAll&controller=composant");
                } else {
                    self::afficheVue([
                        "composant" => $composant,
                        "action" => "update",
                        "pagetitle" => "Modifier composant",
                        "cheminVueBody" => "composant/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
                header("Location: frontController.php?action=readAll&controller=composant");
            }
        } else {
            MessageFlash::ajouter("danger", "id non renseignée !!");
            header("Location: frontController.php?action=readAll&controller=composant");
        }
    }

    public static function create()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            self::afficheVue([
                "action" => "create",
                "pagetitle" => "Créer Composant",
                "cheminVueBody" => "composant/create.php",
            ]);
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php?action=readAll&controller=composant");
        }
    }

    public static function updated()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['id']) && isset($_REQUEST['libelle']) && isset($_REQUEST['description']) && isset($_REQUEST['prix'])) {
                $composant = (new ComposantRepository())->select($_REQUEST['id']);
                if (!is_null($composant)) {
                    $composant->setLibelle($_REQUEST['libelle']);
                    $composant->setDescription($_REQUEST['description']);
                    $composant->setPrix($_REQUEST['prix']);

                    if (!empty($_FILES['file-upload']) && is_uploaded_file($_FILES['file-upload']['tmp_name'])) {
                        $pic_path = __DIR__ . "/../../assets/images/" . $_FILES['file-upload']['name'];
                        $extension = explode('.', $_FILES['file-upload']['name']);
                        if (in_array(end($extension), ["jpg", "jpeg", "png"]) && $_FILES['file-upload']['size'] < 10 ** 7) {
                            if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $pic_path)) {
                                $composant->setImgPath($_FILES['file-upload']['name']);
                            } else {
                                MessageFlash::ajouter("warning", "Importation de l'image échouée");
                                self::afficheVue([
                                    "composant" => $composant,
                                    "action" => "update",
                                    "pagetitle" => "Modifier composant",
                                    "cheminVueBody" => "composant/create.php",
                                ]);
                                exit(1);
                            }
                        } else {
                            MessageFlash::ajouter("warning", "Mauvaise extension ou taille de fichier");
                            self::afficheVue([
                                "composant" => $composant,
                                "action" => "update",
                                "pagetitle" => "Modifier composant",
                                "cheminVueBody" => "composant/create.php",
                            ]);
                            exit(1);
                        }
                    }
                    $bool = (new ComposantRepository)->update($composant);
                    if ($bool) {
                        MessageFlash::ajouter("success", "Composant bien mis à jour");
                    } else {
                        MessageFlash::ajouter("warning", "Mise à jour échouée");
                    }
                    header("Location: frontController.php?action=readAll&controller=composant");
                } else {
                    MessageFlash::ajouter("warning", "Ce composant n'existe pas");
                    self::afficheVue([
                        "composant" => $composant,
                        "action" => "update",
                        "pagetitle" => "Modifier composant",
                        "cheminVueBody" => "composant/create.php",
                    ]);
                    exit(1);
                }
            } else {
                MessageFlash::ajouter("danger", "id non renseignée !!");
                header("Location: frontController.php?action=readAll&controller=composant");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php?action=readAll&controller=composant");
        }
    }

    public static function created()
    {
        if (isset($_REQUEST['id']) && isset($_REQUEST['libelle']) && isset($_REQUEST['description']) && isset($_REQUEST['prix']) && !empty($_FILES['file-upload']) && is_uploaded_file($_FILES['file-upload']['tmp_name'])) {
            if (ConnexionUtilisateur::estAdministrateur()) {
                $composant = new Composant($_REQUEST['id'], $_REQUEST['libelle'], $_REQUEST['description'], $_REQUEST['prix'], "");
                $pic_path = __DIR__ . "/../../assets/images/" . $_FILES['file-upload']['name'];
                $extension = explode('.', $_FILES['file-upload']['name']);
                if (in_array(end($extension), ["jpg", "jpeg", "png"]) && $_FILES['file-upload']['size'] < 10 ** 7) {
                    if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $pic_path)) {
                        $_REQUEST['imgPath'] = $_FILES['file-upload']['name'];
                        $bool = (new ComposantRepository)->save(Composant::construireDepuisFormulaire($_REQUEST));
                        if ($bool) {
                            MessageFlash::ajouter("success", "Composant bien crée");
                            header("Location: frontController.php?action=readAll&controller=composant");
                        } else {
                            MessageFlash::ajouter("warning", "ID déja existant");
                            self::afficheVue([
                                "composant" => $composant,
                                "action" => "create",
                                "pagetitle" => "Créer Composant",
                                "cheminVueBody" => "composant/create.php",
                            ]);
                        }
                    } else {
                        MessageFlash::ajouter("warning", "Importation de l'image échouée");
                        self::afficheVue([
                            "composant" => $composant,
                            "action" => "create",
                            "pagetitle" => "Créer Composant",
                            "cheminVueBody" => "composant/create.php",
                        ]);
                    }
                } else {
                    MessageFlash::ajouter("warning", "Mauvaise extension ou taille de fichier");
                    self::afficheVue([
                        "composant" => $composant,
                        "action" => "create",
                        "pagetitle" => "Créer Composant",
                        "cheminVueBody" => "composant/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
                header("Location: frontController.php?action=readAll&controller=composant");
            }
        } else {
            MessageFlash::ajouter("danger", "id non renseignée !!");
            header("Location: frontController.php?action=readAll&controller=composant");
        }
    }

    public static function addPanier()
    {
        if (isset($_REQUEST['id'])) {
            $obj = (new ComposantRepository())->select($_REQUEST['id']);
            if (is_null($obj)) {
                MessageFlash::ajouter("danger", "Cet id n'existe pas !!");
            } else {
                Panier::ajouter($_REQUEST['id']);
                MessageFlash::ajouter("success", "Element ajouté au panier !");
            }
        } else {
            MessageFlash::ajouter("danger", "Il manque l'id de l'objet !");
        }
        if (isset($_REQUEST['read'])) {
            header("Location: frontController.php?action=readAll&controller=composant");
        } else {
            header("Location: frontController.php?action=affichePanier&controller=composant");
        }
    }

    public static function addAllPanier() {
        if (isset($_REQUEST['id']) && isset($_REQUEST['qte'])) {
            $obj = (new ComposantRepository())->select($_REQUEST['id']);
            if (is_null($obj)) {
                MessageFlash::ajouter("danger", "Cet id n'existe pas !!");
            } else {
                Panier::ajouterAll($_REQUEST['id'], $_REQUEST['qte']);
                MessageFlash::ajouter("success", "Element ajouté au panier !");
            }
        } else {
            MessageFlash::ajouter("danger", "Il manque l'id ou la quantité de l'objet !");
        }
        header("Location: frontController.php?action=affichePanier&controller=composant");
    }

    public static function removePanier()
    {
        if (isset($_REQUEST['id'])) {
            Panier::retirer($_REQUEST['id']);
            MessageFlash::ajouter("success", "Element supprimé du panier !");
        } else {
            MessageFlash::ajouter("danger", "Il manque l'id de l'objet !");
        }
        header("Location: frontController.php?action=affichePanier&controller=composant");
    }

    public static function removeAllPanier() {
        if (isset($_REQUEST['id'])) {
            Panier::retirerAll($_REQUEST['id']);
            MessageFlash::ajouter("success", "Element supprimé du panier !");
        } else {
            MessageFlash::ajouter("danger", "Il manque l'id de l'objet !");
        }
        header("Location: frontController.php?action=affichePanier&controller=composant");    }

    public static function affichePanier()
    {
        $panierComposant = [];
        foreach (Panier::lirePanier() as $id => $qte) {
            $panierComposant[serialize((new ComposantRepository())->select($id))] = $qte;
        }
        self::afficheVue([
            "pagetitle" => "Panier",
            "panierComposant" => $panierComposant,
            "cheminVueBody" => "composant/panierTemp.php",
        ]);
    }

    public static function replacePanier()
    {
        if (ConnexionUtilisateur::estConnecte()) {
            $panier = Panier::lirePanier();
            Panier::replacePanier();
            Panier::enregistrePanier($panier);
            MessageFlash::ajouter("success", "Vous avez recupérer votre ancien panier !");
            header("Location: frontController.php?action=affichePanier&controller=composant");
        } else {
            MessageFlash::ajouter("success", "Vous-etes deconnecté !");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function viderPanier()
    {
        if (isset($_REQUEST['verif'])) {
            Panier::viderPanier();
        } else {
            MessageFlash::ajouter("info", "vous etes sur ? <a href='frontController.php?action=viderPanier&controller=composant&verif'> oui </a> <a href='frontController.php?action=affichePanier&controller=composant'> non </a>");
        }
        header("Location: frontController.php?action=affichePanier&controller=composant");
    }

// TODO affiche quantité a selectionné pour les composant


}