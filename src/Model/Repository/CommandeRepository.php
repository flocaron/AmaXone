<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\DataObject\Commande;
use App\E_Commerce\Model\DataObject\Produit;
use PDOException;

class CommandeRepository extends AbstractRepository
{

    protected function getNomTable(): string
    {
        return "projet_commande";
    }

    protected function getNomClePrimaire(): string
    {
        return "id";
    }

    protected function getNomsColonnes(): array
    {
        return [
            "date",
            "statut",
            "userLogin"
        ];
    }

    protected function construire(array $objetFormatTableau): Commande
    {
        return new Commande(
            $objetFormatTableau["id"],
            $objetFormatTableau["date"],
            $objetFormatTableau["statut"],
            $objetFormatTableau["userLogin"]
        );
    }

    public function enregistrerCommande(string $login, array $panier) : bool
    {
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "INSERT INTO projet_commandeProduit (idCommande, idProduit, quantite) VALUES ";
            $i = 0;
            foreach ($panier as $ignored) {
                $sql .= "((SELECT MAX(id) FROM projet_commande WHERE userLogin = :login), ";
                $sql .= " :idProduit$i, :quantite$i ) ,";
                $i++;
            }
            $sql = rtrim($sql, ", ");
            $rep = $pdo->prepare($sql);
            $data["login"] = $login;
            $i = 0;
            foreach ($panier as $idProduit => $qte) {
                $data["idProduit$i"] = $idProduit;
                $data["quantite$i"] = $qte;
                $i++;
            }
            $rep->execute($data);
        } catch (PDOException) {
            return false;
        }
        return true;
    }

    public function getCommandeParLogin(string $login) : array
    {
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "SELECT c.id, c.date, c.statut, c.userLogin, p.id AS idProduit, p.libelle, p.description, p.prix, p.imgPath, p.categorie, cp.quantite
                    FROM projet_commande c
                    JOIN projet_commandeProduit cp ON c.id = cp.idCommande
                    JOIN projet_produit p ON p.id = cp.idProduit
                    WHERE userLogin = :login ;";
            $rep = $pdo->prepare($sql);
            $rep->execute(["login" => $login]);
            $commandes = [];
            foreach ($rep as $tab) {
                $commandes[serialize(static::construire($tab))][] = [
                    serialize(new Produit(
                        $tab['idProduit'],
                        $tab['libelle'],
                        $tab['description'],
                        $tab['prix'],
                        $tab['imgPath'],
                        $tab['categorie']
                    )) => $tab['quantite']
                ];
            }
            return $commandes;
        } catch (PDOException) {
            return [];
        }
    }

    public function getProduitParCommande(int $idCommande) : array
    {
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "SELECT p.id, p.libelle, p.description, p.prix, p.imgPath, p.categorie, cp.quantite
                    FROM projet_commandeProduit cp
                    JOIN projet_produit p ON p.id = cp.idProduit
                    WHERE cp.idCommande = :idCommande ;";
            $rep = $pdo->prepare($sql);
            $rep->execute(["idCommande" => $idCommande]);
            $produits = [];
            foreach ($rep as $tab) {
                $produits[serialize((new ProduitRepository)->construire($tab))] = $tab['quantite'];
            }
            return $produits;
        } catch (PDOException) {
            return [];
        }
    }

}