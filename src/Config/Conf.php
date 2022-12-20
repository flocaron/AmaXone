<?php

namespace App\E_Commerce\Config;

class Conf
{

    static private array $databases = array(
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        'database' => 'caronf',
        'login' => 'caronf',
        'password' => '080087921DC'
    );
    private static $debug = false;

    static public function getLogin(): string
    {
        return self::$databases['login'];
    }

    static public function getHostname(): string
    {
        return self::$databases['hostname'];
    }

    static public function getDatabase(): string
    {
        return self::$databases['database'];
    }

    static public function getPassword(): string
    {
        return self::$databases['password'];
    }

    static public function getAbsoluteURL() : string
    {
        return "https://webinfo.iutmontp.univ-montp2.fr/~caronf/e-commerce/web/frontController.php";
    }

    static public function getDebug() : string
    {
        return self::$debug;
    }

}
