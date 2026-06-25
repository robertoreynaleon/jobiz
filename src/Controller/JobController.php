<?php

namespace App\Controller;

use App\Repository\JobRepository;

use Exception;

class JobController extends Controller
{
    public function list(): void
    {

        $jobRepository = new JobRepository();
        // Récupération de toutes les offres d'emploi depuis le repository

        $jobs = $jobRepository->findAll(); // Ici, je vais récupérer les offres d'emploi depuis la base de données
        // var_dump($jobs); // Pour vérifier que les données sont récupérées correctement

        $this->render("job/list", [
            "jobs" => $jobs // Ici, je vais récupérer les offres d'emploi depuis la base de données
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
}
