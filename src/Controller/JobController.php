<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\CategoryRepository;
use App\Repository\JobRepository;

use Exception;

class JobController extends Controller
{
    public function list(): void
    {

        $jobRepository = new JobRepository();
        $categoryRepository = new CategoryRepository();
        // Récupération de toutes les offres d'emploi depuis le repository

        $jobs = $jobRepository->findAll(); // Ici, je vais récupérer les offres d'emploi depuis la base de données
        $categories = $categoryRepository->findAll();
        // var_dump($jobs); // Pour vérifier que les données sont récupérées correctement

        $this->render("job/list", [
            "jobs" => $jobs, // Ici, je vais récupérer les offres d'emploi depuis la base de données
            "categories" => $categories
        ]);
    }

    public function show(): void
    {
        try {
            if (isset($_GET["id"])) {
                $id = (int)$_GET["id"]; // Récupération de l'ID de l'offre d'emploi depuis les paramètres GET
                $jobRepository = new JobRepository();
                // Récupération de l'offre d'emploi par son ID
                $job = $jobRepository->findById($id);
                // Vérification si l'offre d'emploi existe
                // var_dump($job); // Pour vérifier que l'offre d'emploi est récupérée correctement

                if ($job) {
                    $this->render("job/show", [
                        "job" => $job
                    ]);
                } else {
                    throw new Exception("L'offre d'emploi demandée n'existe pas.");
                }
            } else {
                throw new Exception("L'ID de l'offre d'emploi n'est pas spécifié.");
            }
        } catch (\Exception $e) {
            // Gérer l'erreur si l'ID n'est pas valide ou si l'offre d'emploi n'existe pas
            $this->render("error/404", [
                "message" => "L'offre d'emploi demandée n'existe pas."
            ]);
        }
    }

    public function create(): void
    {
        $categoryRepository = new CategoryRepository();

        $this->render("job/form", [
            "job" => new Job(),
            "categories" => $categoryRepository->findAll(),
            "formAction" => "/job/store/",
            "submitLabel" => "Créer l'offre"
        ]);
    }

    public function store(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /job/create/");
            exit;
        }

        $job = $this->createJobFromPost();
        $jobRepository = new JobRepository();
        $jobRepository->create($job);

        header("Location: /jobs/");
        exit;
    }

    public function edit(): void
    {
        if (!isset($_GET["id"])) {
            $this->render("error/404", [
                "message" => "L'ID de l'offre d'emploi n'est pas spécifié."
            ]);
            return;
        }

        $jobRepository = new JobRepository();
        $job = $jobRepository->findById((int)$_GET["id"]);

        if (!$job) {
            $this->render("error/404", [
                "message" => "L'offre d'emploi demandée n'existe pas."
            ]);
            return;
        }

        $categoryRepository = new CategoryRepository();

        $this->render("job/form", [
            "job" => $job,
            "categories" => $categoryRepository->findAll(),
            "formAction" => "/job/update/",
            "submitLabel" => "Modifier l'offre"
        ]);
    }

    public function update(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["id"])) {
            header("Location: /jobs/");
            exit;
        }

        $job = $this->createJobFromPost();
        $job->setId((int)$_POST["id"]);

        $jobRepository = new JobRepository();
        $jobRepository->update($job);

        header("Location: /job/?id=" . $job->getId());
        exit;
    }

    public function delete(): void
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["id"])) {
            header("Location: /jobs/");
            exit;
        }

        $jobRepository = new JobRepository();
        $jobRepository->delete((int)$_POST["id"]);

        header("Location: /jobs/");
        exit;
    }

    private function createJobFromPost(): Job
    {
        $salary = $_POST["salary"] ?? "";
        $categoryId = $_POST["category_id"] ?? "";

        $job = new Job();
        $job->setTitle(trim($_POST["title"] ?? ""));
        $job->setDescription(trim($_POST["description"] ?? ""));
        $job->setSalary($salary !== "" ? (float)$salary : null);
        $job->setCategoryId($categoryId !== "" ? (int)$categoryId : null);

        return $job;
    }
}
