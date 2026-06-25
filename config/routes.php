<?php

// Ce fichier contient les routes de l'application qui sont disponibles pour les utilisateurs

return [
    "/" => ["controller" => "App\\Controller\\PageController", "action" => "home"],
    "/home/" => ["controller" => "App\\Controller\\PageController", "action" => "home"],
    "/about/" => ["controller" => "App\\Controller\\PageController", "action" => "about"],
    "/jobs/" => ["controller" => "App\\Controller\\JobController", "action" => "list"],
    "/job/" => ["controller" => "App\\Controller\\JobController", "action" => "show"]
];