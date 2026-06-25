<?php

namespace App\Entity;

use DateTimeImmutable; // DateTimeImmutable est utilisé pour gérer les dates de manière immuable

class Job extends Entity
{
    protected ?int $id = null;
    protected ?string $title = null;
    protected ?string $description = null;
    protected ?float $salary = null;
    protected ?int $countryId = null;
    protected ?int $companyID = null;
    protected ?DateTimeImmutable $createdAt = null; // DateTimeImmutable permet de gérer les dates de manière immuable.

    public function __construct()
    {
        // Constructeur vide pour permettre à PDO de créer l'objet
        // PDO remplira automatiquement les propriétés après la création
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function getCountryId(): ?int
    {
        return $this->countryId;
    }

    public function getCompanyId(): ?int
    {
        return $this->companyID;
    }

    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setSalary(?float $salary): void
    {
        $this->salary = $salary;
    }

    public function setCountryId(?int $countryId): void
    {
        $this->countryId = $countryId;
    }

    public function setCompanyId(?int $companyId): void
    {
        $this->companyID = $companyId;
    }

    public function setCreatedAt($createdAt): void
    {
        if ($createdAt instanceof DateTimeImmutable) {
            $this->createdAt = $createdAt;
        } elseif (is_string($createdAt) && $createdAt !== null) {
            $this->createdAt = new DateTimeImmutable($createdAt);
        } else {
            $this->createdAt = null;
        }
    }




}