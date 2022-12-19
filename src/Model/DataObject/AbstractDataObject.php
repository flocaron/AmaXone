<?php

namespace App\E_Commerce\Model\DataObject;

abstract class AbstractDataObject
{
    public abstract function formatTableau(): array;

    public abstract static function construireDepuisFormulaire(array $tableauFormulaire) : mixed;

}