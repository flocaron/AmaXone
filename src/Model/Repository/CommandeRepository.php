<?php

namespace App\E_Commerce\Model\Repository;

use App\E_Commerce\Model\DataObject\Commande;

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



}