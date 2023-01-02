<?php

namespace App\E_Commerce\Model\DataObject;

class Produit extends AbstractDataObject
{

    private int $id;
    private string $libelle;
    private string $description;
    private int $prix;
    private string $imgPath;

    private string $categorie;

    public function __construct(int $id, string $libelle, string $description, int $prix, string $imgPath, string $categorie)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->imgPath = $imgPath;
        $this->categorie = $categorie;
    }

    public function formatTableau(): array
    {
        $formatTab = [
            'libelle' => $this->libelle,
            'description' => $this->description,
            'prix' => $this->prix,
            'imgPath' => $this->imgPath,
            'categorie' => $this->categorie,
        ];
        if ($this->id != -1) {
            $formatTab['id'] = $this->id;
        }
        return $formatTab;
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire): Produit
    {
        return new Produit(
            $tableauFormulaire['id'],
            $tableauFormulaire['libelle'],
            $tableauFormulaire['description'],
            $tableauFormulaire['prix'],
            $tableauFormulaire['imgPath'],
            $tableauFormulaire['categorie'],
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLibelle(): string
    {
        return $this->libelle;
    }

    public function getPrix(): int
    {
        return $this->prix;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;

    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setPrix(int $prix): void
    {
        $this->prix = $prix;
    }

    public function setImgPath(string $imgPath): void
    {
        $this->imgPath = $imgPath;
    }

    public function getCategorie(): string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): void
    {
        $this->categorie = $categorie;
    }


}