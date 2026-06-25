<?php
// Include the header file
require_once APP_ROOT . "/templates/header.php";
?>

<!-- Hero Section for Jobs -->
<section class="jobs-hero">
    <div class="container">
        <h1>Découvrez nos offres d'emploi</h1>
        <p>Trouvez l'emploi de vos rêves parmi <?= isset($jobs) ? count($jobs) : 0 ?> offres disponibles</p>
    </div>
</section>

<!-- Search and Filters Section -->
<section class="jobs-search">
    <div class="container">
        <div class="search-filters-card">
            <form class="jobs-search-form" method="GET" action="/jobs/">
                <div class="search-row">
                    <div class="search-input-group">
                        <label for="search">Rechercher</label>
                        <input type="text" id="search" name="search" placeholder="Titre du poste, entreprise..." 
                               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                    </div>
                    <div class="search-input-group">
                        <label for="location">Localisation</label>
                        <input type="text" id="location" name="location" placeholder="Ville, région..." 
                               value="<?= htmlspecialchars($_GET['location'] ?? '') ?>">
                    </div>
                    <div class="search-input-group">
                        <label for="category">Catégorie</label>
                        <select id="category" name="category">
                            <option value="">Toutes les catégories</option>
                            <?php if (isset($categories) && is_array($categories)): ?>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category->getId() ?>" 
                                            <?= ($_GET['category'] ?? '') == $category->getId() ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category->getName()) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <button type="submit" class="search-btn">
                        <span>🔍</span>
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Jobs List Section -->
<section class="jobs-list">
    <div class="container">
        <div class="jobs-header">
            <div class="jobs-count">
                <h2><?= isset($jobs) ? count($jobs) : 0 ?> offre(s) d'emploi trouvée(s)</h2>
            </div>
            <div class="jobs-sort jobs-toolbar">
                <a href="/job/create/" class="btn btn-primary">Créer une offre</a>
                <select id="sort" name="sort" onchange="location = this.value;">
                    <option value="?sort=date_desc">Plus récentes</option>
                    <option value="?sort=date_asc">Plus anciennes</option>
                    <option value="?sort=title_asc">Titre A-Z</option>
                    <option value="?sort=title_desc">Titre Z-A</option>
                </select>
            </div>
        </div>

        <div class="jobs-grid">
            <?php if (isset($jobs) && is_array($jobs) && !empty($jobs)): ?>
                <?php foreach ($jobs as $job): ?>
                <?php /** @var \App\Entity\Job $job */ ?>
                    <div class="job-card">

                        <div class="job-card-body">
                            <h3 class="job-title">
                                <a href="/job/?id=<?= $job->getId() ?>"><?= htmlspecialchars($job->getTitle() ?? 'Titre non disponible') ?></a>
                            </h3>
                            <p class="job-description">
                                <?= substr(htmlspecialchars($job->getDescription() ?? 'Description non disponible'), 0, 150) ?>
                                <?= strlen($job->getDescription() ?? '') > 150 ? '...' : '' ?>
                            </p>
                            <div class="job-tags">
                                <?php if ($job->getCategoryName()): ?>
                                    <span class="job-tag category"><?= htmlspecialchars($job->getCategoryName()) ?></span>
                                <?php endif; ?>
                                <?php if ($job->getSalary()): ?>
                                    <span class="job-tag salary"><?= number_format($job->getSalary(), 0, ',', ' ') ?> €</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="job-card-footer">
                            <div class="job-meta">
                                <span class="job-date">
                                    🕒 Publié <?= $job->getCreatedAt() ? $job->getCreatedAt()->format('d/m/Y') : 'récemment' ?>
                                </span>
                            </div>
                            <div class="job-actions">
                                <a href="/job/?id=<?=$job->getId()?>" class="btn btn-primary">
                                    Voir l'offre
                                </a>
                                <a href="/job/edit/?id=<?=$job->getId()?>" class="btn btn-secondary">
                                    Modifier
                                </a>
                                <form method="POST" action="/job/delete/" onsubmit="return confirm('Supprimer cette offre ?');">
                                    <input type="hidden" name="id" value="<?= $job->getId() ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="no-jobs">
                    <div class="no-jobs-icon">🔍</div>
                    <h3>Aucune offre trouvée</h3>
                    <p>Essayez de modifier vos critères de recherche ou consultez toutes nos offres disponibles.</p>
                    <a href="/jobs/" class="btn btn-primary">Voir toutes les offres</a>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?= $i ?><?= isset($_GET['search']) ? '&search=' . urlencode($_GET['search']) : '' ?><?= isset($_GET['category']) ? '&category=' . urlencode($_GET['category']) : '' ?>" 
                       class="pagination-link <?= ($currentPage ?? 1) == $i ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function toggleSaveJob(jobId) {
    // Logique pour sauvegarder/supprimer un emploi des favoris
    console.log('Toggle save job:', jobId);
    // Ici vous pouvez ajouter votre logique AJAX
}
</script>

<?php
// Include the footer file
require_once APP_ROOT . "/templates/footer.php";
?>
