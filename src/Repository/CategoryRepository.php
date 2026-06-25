<?php

// CategoryRepository.php permet d'interagir avec la table "categories" de la base de données.

namespace App\Repository;

use App\Entity\Category;

class CategoryRepository extends Repository
{
    // Cette méthode permet de récupérer toutes les données de la table "category"
    // Elle retourne un tableau d'objets de type Category
    public function findAll(): array
    {
        $query = "SELECT id, name FROM category";
        $statement = $this->pdo->prepare($query); //la méthode prepare() prépare une requête SQL pour l'exécution
        $statement->execute(); // la méthode execute() exécute la requête préparée et retourne un booléen indiquant si la requête a réussi ou non
        
        // La méthode fetchAll() permet de récupérer toutes les lignes de résultats sous forme d'un tableau
        // \PDO::FETCH_CLASS permet de récupérer les résultats sous forme d'objets de la classe spécifiée, ici 'Category::class'
        // Chaque ligne de la table "category" sera convertie en un objet de la classe Category
        // Les propriétés de l'objet seront remplies avec les valeurs des colonnes correspondantes de la table "category"

        // Hydratation automatique des objets Category par PDO (PHP Data Objects)
        // $categories = $statement->fetchAll(\PDO::FETCH_CLASS, Category::class);

        // Hydratation manuelle des objets Category
        $categories = $statement->fetchAll(\PDO::FETCH_ASSOC); // Récupère toutes les lignes sous forme de tableau associatif

        $categoriesArray = [];
        foreach ($categories as $data) {
            // On crée un nouvel objet Category pour chaque ligne de résultat
            // On utilise la méthode createAndHydrate() de la classe Entity pour hydrater l'objet avec les données récupérées
            $categoriesArray[] = Category::createAndHydrate($data);
        }
        
        return $categoriesArray; // Retourne un tableau d'objets Category
        
    }

    public function findById(int $id): ?Category
    {
            // :id est un paramètre nommé qui sera remplacé par la valeur de l'ID passé en argument
            // On utilise un paramètre nommé pour éviter les injections SQL et pour rendre la requête plus lisible
            $query = "SELECT id, name FROM category WHERE id = :id";
            $statement = $this->pdo->prepare($query);
            
            // LA méthode bindValue() permet de lier une valeur à un paramètre nommé dans la requête préparée
            // \PDO::PARAM_INT indique que le paramètre est de type entier
            $statement->bindValue(':id', $id, \PDO::PARAM_INT);
            $statement->execute();

            // Hydratation automatique
            // fetchObject() retourne qu'UN objet Category ou false si aucun résultat
            // Dans ce cas l'objet Category sera créé avec les données récupérées de la base de données, ça veut dire que le onjet est hydraté automatiquement
            // $category= $statement->fetchObject(Category::class);

            // Hydratation manuelle
            // fetchAssoc() retourne un tableau associatif contenant les données de la ligne récupérée
            // On utilise cette méthode pour récupérer les données du tableau et les stocker dans la variable $data 
            // Cela me permettra de hydrater manuellement l'objet Category et avoir plus de contrôle sur les données saisies
            $data = $statement->fetch(\PDO::FETCH_ASSOC);

            // On crée un nouvel objet Category
            // $category = new Category();
            
            // Dans ce cas, on utilise la méthode hydrate() de la classe Entity et on fait l'hydratation manuellement
            // On hydrate l'objet Category avec les données récupérées
            // $category->hydrate($data);

            // On peut simplifier les deux derniers pas en faisant directement l'hydratation dans la méthode createAndHydrate() de la classe Entity
            $category = Category::createAndHydrate($data);

            // Retourner l'objet Category ou null si rien trouvé
            return $category ?: null;
    }

    // Méthode pour insérer des données dans la table "category"
    public function persist(Category $category): bool
    {
        if ($category->getId()) {
            // Si l'ID est déjà défini, on ne peut pas insérer une nouvelle catégorie

        } else {
            // Si l'ID n'est pas défini, on peut insérer une nouvelle catégorie
            $query = "INSERT INTO category (name) VALUES (:name)";
            $statement = $this->pdo->prepare($query);
            $statement->bindValue(':name', $category->getName(), \PDO::PARAM_STR);

        }

        return $statement->execute();
    }

}
