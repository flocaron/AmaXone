<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\Repository\AbstractRepository;
use App\E_Commerce\Model\DataObject\Composant;

class ComposantRepository extends AbstractRepository {


    protected function getNomTable(): string
    {
        return "projet_composant";
    }

    protected function getNomClePrimaire(): string
    {
        return "id";
    }

    protected function getNomsColonnes(): array
    {
        return ['id', 'libelle', 'prix'];
    }

    protected function construire(array $objetFormatTableau)
    {
        $id = $objetFormatTableau['id'];
        $libelle = $objetFormatTableau['libelle'];
        $prix = $objetFormatTableau['prix'];
        return new Composant($id, $libelle, $prix);

    }
}