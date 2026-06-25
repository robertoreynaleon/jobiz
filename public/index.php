<?php
// En début de fichier pour empêcher le cache uniquement pendant le développement
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Include the Composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// On définit une constante avec le chemin de base de l'application parce que l'on va l'utiliser dans plusieurs fichiers pour inclure des fichiers
// la méthode dirname(__DIR__) permet de remonter d'un niveau dans l'arborescence des dossiers, par exemple si le fichier index.php est dans le dossier public, dirname(__DIR__) renvoie le chemin du dossier parent, qui est le dossier jobiz
define('APP_ROOT', dirname(__DIR__));
// echo "Application root path: "  .APP_ROOT . "<br>";

define('APP_ENV', ".env.local"); // .env.local est le fichier de configuration qui contient les informations de connexion à la base de données

// use App\Controller\PageController;

// $pageController = new PageController();
// $pageController->home();

use App\Routing\Router;

$router = new Router();
$router->handleRequest($_SERVER['REQUEST_URI']);
// $_SERVER['REQUEST_URI'] contient l’URL demandée par l’utilisateur, c’est-à-dire le chemin (et éventuellement la query string) après le nom de domaine.
// Si l’utilisateur visite : http://localhost/jobiz/public/jobs/ le $_SERVER['REQUEST_URI'] = /jobiz/public/jobs/
// Si l’utilisateur visite : http://localhost/jobiz/public/job/3/?foo=bar le $_SERVER['REQUEST_URI'] = /jobiz/public/job/3/?foo=bar
// Elle sert à savoir quelle page ou quelle ressource l’utilisateur veut consulter, pour que ton routeur affiche la bonne page.

use App\Db\Mysql;

// Je crée une variable où j'appelle la méthode getInstance() de la classe Mysql pour obtenir l'instance de la connexion à la base de données
// J'ai pas besoin de créer une nouvelle instance de la classe Mysql, car j'utilise le design pattern Singleton
// J'ai pas besion d'instancier la classe Mysql, car la méthode getInstance() est statique
$mysql = Mysql::getInstance();
$mysql->getPDO(); // J'appelle la méthode getPDO() pour obtenir l'instance de PDO, qui est la classe de connexion à la base de données
// var_dump($mysql->getPDO()); // Je vérifie que l'instance de PDO est bien créée et que la connexion à la base de données est établie