<?php

namespace App\Db;

class Mysql
{
    // Je crée une instance statique de la classe Mysql pour implémenter le design pattern Singleton
    // Cela permet de s'assurer qu'il n'y a qu'une seule instance de la classe, ça veut dire qu'il n'y aura qu'une seule connexion à la base de données
    private static ?self $_instance = null;

    // Je déclare des attributs privés pour stocker les informations de connexion à la base de données
    private string $dbName;
    private string $dbUser;
    private string $dbPassword;
    private string $dbHost;
    private string $dbPort;

    // Je déclare un attribut privé pour stocker l'instance de PDO, qui est la classe de connexion à la base de données
    private ?\PDO $pdo = null;

     private function __construct()
    {
        // Le constructeur est privé pour empêcher l'instanciation directe de la classe
        // On peut initialiser la connexion à la base de données ici si nécessaire
        // La méthode parse_ini_file() permet de lire un fichier de configuration au format INI et de le convertir en tableau associatif

        $dbConf = parse_ini_file(APP_ROOT ."/". APP_ENV); // Je lis le fichier de configuration
        // var_dump($dbConf); // Je vérifie le contenu du tableau associatif $dbConf
        
        // Je récupère les informations de connexion à la base de données depuis le fichier .env
        $this->dbName = $dbConf['db_Name'];
        $this->dbUser = $dbConf['db_User'];
        $this->dbPassword = $dbConf['db_Password'];
        $this->dbHost = $dbConf['db_Host'];
        $this->dbPort = $dbConf['db_Port'];

    }

    
    public static function getInstance(): self
    {
        // La méthode getInstance() est statique et permet d'obtenir l'instance de la classe Mysql
        // Si l'instance n'existe pas, on la crée sinon, on retourne l'instance existante
        // new self() est une façon de créer une nouvelle instance de la classe Mysql
        // On utilise self() pour faire référence à la classe courante, c'est-à-dire la classe Mysql

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    // \PDO est la classe de connexion à la base de données en PHP
    // C'est une classe du PHP Data Objects (PDO) qui permet d'interagir avec différentes bases de données

    public function getPDO(): \PDO
    {
        if(is_null($this->pdo)) {
            // Si l'instance de PDO n'existe pas, on la crée
            // On utilise le DSN (Data Source Name) pour spécifier le type de base de données, l'hôte, le nom de la base de données et le port
            // On utilise les informations de connexion à la base de données stockées dans les attributs
            // L'user et le mot de passe sont passés en paramètres du constructeur de la classe PDO

                $this->pdo = new \PDO(
                    "mysql:host={$this->dbHost};dbname={$this->dbName};port={$this->dbPort};charset=utf8mb4",
                    $this->dbUser,
                    $this->dbPassword,
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    ]
                );
            }
        return $this->pdo;
    }

}
