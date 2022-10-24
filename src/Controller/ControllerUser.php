<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Model\Repository\UserRepository;
use App\E_Commerce\Model\DataObject\User;

class ControllerUser
{
    private static function afficheVue(array $parametres = []): void
    {
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/view.php"; // Charge la vue
    }

    public static function readAll()
    {
        $users = (new UserRepository)->selectAll();
        self::afficheVue([
            'users' => $users,
            "pagetitle" => "Liste des utilisateurs",
            "cheminVueBody" => "user/list.php",
        ]);
    }

    public static function read()
    {
        if (isset($_GET['login'])) {
            $user = (new UserRepository)->select($_GET['login']);
            if (is_null($user)) {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "login non trouvée !!",
                    "cheminVueBody" => "user/error.php",
                ]);
            } else {
                self::afficheVue([
                    'user' => $user,
                    "pagetitle" => "Détail de {$user->get('login')}",
                    "cheminVueBody" => "user/detail.php",
                ]);
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "login non renseignée !!",
                "cheminVueBody" => "user/error.php",
            ]);
        }
    }

    public static function delete()
    {
        if (isset($_GET['login'])) {
            $bool = (new UserRepository())->delete($_GET['login']);
            if ($bool) {
                $users = (new UserRepository)->selectAll();
                self::afficheVue([
                    "primary" => $_GET['login'],
                    "users" => $users,
                    "pagetitle" => "Supressed",
                    "cheminVueBody" => "user/deleted.php",
                ] );
            } else {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "Login non trouvée !!",
                    "cheminVueBody" => "user/error.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "Login non renseignée !!",
                "cheminVueBody" => "user/error.php",
            ] );
        }
    }

    public static function update()
    {
        if (isset($_GET['login'])) {
            $user = (new UserRepository)->select($_GET['login']);
            if (is_null($user)) {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "Login non trouvée !!",
                    "cheminVueBody" => "user/error.php",
                ]);
            } else {
                self::afficheVue([
                    "user" => $user,
                    "pagetitle" => "Modifier user",
                    "cheminVueBody" => "user/update.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "Login non renseignée !!",
                "cheminVueBody" => "user/error.php",
            ] );
        }
    }

    public static function create()
    {
        self::afficheVue([
            "pagetitle" => "Créer Utilisateur",
            "cheminVueBody" => "user/create.php",
        ] );
    }

    public static function updated() {
        if (isset($_GET['login']) && isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['email'])) {
            $login = $_GET['login'];
            $nom = $_GET['nom'];
            $prenom = $_GET['prenom'];
            $email = $_GET['email'];

            $use = new User($login, $nom, $prenom, "", $email);
            $bool = (new UserRepository)->update($use);
            if ($bool) {
                $users = (new UserRepository)->selectAll();
                self::afficheVue([
                    "use" => $use,
                    "users" => $users,
                    "pagetitle" => "Updated",
                    "cheminVueBody" => "user/updated.php",
                ] );
            } else {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "Immatriculation déja existante !!",
                    "cheminVueBody" => "user/error.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "Immatriculation non renseignée !!",
                "cheminVueBody" => "user/error.php",
            ] );
        }
    }

    public static function created()
    {
        if (isset($_GET['login']) && isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['email'])) {
            $login = $_GET['login'];
            $nom = $_GET['nom'];
            $prenom = $_GET['prenom'];
            $email = $_GET['email'];

            $bool = (new UserRepository)->save(new User($login, $nom, $prenom, "", $email));
            if ($bool) {
                $users = (new UserRepository)->selectAll();
                self::afficheVue([
                    "users" => $users,
                    "pagetitle" => "Created",
                    "cheminVueBody" => "user/created.php",
                ] );
            } else {
                self::afficheVue([
                    "pagetitle" => "Error",
                    "msg" => "Login déja existant !!",
                    "cheminVueBody" => "user/error.php",
                ] );
            }
        } else {
            self::afficheVue([
                "pagetitle" => "Error",
                "msg" => "Login non renseigné !!",
                "cheminVueBody" => "user/error.php",
            ] );
        }
    }

    public static function login() {
        self::afficheVue([
            "pagetitle" => "Se connecter",
            "cheminVueBody" => "user/login.php",
        ] );
    }


}