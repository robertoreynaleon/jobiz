<?php
require_once APP_ROOT . "/templates/header.php";
?>

<section class="jobs-hero">
    <div class="container">
        <h1><?= $job->getId() ? "Modifier une offre" : "Créer une offre" ?></h1>
        <p>Gestion simple des offres d'emploi avec PHP POO, PDO et SQL préparé</p>
    </div>
</section>

<section class="jobs-list">
    <div class="container">
        <form class="job-form" method="POST" action="<?= htmlspecialchars($formAction) ?>">
            <?php if ($job->getId()): ?>
                <input type="hidden" name="id" value="<?= $job->getId() ?>">
            <?php endif; ?>

            <div class="form-group">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($job->getTitle() ?? "") ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="8" required><?= htmlspecialchars($job->getDescription() ?? "") ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="salary">Salaire annuel</label>
                    <input type="number" id="salary" name="salary" step="0.01" value="<?= htmlspecialchars((string)($job->getSalary() ?? "")) ?>">
                </div>

                <div class="form-group">
                    <label for="category_id">Catégorie</label>
                    <select id="category_id" name="category_id">
                        <option value="">Aucune catégorie</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->getId() ?>" <?= $job->getCategoryId() === $category->getId() ? "selected" : "" ?>>
                                <?= htmlspecialchars($category->getName() ?? "") ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <a href="/jobs/" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-primary"><?= htmlspecialchars($submitLabel) ?></button>
            </div>
        </form>
    </div>
</section>

<?php
require_once APP_ROOT . "/templates/footer.php";
?>
