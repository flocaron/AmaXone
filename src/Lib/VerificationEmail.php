<?php

namespace App\E_Commerce\Lib;

use App\E_Commerce\Config\Conf;
use App\E_Commerce\Lib\MessageFlash;
use App\E_Commerce\Model\DataObject\User;
use App\E_Commerce\Model\Repository\UserRepository;

class VerificationEmail
{
    public static function envoiEmailValidation(User $utilisateur): void
    {
        $loginURL = rawurlencode($utilisateur->get('login'));
        $nonceURL = rawurlencode($utilisateur->get('nonce'));
        $absoluteURL = Conf::getAbsoluteURL();
        $lienValidationEmail = "$absoluteURL?action=validerEmail&controller=user&login=$loginURL&nonce=$nonceURL";
        $corpsEmail = "<a href='$lienValidationEmail'>Validation</a>";

        // MessageFlash::ajouter('info', $corpsEmail);
        mail($utilisateur->get('emailAValider'), "Validation", $corpsEmail);
    }

    public static function traiterEmailValidation($login, $nonce): bool
    {
        $user = (new UserRepository())->select($login);
        $verif = false;
        if (!is_null($user)) {
            $verif = $user->get('nonce') == $nonce;
            if ($verif) {
                $user->set('nonce', '');
                $user->set('email', $user->get('emailAValider'));
                $user->set('emailAValider', '');
                (new UserRepository())->update($user);
            }
        }
        return $verif;
    }

    public static function aValideEmail(User $utilisateur) : bool
    {
        return $utilisateur->get('email') != "";
    }
}