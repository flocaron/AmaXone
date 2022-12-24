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

    protected function construire(array $objetFormatTableau)
    {
        $id = $objetFormatTableau['id'];
        $libelle = $objetFormatTableau['libelle'];
        $description = $objetFormatTableau['description'];
        $prix = $objetFormatTableau['prix'];
        $img = $objetFormatTableau['imgPath'];
        return new Produit($id, $libelle, $description, $prix, $img);

    }
}