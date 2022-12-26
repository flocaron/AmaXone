<?php

namespace App\E_Commerce\Model\DataObject;

class Commande extends AbstractDataObject
{

    private int $id;
    private string $date;
    private string $statut;
    private string $userLogin;

    public function __construct(int $id = -1, string $date = "", string $statut = "", string $userLogin = "")
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

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getStatut(): string
    {
        return $this->statut;
    }

    /**
     * @return string
     */
    public function getUserLogin(): string
    {
        return $this->userLogin;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @param string $statut
     */
    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    /**
     * @param string $userLogin
     */
    public function setUserLogin(string $userLogin): void
    {
        $this->userLogin = $userLogin;
    }



}