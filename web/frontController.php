<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';


$loader = new App\E_Commerce\Lib\Psr4AutoloaderClass();
$loader->addNamespace('App\E_Commerce', __DIR__ . '/../src');
$loader->register();

use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Lib\PreferenceControleur;

$action = $_REQUEST['action'] ?? 'welcome';

$controller = $_REQUEST['controller'] ?? PreferenceControleur::lire();

$controllerClassName = 'App\E_Commerce\Controller\Controller' . ucfirst($controller);

if (class_exists($controllerClassName)) {
    if (in_array($action, get_class_methods($controllerClassName))) {
        $controllerClassName::$action();
    } else {
        MessageFlash::ajouter("danger", "Action inconnue !");
        header("Location: frontController.php");
    }
} else {
    MessageFlash::ajouter("danger", "Controller inconnu  !");
    header("Location: frontController.php");
}