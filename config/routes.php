<?php

// Ce fichier contient les routes de l'application qui sont disponibles pour les utilisateurs

return [
    "/" => ["controller" => "App\\Controller\\PageController", "action" => "home"],
    "/home/" => ["controller" => "App\\Controller\\PageController", "action" => "home"],
    "/about/" => ["controller" => "App\\Controller\\PageController", "action" => "about"],
    "/jobs/" => ["controller" => "App\\Controller\\JobController", "action" => "list"],
    "/job/" => ["controller" => "App\\Controller\\JobController", "action" => "show"],
    "/job/create/" => ["controller" => "App\\Controller\\JobController", "action" => "create"],
    "/job/store/" => ["controller" => "App\\Controller\\JobController", "action" => "store"],
    "/job/edit/" => ["controller" => "App\\Controller\\JobController", "action" => "edit"],
    "/job/update/" => ["controller" => "App\\Controller\\JobController", "action" => "update"],
    "/job/delete/" => ["controller" => "App\\Controller\\JobController", "action" => "delete"]
];
