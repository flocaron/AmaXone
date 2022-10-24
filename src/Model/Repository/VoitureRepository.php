<?php

namespace App\Covoiturage\Model\Repository;

use App\Covoiturage\Model\Repository\AbstractRepository;
use App\Covoiturage\Model\DataObject\Voiture;

use PDOException;

class VoitureRepository extends AbstractRepository
{
    protected function getNomTable(): string {
        return 'voiture';
    }

    protected function getNomClePrimaire(): string {
        return 'immatriculation';
    }

    protected function getNomsColonnes(): array {
        return ['marque', 'couleur', 'nbsieges', 'immatriculation'];
    }

    protected function construire(array $voitureFormatTableau)
    {
        $marque = $voitureFormatTableau['marque'];
        $couleur = $voitureFormatTableau['couleur'];
        $immatriculation = $voitureFormatTableau['immatriculation'];
        $nbSieges = $voitureFormatTableau['nbsieges'];
        return new Voiture($marque, $couleur, $immatriculation, $nbSieges);
    }


}