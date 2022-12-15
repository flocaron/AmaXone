<?php

namespace App\Covoiturage\Model\HTTP;

use App\Covoiturage\Config\Conf;
use App\Covoiturage\Lib\ConnexionUtilisateur;
use App\Covoiturage\Lib\MessageFlash;
use Exception;

class Session
{
    private static ?Session $instance = null;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        if (session_start() === false) {
            throw new Exception("La session n'a pas réussi à démarrer.");
        }
    }

    public static function getInstance(): Session
    {
        if (is_null(static::$instance))
            static::$instance = new Session();
        return static::$instance;
    }

    public function contient($name): bool
    {
        return isset($_SESSION[$name]);
    }

    public function enregistrer(string $name, mixed $value): void
    {
        $_SESSION[$name] = $value;
    }

    public function lire(string $name): mixed
    {
        return $_SESSION[$name];
    }

    public function supprimer($name): void
    {
        if (static::$instance->contient($name)) {
            unset($_SESSION[$name]);
        }
    }

    public function detruire(): void
    {
        session_unset();     // unset $_SESSION variable for the run-time
        session_destroy();   // destroy session data in storage
        Cookie::supprimer(session_name()); // deletes the session cookie
        // Il faudra reconstruire la session au prochain appel de getInstance()
        static::$instance = null;
    }

    public function verifierDerniereActivite() {
        if (isset($_SESSION['derniereActivite']) && (time() - $_SESSION['derniereActivite'] > (Conf::$dureeExpiration))) {
            if (ConnexionUtilisateur::estConnecte()) {
                ConnexionUtilisateur::deconnecter();
                MessageFlash::ajouter("info", "Vous etes deconnecté !");
                header("Location: frontController.php?action=login&controller=user");
            }
        } else {
            $_SESSION['derniereActivite'] = time(); // update last activity time stamp
        }
    }


}