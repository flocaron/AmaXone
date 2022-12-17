<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';


$loader = new App\E_Commerce\Lib\Psr4AutoloaderClass();
$loader->addNamespace('App\E_Commerce', __DIR__ . '/../src');
$loader->register();

use App\E_Commerce\Controller\ControllerComposant;
use App\E_Commerce\Controller\ControllerUser;
use App\E_Commerce\Controller\GenericController;
use App\E_Commerce\Lib\PreferenceControleur;

$action = $_REQUEST['action'] ?? 'welcome';

$controller = $_REQUEST['controller'] ?? PreferenceControleur::lire();

$controllerClassName = 'App\E_Commerce\Controller\Controller' . ucfirst($controller);

if (class_exists($controllerClassName)) {
    if (in_array($action, get_class_methods($controllerClassName))) {
        $controllerClassName::$action();
    } else {
        GenericController::error("Action inconnu !!");
    }
} else {
    GenericController::error("Controller inconnu !!");
}