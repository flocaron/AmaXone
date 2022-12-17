<?php

namespace App\E_Commerce\Model\DataObject;

use App\E_Commerce\Lib\MotDePasse;

class User extends AbstractDataObject
{
    private string $login;
    private string $mdpHache;
    private string $nom;
    private string $prenom;
    private bool $estAdmin;
    private string $email;
    private string $emailAValider;
    private string $nonce;

    public function __construct(string $login, string $nom, string $prenom, string $mdpHache, bool $estAdmin, string $email, string $emailAValider, string $nonce)
    {
        $this->login = $login;
        $this->mdpHache = $mdpHache;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->estAdmin = $estAdmin;
        $this->email = $email;
        $this->emailAValider = $emailAValider;
        $this->nonce = $nonce;
    }

    public function formatTableau(): array
    {
        return array(
            "login" => $this->login,
            "mdpHache" => $this->mdpHache,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "estAdmin" => $this->estAdmin ? 1 : 0,
            "email" => $this->email,
            "emailAValider" => $this->emailAValider,
            "nonce" => $this->nonce,
        );
    }

    public function get($nom_attribut)
    {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    public function set($nom_attribut, $valeur)
    {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire): User
    {
        return new User(
            $tableauFormulaire['login'],
            $tableauFormulaire['nom'],
            $tableauFormulaire['prenom'],
            MotDePasse::hacher($tableauFormulaire['mdp']),
            isset($tableauFormulaire['estAdmin']),
            "",
            $tableauFormulaire['email'],
            MotDePasse::genererChaineAleatoire(6),
        );
    }


}
