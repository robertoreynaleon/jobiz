<?php

// Router est la classe qui gère les routes de l'application

namespace App\Routing;

use App\Controller\ErrorController; // On importe le contrôleur d'erreur pour gérer les erreurs 404

class Router
{
    private $routes;

    public function __construct()
    {
        // On stocke les routes de l'application dans un tableau associatif
        $this->routes = require_once APP_ROOT . "/config/routes.php";

    }

    public function handleRequest(string $uri): void
    {
        $path = self::normalizedPath($uri); // On normalise le chemin de l'URI pour éviter les problèmes de correspondance
        // $path est le chemin de l'URI normalisé, par exemple "/home/" ou "/about/"
        
        // On vérifie si la route existe
        // La méthode isset() permet de vérifier si une clé existe dans le tableau $this->routes
        if (isset($this->routes[$path])) {

            //$route est un tableau associatif qui contient les informations de la route, par exemple :
            // [
            //     "controller" => "App\\Controller\\PageController",
            //     "action" => "home"
            // ]
            $route = $this->routes[$path];
            
            // On extrait le nom du contrôleur et de l'action
            $controllerName = $route['controller']; // Je stocke le chemin du contrôleur là, qui est un namespace, qui est une class
            $actionName = $route['action']; // Je stocke le nom de l'action (méthode) à appeler
        
            // On instancie le contrôleur et on appelle l'action correspondante
            $controller = new $controllerName(); // J'instancie mon contrôleur en utilisant le nom de la classe du contrôleur

            // method_exists() est une fonction PHP qui permet de vérifier si une méthode existe dans une classe
            if (method_exists($controller, $actionName)) {
                $controller->$actionName();
            } else {
                // http_response_code(404);
                // echo "Action '$actionName' not found in controller '$controllerName'";
                // On utilise le contrôleur d'erreur pour afficher la page 404
                $errorController = new ErrorController();
                $errorController->notFound();

            }
        } else {
            // Si aucune route ne correspond, on renvoie une erreur 404
            // http_response_code(404);
            // echo "<h1>404 - Page not found</h1>";
            // echo "<p>The requested page '$path' does not exist.</p>";

            // On utilise le contrôleur d'erreur pour afficher la page 404
            $errorController = new ErrorController();
            $errorController->notFound();

        }
    }

    public static function normalizedPath(string $uri): string
    {
        // On normalise le chemin en supprimant les slashs finaux et en ajoutant un slash final
        $path = parse_url($uri, PHP_URL_PATH); // la fonction parse_url() permet d'extraire le chemin de l'URL et de le nettoyer. PHP_URL_PATH permet d'obtenir uniquement le chemin de l'URL sans les paramètres de requête.
        $path = rtrim($path, '/')."/"; // Supprime le slash final pour éviter les problèmes de correspondance
        return $path;
    }

    public static function isActiveRoute(string $path): bool
    {
        // // Pour vrifier quelle est la route. 
        // var_dump(self::normalizedPath($_SERVER['REQUEST_URI'])); // Affiche le chemin normalisé de l'URI actuelle
        // return true; // Retourne true si la route est active, sinon false

        return self::normalizedPath($_SERVER['REQUEST_URI']) === $path;
    }

}