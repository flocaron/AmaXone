<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\DataObject\Commande;
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
                $sql .= "((SELECT id FROM projet_commande WHERE userLogin = :login ORDER BY id DESC LIMIT 1), ";
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

    public function getCommandeParLogin(string $login) : array {
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "SELECT * FROM projet_commande WHERE userLogin = :login ;";
            $statement = $pdo->prepare($sql);
            $statement->execute(["login" => $login]);
            $commandes = [];
            foreach ($statement as $formatTab) {
                $commandes[] = static::construire($formatTab);
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
            $sql = "SELECT * FROM projet_commandeProduit WHERE idCommande = :id";

            // $sql = "SELECT *(prod), quantite
            // FROM projet_produit p
            // JOIN projet_commandeProduit c ON p.id = c.idProduit
            // WHERE idCommande = :id";

            $rep = $pdo->prepare($sql);
            $rep->execute(["id" => $idCommande]);
            $produits = [];
            foreach ($rep as $row) {
                $produits[$row["idProduit"]] = $row["quantite"];
            }
            return $produits;
        } catch (PDOException) {
            return [];
        }
    }


}