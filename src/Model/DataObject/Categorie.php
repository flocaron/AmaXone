<?php

namespace App\E_Commerce\Model\DataObject;

class Categorie extends AbstractDataObject
{

    private string $nom;
    private string $description;
    private string $imgPath;

    public function __construct(string $nom = "", string $description = "", string $imgPath = "")
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->imgPath = $imgPath;
    }

    public function formatTableau(): array
    {
        return [
            "nom" => $this->nom,
            "description" => $this->description,
            "imgPath" => $this->imgPath,
        ];
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire): Categorie
    {
        return new Categorie(
            $tableauFormulaire['nom'],
            $tableauFormulaire['description'],
            $tableauFormulaire['imgPath'],
        );
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;
    }

    public function setImgPath(string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }


}