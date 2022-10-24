<?php

namespace App\Covoiturage\Model\DataObject;

class Voiture extends AbstractDataObject
{

    private string $marque;
    private string $couleur;
    private string $immatriculation;
    private int $nbSieges; // Nombre de places assises

    public function formatTableau(): array {
        return array(
            "marque" => $this->marque,
            "couleur" => $this->couleur,
            "nbsieges" => $this->nbSieges,
            "immatriculation" => $this->immatriculation,
        );
    }

    // un getter
    public function getMarque(): string
    {
        return $this->marque;
    }

    // un setter
    public function setMarque(string $marque): void
    {
        $this->marque = $marque;
    }

    public function getCouleur(): string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): void
    {
        $this->couleur = $couleur;
    }

    public function getImmatriculation(): string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): void
    {
        $this->immatriculation = substr($immatriculation, 0, 9);
    }

    /**
     * @return mixed
     */
    public function getNbSieges(): int
    {
        return $this->nbSieges;
    }

    /**
     * @param mixed $nbSieges
     */
    public function setNbSieges(int $nbSieges): void
    {
        $this->nbSieges = $nbSieges;
    }

    // un constructeur
    public function __construct(string $marque, string $couleur, string $immatriculation, int $nbSieges)
    {
        $this->marque = $marque;
        $this->couleur = $couleur;
        $this->immatriculation = substr($immatriculation, 0, 9);
        $this->nbSieges = $nbSieges;
    }

}
