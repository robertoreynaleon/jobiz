<?php

// On utilise le namespace App\Controller pour regrouper les contrôleurs de l'application et d'éviter les conflits de noms
// App est le nom de l'application, et Controller est le dossier où se trouvent les contrôleurs
namespace App\Controller;

class ErrorController extends Controller
{
    public function notFound(): void
    {
        // Appel de la méthode render pour afficher la vue 404.php
        $this->render("error/404");
    }

}