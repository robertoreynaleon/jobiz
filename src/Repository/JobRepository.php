<?php

namespace App\Repository;

use App\Entity\Job;

class JobRepository extends Repository
{
    public function findAll(): array
    {
        $query = "SELECT id, title, description, salary, created_at FROM job";
        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $jobs = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $jobsArray = [];
        foreach ($jobs as $data) {
            $jobsArray[] = Job::createAndHydrate($data);
        }

        return $jobsArray;
    }

    public function findById(int $id): Job|bool
    {
        $query = "SELECT id, title, description, salary, created_at FROM job WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetch(\PDO::FETCH_ASSOC);

        if ($data){
            $job = Job::createAndHydrate($data);
            return $job;
        }

        return false; // Si aucune offre d'emploi n'est trouvée, retourne false
    }

}
