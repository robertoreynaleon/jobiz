<?php

namespace App\Entity;

class Entity
{
    public static function createAndHydrate(array $data): static
    {
        // La méthode createAndHydrate est une méthode statique qui permet de créer un objet de la classe courante et de l'hydrater avec les données passées en argument. Elle retourne un nouvel objet de la classe courante
        $entity = new static(); // static permet de créer un objet de la classe courante, peu importe la classe qui appelle cette méthode
        $entity->hydrate($data);
        return $entity;
    }

    // La classe Entity est une classe de base pour toutes les entités de l'application
    // Elle contient des méthodes communes à toutes les entités, comme hydrate()
    // La méthode hydrate va servir à actualiser l'objet après sa création
    // Elle va détecter s'il y a des changements dans la base de données et va mettre à jour les propriétés de l'objet avec les getters and setters
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {

            // Pour ne pas avoir de conflit avec les noms des colonnes de la base de données, on va utiliser la méthode str_replace() pour remplacer les underscores et les tirets par des espaces
            // exemple du processus de conversion => first_name => first name => First Name => FirstName => setFirstName()

            $methodName = str_replace(array('-', '_'), '', $key);// str_replace() permet de remplacer les underscores et les tirets par des chaînes vides, pour obtenir le nom de la propriété sans ces caractères
            $methodName = ucwords($methodName); // ucwords() met en majuscule la première lettre de chaque mot, pour respecter la convention de nommage des méthodes en PHP
            $methodName = str_replace(" ", "", $methodName); // on supprime les espaces
            $methodName = "set" . $methodName; // on ajoute le préfixe set pour obtenir le nom de la méthode de modification

            // Résumé du processus de conversion en une seule ligne :
            // $methodName = "set" . str_replace(['-', '_', ' '], '', ucwords(str_replace(['-', '_'], ' ', $key)));
            
            // $methodName = "set" . ucfirst($key); // ucfirst() met la première lettre en majuscule
            // $this->{$methodName}($value);

            if (!method_exists($this, $methodName)) {
                // throw new permet d'arrêter l'exécution du script et de lancer une exception
                throw new \Exception("La méthode {$methodName} n'existe pas dans la classe " . get_class($this));
            }

            // elseif ($key === 'created_at' && $value !== null) {
            //     $value = new \DateTimeImmutable($value); // On convertit la date en DateTimeImmutable si la clé est 'created_at'
            // } else {
            //     $this->{$methodName}($value);
            // }
            // Conversion spéciale pour les dates avant d'appeler le setter
            if ($key === 'created_at' && $value !== null) {
                $value = new \DateTimeImmutable($value);
            }

            // Appel du setter dans tous les cas
            $this->{$methodName}($value);
        }
    }
}
