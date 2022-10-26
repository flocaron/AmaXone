<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Model\Repository\ComposantRepository;
use App\E_Commerce\Model\DataObject\Composant;


class ControllerComposant {

    private static function afficheVue(array $parametres = []): void {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/view.php"; // Charge la vue
    }

    public static function error($errorMsg = "") {
        self::afficheVue([
            "pagetitle" => "Error",
            "msg" => $errorMsg,
            "cheminVueBody" => "composant/error.php",
        ]);
    }

    public static function readAll() {
        $composants = (new ComposantRepository())->selectAll();
        self::afficheVue([
            'inventaire' => $composants,
            "pagetitle" => "Catalogue",
            "cheminVueBody" => "composant/list.php",
        ]);
    }

    public static function read()
    {
        if (isset($_GET['id'])) {
            $composant = (new ComposantRepository)->select($_GET['id']);
            if (is_null($composant)) {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "id non trouvée !!",
                    "cheminVueBody" => "composant/error.php",
                ]);
            } else {
                self::afficheVue([
                    'composant' => $composant,
                    "pagetitle" => "Détail de {$composant->get('id')}",
                    "cheminVueBody" => "composant/detail.php",
                ]);
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "id non renseignée !!",
                "cheminVueBody" => "composant/error.php",
            ]);
        }
    }

    public static function delete()
    {
        if (isset($_GET['id'])) {
            $bool = (new ComposantRepository())->delete($_GET['id']);
            if ($bool) {
                $composants = (new ComposantRepository)->selectAll();
                self::afficheVue([
                    "primary" => $_GET['id'],
                    "inventaire" => $composants,
                    "pagetitle" => "Supressed",
                    "cheminVueBody" => "composant/deleted.php",
                ] );
            } else {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "id non trouvée !!",
                    "cheminVueBody" => "composant/error.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "id non renseignée !!",
                "cheminVueBody" => "composant/error.php",
            ] );
        }
    }

    public static function update()
    {
        if (isset($_GET['id'])) {
            $composant = (new ComposantRepository)->select($_GET['id']);
            if (is_null($composant)) {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "id non trouvée !!",
                    "cheminVueBody" => "composant/error.php",
                ]);
            } else {
                self::afficheVue([
                    "composant" => $composant,
                    "pagetitle" => "Modifier composant",
                    "cheminVueBody" => "composant/update.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "id non renseignée !!",
                "cheminVueBody" => "composant/error.php",
            ] );
        }
    }

    public static function create()
    {
        self::afficheVue([
            "pagetitle" => "Créer Utilisateur",
            "cheminVueBody" => "composant/create.php",
        ] );
    }

    public static function updated() {
        if (isset($_GET['libelle']) && isset($_GET['description']) && isset($_GET['prix']) && isset($_GET['imgPath'])) {
            $libelle = $_GET['libelle'];
            $description = $_GET['description'];
            $prix = $_GET['prix'];
            $imgPath = $_GET['imgPath'];

            $use = new Composant($libelle, $description, $prix, $imgPath);
            $bool = (new ComposantRepository)->update($use);
            if ($bool) {
                $composants = (new ComposantRepository)->selectAll();
                self::afficheVue([
                    "use" => $use,
                    "inventaire" => $composants,
                    "pagetitle" => "Updated",
                    "cheminVueBody" => "composant/updated.php",
                ] );
            } else {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "Immatriculation déja existante !!",
                    "cheminVueBody" => "composant/error.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "Immatriculation non renseignée !!",
                "cheminVueBody" => "composant/error.php",
            ] );
        }
    }

    public static function created()
    {
        if (isset($_POST['libelle']) && isset($_POST['description']) && isset($_POST['prix'])) {
            $libelle = $_POST['libelle'];
            $description = $_POST['description'];
            $prix = $_POST['prix'];

            //TODO upload file
            foreach ($_FILES['file-upload'] as $k => $v) {
                echo "<p> $k = $v </p>";
            }



            $imgPath = "";

            $bool = (new ComposantRepository)->save(new Composant($libelle, $description, $prix, $imgPath));
            if ($bool) {
                $composants = (new ComposantRepository)->selectAll();
                self::afficheVue([
                    "inventaire" => $composants,
                    "pagetitle" => "Created",
                    "cheminVueBody" => "composant/created.php",
                ] );
            } else {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "id déja existant !!",
                    "cheminVueBody" => "composant/error.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "id non renseigné !!",
                "cheminVueBody" => "composant/error.php",
            ] );
        }
    }


}