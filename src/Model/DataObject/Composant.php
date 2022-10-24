<?php

namespace App\Covoiturage\Model\DataObject;

class Composant extends AbstractDataObject {

    private int $id;
    private string $libelle;
    private int $prix;

    public function formatTableau(): array
    {
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'prix' => $this->prix,
        ];
    }

    public function __construct(int $id, string $libelle, int $prix) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->prix = $prix;
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



}