<?php

namespace App\E_Commerce\Model\DataObject;

class Commande extends AbstractDataObject
{

    private int $id;
    private string $date;
    private string $statut;
    private string $userLogin;

    public function __construct(int $id, string $date, string $statut, string $userLogin)
    {
        $this->id = $id;
        $this->date = $date;
        $this->statut = $statut;
        $this->userLogin = $userLogin;
    }

    public function formatTableau(): array
    {
        $formatTab = [
            'date' => $this->date,
            'statut' => $this->statut,
            'userLogin' => $this->userLogin,
        ];
        if ($this->id != -1) {
            $formatTab['id'] = $this->id;
        }
        return $formatTab;
    }

    public static function construireDepuisFormulaire(array $tableauFormulaire): mixed
    {
        return new Commande(
            $tableauFormulaire["id"],
            $tableauFormulaire["date"],
            $tableauFormulaire["statut"],
            $tableauFormulaire["userLogin"]
        );
    }
}