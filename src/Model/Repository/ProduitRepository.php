<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\Repository\AbstractRepository;
use App\E_Commerce\Model\DataObject\Produit;
use PDOException;

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
        return ['libelle', 'description', 'prix', 'imgPath', 'categorie'];
    }

    protected function construire(array $objetFormatTableau): Produit
    {
        return new Produit(
            $objetFormatTableau['id'],
            $objetFormatTableau['libelle'],
            $objetFormatTableau['description'],
            $objetFormatTableau['prix'],
            $objetFormatTableau['imgPath'],
            $objetFormatTableau['categorie'],
        );
    }

    public function getProduits(string $nom): array
    {
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "SELECT * FROM " . self::getNomTable() . " WHERE categorie = :nom";
            $res = $pdo->prepare($sql);
            $res->execute(["nom" => $nom]);
            $produits = [];
            foreach ($res as $tabProduit) {
                $produits[] = (new ProduitRepository())->construire($tabProduit);
            }
            return $produits;
        } catch (PDOException) {
            return [];
        }
    }

}