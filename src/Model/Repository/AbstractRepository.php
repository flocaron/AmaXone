<?php

namespace App\E_Commerce\Model\Repository;

use App\Covoiturage\Model\Repository\DatabaseConnection;
use PDOException;


abstract class AbstractRepository
{
    protected abstract function getNomTable() : string;

    protected abstract function getNomClePrimaire(): string;

    protected abstract function getNomsColonnes(): array;

    protected abstract function construire(array $objetFormatTableau);

    public function selectAll() : array
    {
        $pdo = DatabaseConnection::getPdo();
        $query = "SELECT * FROM " . static::getNomTable() . ";";
        $pdoStatement = $pdo->query($query);
        $tab = array();
        foreach ($pdoStatement as $voitureTab) {
            $tab[] = static::construire($voitureTab);
        }
        return $tab;
    }

    public function select(string $primaryKey)
    {
        $pdo = DatabaseConnection::getPdo();
        $sql = "SELECT * from " . static::getNomTable() . " WHERE " . static::getNomClePrimaire() . " =:key";
        $rep = $pdo->prepare($sql);
        $rep->execute(array("key" => $primaryKey));
        $obj = $rep->fetch();
        if (!$obj) {
            return null;
        }
        return static::construire($obj);
    }

    public function delete(string $primaryKey): bool
    {
        try {
            $pdo = DatabaseConnection::getPDO();
            $sql = "DELETE FROM " . static::getNomTable() . "
                    WHERE " . static::getNomClePrimaire() . " = :key";
            $rep = $pdo->prepare($sql);
            $rep->execute(array(
                'key' => $primaryKey,
            ));
            if ($rep->rowCount() == 0) {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public function update($obj) : bool{
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "UPDATE " . static::getNomTable() . " SET ";
            foreach (static::getNomsColonnes() as $value) {
                if (!strcmp($value, static::getNomClePrimaire()) == 0){
                    $sql .= $value . " = :" . $value .  ' , ';
                }
            }
            $sql = rtrim($sql,", ");
            $sql .= " WHERE  " . static::getNomClePrimaire() . " = :" . static::getNomClePrimaire() . ";";
            $rep = $pdo->prepare($sql);
            $tab = $obj->formatTableau();
            $rep->execute($tab);
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }

    public function save($obj): bool
    {
        try {
            $pdo = DatabaseConnection::getPdo();
            $sql = "INSERT INTO " . static::getNomTable() . " (";
            foreach (static::getNomsColonnes() as $value) {
                $sql .= $value . " , ";
            }
            $sql = rtrim($sql,", ");
            $sql .= ") VALUES (";
            foreach (static::getNomsColonnes() as $value) {
                $sql .= ":" . $value . " , ";
            }
            $sql = rtrim($sql,", ");
            $sql .= ");";
            $rep = $pdo->prepare($sql);
            $rep->execute($obj->formatTableau());
        } catch (PDOException $e) {
            // echo $e->getMessage();
            return false;
        }
        return true;
    }


}