<?php

namespace App\E_Commerce\Controller;

use App\E_Commerce\Lib\MessageFlash;

abstract class AbstractController
{
    protected static function afficheVue(array $parametres = []): void {
        $parametres["msgFlash"] = MessageFlash::lireTousMessages();
        extract($parametres); // Crée des variables à partir du tableau $parametres
        require "../src/View/view.php"; // Charge la vue
    }

    public abstract static function readAll();

    public abstract static function read();

    public abstract static function delete();

    public abstract static function create();

    public abstract static function created();

    public abstract static function update();

    public abstract static function updated();


}