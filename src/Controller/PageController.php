<?php

// On utilise le namespace App\Controller pour regrouper les contrôleurs de l'application et d'éviter les conflits de noms
// App est le nom de l'application, et Controller est le dossier où se trouvent les contrôleurs
namespace App\Controller;

// J'inclus CategoryRepository pour pouvoir affciher des données de la table "categories"
use App\Repository\CategoryRepository;
use App\Entity\Category;

class PageController extends Controller
{
    public function home(): void
    {
        // Récupérer toutes les catégories
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();
        // var_dump($categories); // Cela affichera la structure complète des catégories récupérées

        // Je peux aussi récupérer une catégorie par son ID
        // $categorie = $categoryRepository->findById(1);
        // var_dump($categorie); // Cela affichera la structure complète de la catégorie avec l'ID 1

        // Exemple de création d'une catégorie
        // $category = new Category();
        // $category->setName("Nouvelle Catégorie");
        // // Ici, je pourrais appeler une méthode pour enregistrer cette catégorie dans la base de données si nécessaire
        // $res = $categoryRepository->persist($category);
        // var_dump($res); // Cela affichera le résultat de l'opération de persistance



        // Appel de la méthode render pour afficher la vue home.php
        // Je passe en tant qu'arguments le dossier page et le nom de la vue home + le tableau associatif contenant les variables à utiliser dans la vue
        $this->render("page/home", [
            "categories" => $categories // Je passe les catégories récupérées à la vue
        ]);

    }


    public function about(): void
    {
        // Appel de la méthode render pour afficher la vue about.php
        $this->render("page/about");
    }

}