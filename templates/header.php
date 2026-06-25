<?php
// Ce morceau de code va afficher le nom de la route active. Il intéragit avec la classe Router et la méthode isActiveRoute().

use App\Routing\Router;

// var_dump(Router::isActiveRoute("/about/")); // Affiche true si la route est active, sinon false

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobiz - Trouvez votre emploi de rêve</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/about.css">
    <link rel="stylesheet" href="/css/jobs.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <a href="/" class="logo">Jobiz</a>
                <nav>
                    <ul class="nav-links">
                        <li><a href="/" <?= Router::isActiveRoute("/") ? 'class="active"' : '' ?>>Accueil</a></li>
                        <li><a href="/jobs/" <?= Router::isActiveRoute("/jobs/") ? 'class="active"' : '' ?>>Emplois</a></li>
                        <li><a href="/companies/" <?= Router::isActiveRoute("/companies/") ? 'class="active"' : '' ?>>Entreprises</a></li>
                        <li><a href="/about/" <?= Router::isActiveRoute("/about/") ? 'class="active"' : '' ?>>À propos</a></li>
                        <li><a href="/contact/" <?= Router::isActiveRoute("/contact/") ? 'class="active"' : '' ?>>Contact</a></li>
                        <!-- <li><a href="/about/" class="active">À propos (TEST)</a></li> -->
                    </ul>
                </nav>
            </div>
        </div>
    </header>