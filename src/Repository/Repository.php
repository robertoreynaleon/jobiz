<?php

// Un repository est une classe qui permet d'interagir avec la base de données, c'est-à-dire qu'il contient des méthodes pour effectuer des opérations de lecture, d'écriture, de mise à jour et de suppression sur les données. C'est dans ce fichier que je vais créer les méthodes de base pour interagir avec la base de données

// On utilise le namespace App\Repository pour regrouper les classes de repository de l'application et d'éviter les conflits de noms
namespace App\Repository;

use App\Db\Mysql;

class Repository
{
    protected \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Mysql::getInstance()->getPDO();
    }

}