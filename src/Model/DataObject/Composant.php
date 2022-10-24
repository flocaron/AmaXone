<?php

namespace App\Covoiturage\Model\DataObject;

class Composant extends AbstractDataObject {

    private int $id;
    private string libelle


    public function formatTableau(): array
    {
        // TODO: Implement formatTableau() method.
        return [];
    }

    public function __construct(string $marque, string $couleur, string $immatriculation, int $nbSieges) {

    }

}