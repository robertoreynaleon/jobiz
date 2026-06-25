<?php

// Controller est le contrôleur principal de l'application

namespace App\Controller;

class Controller
{
    protected function render(string $path, array $params = []): void
    {
        // Je teste si le tableau $params a été bien passé
        // var_dump($params);


        // Je crée une variable qui contient le chemin du fichier de la vue home.php
        // Le __DIR__ est une constante magique qui contient le chemin du dossier où se trouve le fichier courant, dans ce cas le dossier Controller
        // Le __DIR__ . '/../../' permet de remonter de deux niveaux dans l'arborescence des dossiers
        $filePath = __DIR__ . "/../../templates/$path.php";
        // echo "File path: " . $filePath . "<br>";

        if (!file_exists($filePath)) {
            // Si le fichier n'existe pas, on affiche une erreur
            http_response_code(404);
            echo "Page not found";
            return;
        } else {

            // J'extrais les variables du tableau $params pour les rendre accessibles dans la vue
            // J'utilise la fonction extract() pour transformer le tableau associatif en variables
            // Par exemple, si le tableau $params contient ['greeting' => 'Hello', 'name' => 'Nadia'], alors les variables $greeting et $name seront créées
            extract($params);

            // J'inclue le fichier de la vue home.php
            require_once $filePath;
        }
    }
}