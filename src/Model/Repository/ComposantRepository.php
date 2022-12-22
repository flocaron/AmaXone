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
        return ['libelle', 'description', 'prix', 'imgPath'];
    }

    protected function construire(array $objetFormatTableau)
    {
        $id = $objetFormatTableau['id'];
        $libelle = $objetFormatTableau['libelle'];
        $description = $objetFormatTableau['description'];
        $prix = $objetFormatTableau['prix'];
        $img = $objetFormatTableau['imgPath'];
        return new Composant($id, $libelle, $description, $prix, $img);

    }
}