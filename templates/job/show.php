<?php
// Include the header file
require_once APP_ROOT . "/templates/header.php";
?>

<section class="jobs-list">
    <div class="container">
        <div class="jobs-grid">
            <?php /** @var App\Entity\Job $job */ ?>
            <?php if (isset($job) && $job): ?>
                    <div class="job-card">

                        <div class="job-card-body">
                            <h3 class="job-title">
                                <?= htmlspecialchars($job->getTitle() ?? "") ?>
                            </h3>
                            <p class="job-description">
                                <?= nl2br(htmlspecialchars($job->getDescription() ?? "")) ?>
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
                            <a href="/jobs/" class="btn btn-secondary">Retour</a>
                            <div class="job-actions">
                                <a href="/job/edit/?id=<?= $job->getId() ?>" class="btn btn-primary">Modifier</a>
                                <form method="POST" action="/job/delete/" onsubmit="return confirm('Supprimer cette offre ?');">
                                    <input type="hidden" name="id" value="<?= $job->getId() ?>">
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
            <?php else: ?>
                <div class="no-jobs">
                    <div class="no-jobs-icon">🔍</div>
                    <h3>Aucune offre trouvée</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>


<?php
// Include the footer file
require_once APP_ROOT . "/templates/footer.php";

?>
