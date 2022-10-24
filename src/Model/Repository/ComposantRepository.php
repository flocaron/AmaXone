<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\Repository\AbstractRepository;
use App\Covoiturage\Model\DataObject\Composant;

class ComposantRepository extends AbstractRepository {


    protected function getNomTable(): string
    {
        return "";
    }

    protected function getNomClePrimaire(): string
    {
        return "";
    }

    protected function getNomsColonnes(): array
    {
        return [];
    }

    protected function construire(array $objetFormatTableau)
    {

    }
}