<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\Repository\AbstractRepository;
use App\E_Commerce\Model\DataObject\User;

class UserRepository extends AbstractRepository
{
    protected function getNomTable(): string {
        return 'projet_user';
    }

    protected function getNomClePrimaire(): string {
        return 'login';
    }

    protected function getNomsColonnes(): array {
        return ['login', 'nom', 'prenom', 'email', 'mdp'];
    }

    protected function construire(array $userFormatTableau) {
        $login = $userFormatTableau['login'];
        $nom = $userFormatTableau['nom'];
        $prenom = $userFormatTableau['prenom'];
        $email = $userFormatTableau['email'];
        $mdp = $userFormatTableau['mdp'];
        return new User($login, $nom, $prenom, $email, $mdp);
    }


}