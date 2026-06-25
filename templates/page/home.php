<?php

// Include the header file
require_once APP_ROOT . "/templates/header.php";

?>


    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Bonjour</h1>
            <p>Bienvenue sur la plateforme qui connecte les talents aux opportunités</p>
            <p class="hero-subtitle">Trouvez votre emploi de rêve parmi des milliers d'offres</p>
        </div>
    </section>

    <!-- Categories Navigation Section -->
    <section class="categories-nav">
        <div class="container">
            <h2>Explorez par catégorie</h2>
            <div class="categories-nav-grid">
                <?php /**@var App\Entity\Category $category*/ ?>
                <?php if (isset($categories) && is_array($categories) && !empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <a href="/jobs/category/<?= $category->getId() ?>/" class="category-nav-item">
                            <div class="category-nav-card">
                                <div class="category-nav-icon">
                                    <?php
                                    // Icônes selon le nom de la catégorie
                                    $icons = [
                                        'Développeur Fullstack' => '💻',
                                        'Marketing' => '📢',
                                        'Ressources Humaines' => '👥',
                                        'Technicien informatique' => '📊',
                                        'DevOps' => '🤝',
                                        'Développeur Frontend' => '🎨',
                                        'Administrateur système' => '⚙️',
                                        'Santé' => '🏥'
                                    ];
                                    echo $icons[$category->getName()] ?? '🏢';
                                    ?>
                                </div>
                                <h3><?= htmlspecialchars($category->getName()) ?></h3>
                                <p>Découvrir les offres</p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-categories">
                        <p>Aucune catégorie disponible pour le moment.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <div class="container">
            <div class="search-card">
                <form class="search-form">
                    <div class="form-group">
                        <label for="job-title">Poste ou mot-clé</label>
                        <input type="text" id="job-title" name="job-title" placeholder="Ex: Développeur Web, Marketing...">
                    </div>
                    <div class="form-group">
                        <label for="location">Localisation</label>
                        <input type="text" id="location" name="location" placeholder="Ex: Paris, Lyon, Télétravail...">
                    </div>
                    <button type="submit" class="search-btn">🔍 Rechercher</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2>Pourquoi choisir Jobiz ?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Offres ciblées</h3>
                    <p>Nos algorithmes intelligents vous proposent des offres parfaitement adaptées à votre profil et vos compétences.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🚀</div>
                    <h3>Candidature rapide</h3>
                    <p>Postulez en quelques clics grâce à notre système de candidature simplifié et efficace.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🤝</div>
                    <h3>Entreprises vérifiées</h3>
                    <p>Toutes nos entreprises partenaires sont vérifiées pour vous garantir des opportunités sérieuses.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📊</div>
                    <h3>Suivi personnalisé</h3>
                    <p>Suivez l'évolution de vos candidatures et recevez des conseils personnalisés pour optimiser votre recherche.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>15,000+</h3>
                    <p>Offres d'emploi</p>
                </div>
                <div class="stat-item">
                    <h3>5,000+</h3>
                    <p>Entreprises partenaires</p>
                </div>
                <div class="stat-item">
                    <h3>50,000+</h3>
                    <p>Candidats satisfaits</p>
                </div>
                <div class="stat-item">
                    <h3>95%</h3>
                    <p>Taux de satisfaction</p>
                </div>
            </div>
        </div>
    </section>


<?php
// Include the footer file
require_once APP_ROOT . "/templates/footer.php";
?>