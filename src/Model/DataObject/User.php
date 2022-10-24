<?php

namespace App\E_Commerce\Model\DataObject;

class User extends AbstractDataObject
{
    private string $login;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $mdp;

    public function formatTableau(): array {
        return array(
            "login" => $this->login,
            "nom" => $this->nom,
            "prenom" => $this->prenom,
            "email" => $this->email,
            "mdp" => $this->mdp,
        );
    }

    public function get($nom_attribut) {
        if (property_exists($this, $nom_attribut))
            return $this->$nom_attribut;
        return false;
    }

    public function set($nom_attribut, $valeur) {
        if (property_exists($this, $nom_attribut))
            $this->$nom_attribut = $valeur;
        return false;
    }

    public function __construct(string $login, string $nom, string $prenom, string $mdp, string $email) {
        $this->login = $login;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->mdp = $mdp;
    }

}
