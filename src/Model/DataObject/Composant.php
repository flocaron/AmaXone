<?php

namespace App\E_Commerce\Model\DataObject;

class Composant extends AbstractDataObject
{

    private int $id;
    private string $libelle;
    private string $description;
    private int $prix;
    private string $imgPath;

    public function __construct(string $libelle, string $description, int $prix, string $imgPath, int $id = 0) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->prix = $prix;
        $this->imgPath = $imgPath;
    }

    public function formatTableau(): array
    {
        return [
            'libelle' => $this->libelle,
            'description' => $this->description,
            'prix' => $this->prix,
            'imgPath' => $this->imgPath,
        ];
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire): Composant
    {
        return new Composant(
            $tableauFormulaire['libelle'],
            $tableauFormulaire['description'],
            $tableauFormulaire['prix'],
            $tableauFormulaire['imgPath'],
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @return int
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    public function getImgPath(): string
    {
        return $this->imgPath;

    }

    public function getDescription() : string {
        return $this->description;
    }



}