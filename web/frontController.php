<?php

require_once __DIR__ . '/../src/Lib/Psr4AutoloaderClass.php';

use App\E_Commerce\Controller\ControllerComposant;


$loader = new App\E_Commerce\Lib\Psr4AutoloaderClass();
$loader->addNamespace('App\E_Commerce', __DIR__ . '/../src');
$loader->register();

$action = $_GET['action'] ?? 'readAll';

$controller = $_GET['controller'] ?? 'composants';

$controllerClassName = 'App\E_Commerce\Controller\Controller' . ucfirst($controller);

if (class_exists($controllerClassName)) {
    if (in_array($action, get_class_methods($controllerClassName))) {
        $controllerClassName::$action();
    } else {
        ControllerComposant::error("Action inconnu !!");
    }
} else {
    ControllerComposant::error("Controller inconnu !!");
}