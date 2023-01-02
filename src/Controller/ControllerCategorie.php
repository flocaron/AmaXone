<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Model\DataObject\Categorie;
use App\E_Commerce\Model\Repository\CategorieRepository;

class ControllerCategorie extends GenericController
{

    protected static function getNomController(): string
    {
        return "categorie";
    }

    public static function read()
    {
        if (isset($_REQUEST['nom'])) {
            $categorie = (new CategorieRepository())->select($_REQUEST['nom']);
            if (is_null($categorie)) {
                MessageFlash::ajouter("warning", "Nom non trouvé !!");
                header("Location: frontController.php?action=catalogue&controller=categorie");
            } else {
                self::afficheVue([
                    'categorie' => $categorie,
                    "pagetitle" => "Détail de {$categorie->getNom()}",
                    "cheminVueBody" => "categorie/detail.php",
                ]);
            }
        } else {
            MessageFlash::ajouter("danger", "Nom non renseigné !!");
            header("Location: frontController.php?action=catalogue&controller=categorie");
        }
    }

    public static function delete()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['nom'])) {
                if (isset($_REQUEST['verif'])) {
                    $bool = (new CategorieRepository())->delete($_REQUEST['nom']);
                    if ($bool) {
                        MessageFlash::ajouter("success", "Catégorie bien supprimé !");
                    } else {
                        MessageFlash::ajouter("warning", "Nom non trouvé !!");
                    }
                } else {
                    MessageFlash::ajouter("info", "Etes-vous sur ? " .
                        " <a href='frontController.php?action=delete&controller=categorie&nom=" .
                        rawurlencode($_REQUEST['nom']) . "&verif'> oui </a> " .
                        " <a href='frontController.php?action=readAll&controller=categorie'> non</a>"
                    );
                }
            } else {
                MessageFlash::ajouter("danger", "Nom non renseigné !!");
            }
            header("Location: frontController.php?action=readAll&controller=categorie");
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function update()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['nom'])) {
                $categorie = (new CategorieRepository)->select($_REQUEST['nom']);
                if (is_null($categorie)) {
                    MessageFlash::ajouter("warning", "Nom non trouvé !!");
                    header("Location: frontController.php?action=readAll&controller=categorie");
                } else {
                    self::afficheVue([
                        "categorie" => $categorie,
                        "action" => "update",
                        "pagetitle" => "Modifier categorie",
                        "cheminVueBody" => "categorie/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Nom non renseigné !!");
                header("Location: frontController.php?action=readAll&controller=categorie");
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
                "pagetitle" => "Créer Catégorie",
                "cheminVueBody" => "categorie/create.php",
            ]);
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function updated()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['nom']) && isset($_REQUEST['description'])) {
                $categorie = (new CategorieRepository())->select($_REQUEST['nom']);
                if (!is_null($categorie)) {
                    $categorie->setDescription($_REQUEST['description']);
                    if (!empty($_FILES['file-upload']) && is_uploaded_file($_FILES['file-upload']['tmp_name'])) {
                        $pic_path = __DIR__ . "/../../assets/images/categories/" . $_FILES['file-upload']['name'];
                        $extension = explode('.', $_FILES['file-upload']['name']);
                        if (in_array(end($extension), ["jpg", "jpeg", "png"]) && $_FILES['file-upload']['size'] < 10 ** 7) {
                            if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $pic_path)) {
                                $categorie->setImgPath($_FILES['file-upload']['name']);
                            } else {
                                MessageFlash::ajouter("warning", "Importation de l'image échouée");
                                self::afficheVue([
                                    "categorie" => $categorie,
                                    "action" => "update",
                                    "pagetitle" => "Modifier categorie",
                                    "cheminVueBody" => "categorie/create.php",
                                ]);
                                exit(1);
                            }
                        } else {
                            MessageFlash::ajouter("warning", "Mauvaise extension ou taille de fichier");
                            self::afficheVue([
                                "categorie" => $categorie,
                                "action" => "update",
                                "pagetitle" => "Modifier categorie",
                                "cheminVueBody" => "categorie/create.php",
                            ]);
                            exit(1);
                        }
                    }
                    $bool = (new CategorieRepository)->update($categorie);
                    if ($bool) {
                        MessageFlash::ajouter("success", "Catégorie bien mise à jour");
                    } else {
                        MessageFlash::ajouter("warning", "Mise à jour échouée");
                    }
                    header("Location: frontController.php?action=readAll&controller=categorie");
                } else {
                    MessageFlash::ajouter("warning", "Cette catégorie n'existe pas");
                    self::afficheVue([
                        "categorie" => $categorie,
                        "action" => "update",
                        "pagetitle" => "Modifier categorie",
                        "cheminVueBody" => "categorie/create.php",
                    ]);
                    exit(1);
                }
            } else {
                MessageFlash::ajouter("danger", "Nom non renseignée !!");
                header("Location: frontController.php?action=readAll&controller=categorie");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function created()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            if (isset($_REQUEST['nom']) && isset($_REQUEST['description']) && !empty($_FILES['file-upload']) && is_uploaded_file($_FILES['file-upload']['tmp_name'])) {
                $categorie = new Categorie($_REQUEST['nom'], $_REQUEST['description'], "");
                $pic_path = __DIR__ . "/../../assets/images/categories/" . $_FILES['file-upload']['name'];
                $extension = explode('.', $_FILES['file-upload']['name']);
                if (in_array(end($extension), ["jpg", "jpeg", "png"]) && $_FILES['file-upload']['size'] < 10 ** 7) { // 10 Mo
                    if (move_uploaded_file($_FILES['file-upload']['tmp_name'], $pic_path)) {
                        $_REQUEST['imgPath'] = $_FILES['file-upload']['name'];
                        $bool = (new CategorieRepository)->save(Categorie::construireDepuisFormulaire($_REQUEST));
                        if ($bool) {
                            MessageFlash::ajouter("success", "Catégorie bien crée");
                            header("Location: frontController.php?action=readAll&controller=categorie");
                        } else {
                            MessageFlash::ajouter("warning", "Nom déja existant");
                            self::afficheVue([
                                "categorie" => $categorie,
                                "action" => "create",
                                "pagetitle" => "Créer Categorie",
                                "cheminVueBody" => "categorie/create.php",
                            ]);
                        }
                    } else {
                        MessageFlash::ajouter("warning", "Importation de l'image échouée");
                        self::afficheVue([
                            "categorie" => $categorie,
                            "action" => "create",
                            "pagetitle" => "Créer Categorie",
                            "cheminVueBody" => "categorie/create.php",
                        ]);
                    }
                } else {
                    MessageFlash::ajouter("warning", "Mauvaise extension ou taille de fichier");
                    self::afficheVue([
                        "categorie" => $categorie,
                        "action" => "create",
                        "pagetitle" => "Créer Categorie",
                        "cheminVueBody" => "categorie/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Nom non renseigné !!");
                header("Location: frontController.php?action=readAll&controller=categorie");
            }
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas Administrateur !");
            header("Location: frontController.php");
        }
    }

    public static function catalogue()
    {
        self::afficheVue([
            "inventaire" => (new CategorieRepository())->selectAll(),
            "pagetitle" => "Catalogue Categorie",
            "cheminVueBody" => "categorie/catalogue.php",
        ]);
    }
}