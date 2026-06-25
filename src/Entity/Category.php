<?php

namespace App\Entity;

class Category extends Entity
{
    // Propriétés de la classe Category
    // Elles sont publiques pour que PDO puisse les remplir directement
    // ?int signifie que la propriété peut être un entier ou null
    // ?string signifie que la propriété peut être une chaîne de caractères ou null
    protected ?int $id = null;
    protected ?string $name = null;

    public function __construct()
    {
        // Constructeur vide pour permettre à PDO de créer l'objet
        // PDO remplira automatiquement les propriétés après la création
    }

    // Méthodes pour accéder aux propriétés de la classe
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    // Méthodes pour modifier les propriétés de la classe
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

}