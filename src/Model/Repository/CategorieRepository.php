<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\DataObject\Categorie;

class CategorieRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "projet_categorie";
    }

    protected function getNomClePrimaire(): string
    {
        return "nom";
    }

    protected function getNomsColonnes(): array
    {
        return ["nom", "description", "imgPath"];
    }

    protected function construire(array $objetFormatTableau)
    {
        return new Categorie(
            $objetFormatTableau['nom'],
            $objetFormatTableau['description'],
            $objetFormatTableau['imgPath'],
        );
    }
}