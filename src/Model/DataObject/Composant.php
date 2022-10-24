<?php

namespace App\E_Commerce\Model\DataObject;

class Composant extends AbstractDataObject
{

    private int $id;
    private string $libelle;
    private int $prix;
    private string $imgPath;

    public function formatTableau(): array
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'prix' => $this->prix,
            'imgPath'=>$this->imgPath,
        ];
    }

    public function __construct(int $id, string $libelle, int $prix, string $imgPath) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->imgPath = $imgPath;
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



}