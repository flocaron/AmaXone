<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\Repository\AbstractRepository;
use App\E_Commerce\Model\DataObject\Produit;

class ProduitRepository extends AbstractRepository {


    protected function getNomTable(): string
    {
        return "projet_produit";
    }

    protected function getNomClePrimaire(): string
    {
        return "id";
    }

    protected function getNomsColonnes(): array
    {
        return ['libelle', 'description', 'prix', 'imgPath'];
    }

    protected function construire(array $objetFormatTableau): Produit
    {
        return new Produit(
            $objetFormatTableau['id'],
            $objetFormatTableau['libelle'],
            $objetFormatTableau['description'],
            $objetFormatTableau['prix'],
            $objetFormatTableau['imgPath'],
        );
    }


}