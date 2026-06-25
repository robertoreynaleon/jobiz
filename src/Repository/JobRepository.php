<?php

namespace App\Repository;

use App\Entity\Job;

class JobRepository extends Repository
{
    public function findAll(): array
    {
        $query = "
            SELECT j.id, j.title, j.description, j.salary, j.category_id, c.name AS category_name, j.created_at
            FROM job j
            LEFT JOIN category c ON j.category_id = c.id
            ORDER BY j.created_at DESC
        ";
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
        $query = "
            SELECT j.id, j.title, j.description, j.salary, j.category_id, c.name AS category_name, j.created_at
            FROM job j
            LEFT JOIN category c ON j.category_id = c.id
            WHERE j.id = :id
        ";
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

    public function create(Job $job): bool
    {
        $query = "
            INSERT INTO job (title, description, salary, category_id, created_at)
            VALUES (:title, :description, :salary, :category_id, NOW())
        ";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $job->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue(':description', $job->getDescription(), \PDO::PARAM_STR);
        $this->bindNullableFloat($statement, ':salary', $job->getSalary());
        $this->bindNullableInt($statement, ':category_id', $job->getCategoryId());

        return $statement->execute();
    }

    public function update(Job $job): bool
    {
        $query = "
            UPDATE job
            SET title = :title,
                description = :description,
                salary = :salary,
                category_id = :category_id
            WHERE id = :id
        ";

        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $job->getId(), \PDO::PARAM_INT);
        $statement->bindValue(':title', $job->getTitle(), \PDO::PARAM_STR);
        $statement->bindValue(':description', $job->getDescription(), \PDO::PARAM_STR);
        $this->bindNullableFloat($statement, ':salary', $job->getSalary());
        $this->bindNullableInt($statement, ':category_id', $job->getCategoryId());

        return $statement->execute();
    }

    public function delete(int $id): bool
    {
        $query = "DELETE FROM job WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);

        return $statement->execute();
    }

    private function bindNullableInt(\PDOStatement $statement, string $parameter, ?int $value): void
    {
        if ($value === null) {
            $statement->bindValue($parameter, null, \PDO::PARAM_NULL);
            return;
        }

        $statement->bindValue($parameter, $value, \PDO::PARAM_INT);
    }

    private function bindNullableFloat(\PDOStatement $statement, string $parameter, ?float $value): void
    {
        if ($value === null) {
            $statement->bindValue($parameter, null, \PDO::PARAM_NULL);
            return;
        }

        $statement->bindValue($parameter, $value);
    }

}
