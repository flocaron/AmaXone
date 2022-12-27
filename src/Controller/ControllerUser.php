<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\ConnexionUtilisateur;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\MotDePasse;
use App\E_Commerce\Lib\Panier;
use App\E_Commerce\Lib\VerificationEmail;
use App\E_Commerce\Model\Repository\CommandeRepository;
use App\E_Commerce\Model\Repository\UserRepository;
use App\E_Commerce\Model\DataObject\User;

class ControllerUser extends GenericController
{

    protected static function getNomController(): string
    {
        return "user";
    }

    public static function read()
    {
        if (isset($_REQUEST['login'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                $user = (new UserRepository)->select($_REQUEST['login']);
                if (is_null($user)) {
                    MessageFlash::ajouter("warning", "login non trouvée !!");
                    header("Location: frontController.php");
                } else {
                    self::afficheVue([
                        'commandes' =>  (new CommandeRepository())->getCommandeParLogin($_REQUEST['login']),
                        'user' => $user,
                        "pagetitle" => "Détail de {$user->get('login')}",
                        "cheminVueBody" => "user/detail.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php");
        }
    }

    public static function delete()
    {
        if (isset($_REQUEST['login'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                if (isset($_REQUEST['verif'])) {
                    $boolR = (new UserRepository())->delete($_REQUEST['login']);
                    if ($boolR) {
                        if ($_REQUEST['login'] == ConnexionUtilisateur::getLoginUtilisateurConnecte()) {
                            header("Location: frontController.php?action=logout&controller=user");
                            exit(1);
                        }
                        MessageFlash::ajouter("success", "Utilisateur bien supprimé !");
                    } else {
                        MessageFlash::ajouter("warning", "login non trouvé !!");
                    }
                } else {
                    MessageFlash::ajouter("info", "Etes-vous sur ? " .
                        " <a href='frontController.php?action=delete&controller=user&login=" .
                        rawurlencode($_REQUEST['login']) . "&verif'> oui </a> " .
                        " <a href='frontController.php?action=read&controller=user&login=" . rawurlencode($_REQUEST['login']) . "'> non</a>"
                    );
                }
                header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode($_REQUEST['login']));
            } else {
                MessageFlash::ajouter("danger", "Vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php");
            }
        } else {
            MessageFlash::ajouter("danger", "Login non renseigné !!");
            header("Location: frontController.php");
        }
    }

    public static function update()
    {
        if (isset($_REQUEST['login'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                $user = (new UserRepository)->select($_REQUEST['login']);
                if (is_null($user)) {
                    MessageFlash::ajouter("warning", "login non trouvée !!");
                    header("Location: frontController.php");
                } else {
                    self::afficheVue([
                        "user" => $user,
                        "action" => "update",
                        "pagetitle" => "Modifier user",
                        "cheminVueBody" => "user/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php");
        }
    }

    public static function create()
    {
        self::afficheVue([
            "action" => "create",
            "pagetitle" => "Créer Utilisateur",
            "cheminVueBody" => "user/create.php",
        ]);
    }

    public static function updated()
    {
        if (isset($_REQUEST['login']) && isset($_REQUEST['nom']) && isset($_REQUEST['prenom']) && isset($_REQUEST['mdp']) && isset($_REQUEST['mdpN']) && isset($_REQUEST['mdpC']) && isset($_REQUEST['email'])) {
            if (ConnexionUtilisateur::estUtilisateur($_REQUEST['login']) || ConnexionUtilisateur::estAdministrateur()) {
                $user = (new UserRepository())->select($_REQUEST['login']);
                if (is_null($user)) {
                    MessageFlash::ajouter("danger", "Cet utilisateur n'existe pas !!");
                    header("Location: frontController.php");
                    exit(1);
                }
                $user->set('nom', $_REQUEST['nom']);
                $user->set('prenom', $_REQUEST['prenom']);
                $user->set('email', $_REQUEST['email']);
                if (ConnexionUtilisateur::estAdministrateur()) {
                    $password = (new UserRepository())->select(ConnexionUtilisateur::getLoginUtilisateurConnecte())->get('mdpHache');
                } else {
                    $password = $user->get('mdpHache');
                }
                if (MotDePasse::verifier($_REQUEST['mdp'], $password)) {
                    if (strlen($_REQUEST['mdpN']) > 0) {
                        if ($_REQUEST['mdpN'] == $_REQUEST['mdpC']) {
                            $user->setMdpHache($_REQUEST['mdpN']);
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
                    $emailModif = false;
                    if ($user->get('email') != $_REQUEST['email']) {
                        $emailModif = true;
                        $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
                        if (!$email) {
                            MessageFlash::ajouter('warning', "Votre nouvel email n'est pas valide");
                            self::afficheVue([
                                "user" => $user,
                                "action" => "update",
                                "pagetitle" => "Modifier Utilisateur",
                                "cheminVueBody" => "user/create.php",
                            ]);
                            exit(1);
                        } else {
                            $user->set('emailAValider', $email);
                            $user->set('nonce', MotDePasse::genererChaineAleatoire(6));
                        }
                    }
                    $bool = (new UserRepository)->update($user);
                    if ($bool) {
                        MessageFlash::ajouter("success", "utilisateur bien modifié !!");
                        if ($emailModif) {
                            VerificationEmail::envoiEmailValidation($user);
                        }
                    } else {
                        MessageFlash::ajouter("warning", "utilisateur non modifié !!");
                    }
                    header("Location: frontController.php?action=read&controller=user&login=" . rawurlencode($_REQUEST['login']));
                } else {
                    MessageFlash::ajouter("warning", "mauvais mot de passe !!");
                    self::afficheVue([
                        "user" => $user,
                        "action" => "update",
                        "pagetitle" => "Modifier Utilisateur",
                        "cheminVueBody" => "user/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("danger", "vous n'etes pas le bon utilisateur connecté !");
                header("Location: frontController.php");
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php");
        }
    }

    public static function created()
    {
        if (isset($_REQUEST['login']) && isset($_REQUEST['nom']) && isset($_REQUEST['prenom']) && isset($_REQUEST['mdp']) && isset($_REQUEST['mdp2']) && isset($_REQUEST['email'])) {
            $user = new User($_REQUEST['login'], $_REQUEST['nom'], $_REQUEST['prenom'], "", false, $_REQUEST['email'], "", "");
            if ($_REQUEST['mdp'] == $_REQUEST['mdp2']) {
                $email = filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL);
                if (!$email) {
                    MessageFlash::ajouter('warning', "Votre email n'est pas valide");
                    self::afficheVue([
                        "user" => $user,
                        "action" => "create",
                        "pagetitle" => "Créer Utilisateur",
                        "cheminVueBody" => "user/create.php",
                    ]);
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
                    header("Location: frontController.php");
                } else {
                    MessageFlash::ajouter("warning", "login deja existant !!");
                    self::afficheVue([
                        "user" => $user,
                        "action" => "create",
                        "pagetitle" => "Créer Utilisateur",
                        "cheminVueBody" => "user/create.php",
                    ]);
                }
            } else {
                MessageFlash::ajouter("warning", "les deux mots de passe doivent être égaux !!");
                self::afficheVue([
                    "user" => $user,
                    "action" => "create",
                    "pagetitle" => "Créer Utilisateur",
                    "cheminVueBody" => "user/create.php",
                ]);
            }
        } else {
            MessageFlash::ajouter("danger", "login non renseignée !!");
            header("Location: frontController.php?action=create&controller=user");
        }
    }

    public static function login()
    {
        if (ConnexionUtilisateur::estConnecte()) {
            MessageFlash::ajouter('danger', 'veuillez vous deconnectez !!');
            header('Location: frontController.php');
        } else {
            self::afficheVue([
                "pagetitle" => "Se connecter",
                "cheminVueBody" => "user/login.php",
            ]);
        }

    }

    public static function logined()
    {
        if (ConnexionUtilisateur::estConnecte()) {
            MessageFlash::ajouter('danger', 'veuillez-vous deconnecter !!');
            header('Location: frontController.php');
        } else {
            if (isset($_REQUEST['login']) && isset($_REQUEST['mdp'])) {
                $user = (new UserRepository())->select($_REQUEST['login']);
                if (!is_null($user)) {
                    if (VerificationEmail::aValideEmail($user)) {
                        if (MotDePasse::verifier($_REQUEST['mdp'], $user->get('mdpHache'))) {
                            ConnexionUtilisateur::connecter($_REQUEST['login']);
                            if (count(Panier::lirePanier()) == 0) {
                                Panier::replacePanier();
                            }
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
    }

    public static function logout()
    {
        if (ConnexionUtilisateur::estConnecte()) {
            Panier::enregistrePanier();
            ConnexionUtilisateur::deconnecter();
            MessageFlash::ajouter("success", "Vous-etes deconnecté !");
        } else {
            MessageFlash::ajouter("danger", "vous n'etes pas connecté");

        }
        header("Location: frontController.php?action=login&controller=user");
    }

    public static function validerEmail()
    {
        if (isset($_REQUEST['login']) && isset($_REQUEST['nonce'])) {
            if (VerificationEmail::traiterEmailValidation($_REQUEST['login'], $_REQUEST['nonce'])) {
                MessageFlash::ajouter("success", "Email validé !");
            } else {
                MessageFlash::ajouter("warning", "Validation failed !");
            }
        } else {
            MessageFlash::ajouter("danger", "Il manque le login et/ou le nonce !");
        }
        header("Location: frontController.php");
    }

    public static function passwordForget() { // demandeLogin
        if (ConnexionUtilisateur::estConnecte()) {
            MessageFlash::ajouter('danger', 'veuillez vous deconnectez !!');
            header('Location: frontController.php');
        } else {
            self::afficheVue([
                "pagetitle" => "Changement Mot de passe",
                "cheminVueBody" => "user/passwordForget.php",
            ]);
        }
    }

    public static function passwordForgeted() {
        if (ConnexionUtilisateur::estConnecte()) {
            MessageFlash::ajouter('danger', 'veuillez vous deconnectez !!');
            header('Location: frontController.php');
        } else {
            if (isset($_REQUEST['login'])) {
                $user = (new UserRepository())->select($_REQUEST['login']);
                if (!is_null($user)) {
                    $user->set('nonce', MotDePasse::genererChaineAleatoire(6));
                    (new UserRepository())->update($user);
                    VerificationEmail::envoiEmailChangementPassword($user);
                    MessageFlash::ajouter("success", "Un email a était envoyer à l'adresse mail enregistré !");
                    header("Location: frontController.php?action=login&controller=user");

                } else {
                    MessageFlash::ajouter("warning", "Cet utilisateur n'existe pas !");
                    header("Location: frontController.php?action=passwordForget&controller=user");
                }
            } else {
                MessageFlash::ajouter("danger", "Il manque le login !");
                header("Location: frontController.php?action=passwordForget&controller=user");
            }
        }
    }

    public static function passwordChange () { // changePassword
        if (ConnexionUtilisateur::estConnecte()) {
            MessageFlash::ajouter('danger', 'veuillez vous deconnectez !!');
            header('Location: frontController.php');
        } else {
            if (isset($_REQUEST['login']) && isset($_REQUEST['nonce'])) {
                $user = (new UserRepository())->select($_REQUEST['login']);
                if (!is_null($user)) {
                    if ($user->get('nonce') == "") {
                        MessageFlash::ajouter("danger", "Vous devez cliquez sur Forgot password ?");
                        header("Location: frontController.php?action=login&controller=user");
                    } else {
                        if ($user->get('nonce') == $_REQUEST['nonce']) {
                            self::afficheVue([
                                "login" => $user->get('login'),
                                "pagetitle" => "Se connecter",
                                "cheminVueBody" => "user/passwordChange.php",
                            ]);
                        } else {
                            MessageFlash::ajouter("warning", "Le nonce ne correspond pas");
                            header("Location: frontController.php?action=login&controller=user");
                        }
                    }
                } else {
                    MessageFlash::ajouter("warning", "Cet utilisateur n'existe pas");
                    header("Location: frontController.php?action=login&controller=user");
                }
            } else {
                MessageFlash::ajouter("danger", "Il manque le login et/ou le nonce !");
                header("Location: frontController.php?action=login&controller=user");
            }
        }
    }

    public static function passwordChanged() {
        if (ConnexionUtilisateur::estConnecte()) {
            MessageFlash::ajouter('danger', 'veuillez vous deconnectez !!');
            header('Location: frontController.php');
        } else {
            if (isset($_REQUEST['login']) && isset($_REQUEST['mdp']) && isset($_REQUEST['mdp2'])) {
                if ($_REQUEST['mdp'] == $_REQUEST['mdp2']) {
                    $user = (new UserRepository())->select($_REQUEST['login']);
                    if (!is_null($user)) {
                        $user->setMdpHache($_REQUEST['mdp']);
                        $user->set('nonce', '');
                        if ((new UserRepository())->update($user)) {
                            MessageFlash::ajouter("success", "Votre mot de passe est bien changé");
                        } else {
                            MessageFlash::ajouter("warning", "Modification échouée");
                        }
                    } else {
                        MessageFlash::ajouter("warning", "Cet utilisateur n'existe pas");
                    }
                } else {
                    MessageFlash::ajouter("warning", "les deux mots de passe doivent être égaux !!");
                }
            } else {
                MessageFlash::ajouter("danger", "Il manque le login !");
            }
            header("Location: frontController.php?action=login&controller=user");
        }
    }


}