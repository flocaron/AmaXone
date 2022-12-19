<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\MotDePasse;
use App\E_Commerce\Lib\VerificationEmail;
use App\E_Commerce\Model\Repository\UserRepository;
use App\E_Commerce\Model\DataObject\User;

class ControllerUser extends GenericController
{

    public static function readAll()
    {
        if (ConnexionUtilisateur::estAdministrateur()) {
            $users = (new UserRepository)->selectAll();
            self::afficheVue([
                'users' => $users,
                'estAdmin' => ConnexionUtilisateur::estAdministrateur(),
                "pagetitle" => "Liste des utilisateurs",
                "cheminVueBody" => "user/list.php",
            ]);
        } else {
            MessageFlash::ajouter("danger", "Vous n'etes pas administrateur !");
            header("Location: frontController.php?action=login&controller=user");
        }

    }

    public static function read()
    {
        if (isset($_REQUEST['login'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                $user = (new UserRepository)->select($_REQUEST['login']);
                if (is_null($user)) {
                    MessageFlash::ajouter("warning", "login non trouvée !!");
                    header("Location: frontController.php?action=login&controller=user");
                } else {
                    self::afficheVue([
                        'user' => $user,
                        'estAdmin' => ConnexionUtilisateur::estAdministrateur(),
                        "pagetitle" => "Détail de {$user->get('login')}",
                        "connecte" => ConnexionUtilisateur::estUtilisateur($_REQUEST['login']),
                        "cheminVueBody" => "user/detail.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function delete()
    {
        if (isset($_REQUEST['login'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                if (isset($_REQUEST['verif'])) {
                    $boolR = (new UserRepository())->delete($_REQUEST['login']);
                    if ($boolR) {
                        MessageFlash::ajouter("success", "Utilisateur bien supprimé !");
                    } else {
                        MessageFlash::ajouter("warning", "login non trouvé !!");
                    }
                } else {
                    MessageFlash::ajouter("verif", "Etes-vous sur ? " .
                        " <a href='frontController.php?action=delete&controller=user&login=" .
                        rawurlencode($_REQUEST['login']) . "&verif'> oui </a> " .
                        " <a href='frontController.php?action=readAll&controller=user'> non</a>"
                    );
                }
                header("Location: frontController.php");
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "Login non renseigné !!");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function update()
    {
        if (isset($_REQUEST['login'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                $user = (new UserRepository)->select($_REQUEST['login']);
                if (is_null($user)) {
                    MessageFlash::ajouter("warning", "login non trouvée !!");
                    header("Location: frontController.php?action=login&controller=user");
                } else {
                    self::afficheVue([
                        "user" => $user,
                        "pagetitle" => "Modifier user",
                        "estAdmin" => ConnexionUtilisateur::estAdministrateur(),
                        "cheminVueBody" => "user/update.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function create()
    {
        self::afficheVue([
            "pagetitle" => "Créer Utilisateur",
            "estAdmin" => ConnexionUtilisateur::estAdministrateur(),
            "cheminVueBody" => "user/create.php",
        ]);
    }

    public static function updated()
    {
        if (isset($_REQUEST['login']) && isset($_REQUEST['nom']) && isset($_REQUEST['prenom']) && isset($_REQUEST['mdp']) && isset($_REQUEST['mdpN']) && isset($_REQUEST['mdpC'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                if (ConnexionUtilisateur::estAdministrateur()) {
                    $password = (new UserRepository())->getHashMdp(ConnexionUtilisateur::getLoginUtilisateurConnecte());
                } else {
                    $password = (new UserRepository())->getHashMdp($_REQUEST['login']);
                }
                if (MotDePasse::verifier($_REQUEST['mdp'], $password)) {
                    if (strlen($_REQUEST['mdpN']) > 0 ){
                        if (strcmp($_REQUEST['mdpN'], $_REQUEST['mdpC']) == 0) {
                            $_REQUEST['mdp'] = $_REQUEST['mdpN'];
                        } else {
                            MessageFlash::ajouter("warning", "les deux mots de passe doivent être égaux !!");
                            header("Location: frontController.php?action=update&controller=user&login=" . rawurlencode($_REQUEST['login']));
                            exit(1);
                        }
                    }
                    if (isset($_REQUEST['estAdmin']) && !ConnexionUtilisateur::estAdministrateur()) {
                        unset($_REQUEST['estAdmin']);
                        MessageFlash::ajouter("danger", "Vous n'etes pas admin !");
                    }
                    $user = (new UserRepository())->select($_REQUEST['login']);
                    if ($user->get('email') != $_REQUEST['email']) {
                        $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
                        if (!$email) {
                            MessageFlash::ajouter('warning', "Votre nouveau email n'est pas valide");
                            header("Location: frontController.php?action=create&controller=user");
                            exit(1);
                        } else {
                            $_REQUEST['email'] = $email;
                        }
                    }
                    $newUser = User::construireDepuisFormulaire($_REQUEST);
                    $bool = (new UserRepository)->update($newUser);
                    if ($bool) {
                        MessageFlash::ajouter("success", "utilisateur bien modifié !!");
                        VerificationEmail::envoiEmailValidation($newUser);
                    } else {
                        MessageFlash::ajouter("warning", "utilisateur non modifié !!");
                    }
                    header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode($_REQUEST['login']));
                } else {
                    MessageFlash::ajouter("warning", "mauvais mot de passe !!");
                    header("Location: frontController.php?action=update&controller=user&login=" . rawurlencode($_REQUEST['login']));
                }
            } else {
                MessageFlash::ajouter("danger", "vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function created(){
        if (isset($_REQUEST['login']) && isset($_REQUEST['nom']) && isset($_REQUEST['prenom']) && isset($_REQUEST['mdp']) && isset($_REQUEST['mdp2'])) {
            if (strcmp($_REQUEST['mdp'], $_REQUEST['mdp2']) == 0) {
                $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
                if (!$email) {
                    MessageFlash::ajouter('warning', "Votre email n'est pas valide");
                    header("Location: frontController.php?action=create&controller=user");
                    exit(1);
                } else {
                    $_REQUEST['email'] = $email;
                }
                if (isset($_REQUEST['estAdmin']) && !ConnexionUtilisateur::estAdministrateur()) {
                    unset($_REQUEST['estAdmin']);
                }
                $newUser = User::construireDepuisFormulaire($_REQUEST);
                $bool = (new UserRepository)->save($newUser);
                if ($bool) {
                    VerificationEmail::envoiEmailValidation($newUser);
                    MessageFlash::ajouter("success", "utilisateur bien créé !!");
                } else {
                    MessageFlash::ajouter("warning", "login deja existant !!");
                }
                header("Location: frontController.php?action=login&controller=user");
            } else {
                MessageFlash::ajouter("warning", "les deux mots de passe doivent être égaux !!");
                header("Location: frontController.php?action=create&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function login() {
        self::afficheVue([
            "pagetitle" => "Se connecter",
            "cheminVueBody" => "user/login.php",
        ] );
    }

    public static function logined() {
        if (isset($_REQUEST['login']) && isset($_REQUEST['mdp'])) {
            $user = (new UserRepository())->select($_REQUEST['login']);
            if (!is_null($user)) {
                if (VerificationEmail::aValideEmail($user)) {
                    if (MotDePasse::verifier($_REQUEST['mdp'], $user->get('mdpHache'))) {
                        ConnexionUtilisateur::connecter($_REQUEST['login']);
                        MessageFlash::ajouter("success", "Vous etes bien connecté !");
                        header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode($_REQUEST['login']));
                    } else {
                        MessageFlash::ajouter("warning", "Mauvais mot de passe ou login !");
                        header("Location: frontController.php?action=login&controller=user");
                    }
                } else {
                    MessageFlash::ajouter("warning", "Vous n'avez pas verifié votre email !");
                    header("Location: frontController.php?action=login&controller=user");
                }
            } else {
                MessageFlash::ajouter("warning", "Cet utilisateur n'existe pas !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "Il manque le login et/ou le mdp !");
            header("Location: frontController.php?action=login&controller=user");
        }
    }

    public static function logout() {
        ConnexionUtilisateur::deconnecter();
        header("Location: frontController.php");
    }

    public static function validerEmail() {
        if (isset($_REQUEST['login']) && isset($_REQUEST['nonce'])) {
            if (VerificationEmail::traiterEmailValidation($_REQUEST['login'], $_REQUEST['nonce'])) {
                MessageFlash::ajouter("success", "Email validé !");
                header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode($_REQUEST['login']));
            } else {
                MessageFlash::ajouter("warning", "Validation failed !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            MessageFlash::ajouter("danger", "Il manque le login et/ou le nonce !");
            header("Location: frontController.php?action=login&controller=user");
        }
    }


    // TODO remettre dernier panier apres reconnection

}