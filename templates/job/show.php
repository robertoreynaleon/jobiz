<?php
// Include the header file
require_once APP_ROOT . "/templates/header.php";
?>

<div class="jobs-grid">
            <?php /** @var App\Entity\Job $job */ ?>
            <?php if (isset($job) && $job): ?>
                    <div class="job-card">

                        <div class="job-card-body">
                            <h3 class="job-title">
                                <?= $job->getTitle() ?></a>
                            </h3>
                            <p class="job-description">
                                <?= $job->getDescription() ?>
                            </p>
                        </div>
                    </div>
            <?php else: ?>
                <div class="no-jobs">
                    <div class="no-jobs-icon">🔍</div>
                    <h3>Aucune offre trouvée</h3>
                </div>
            <?php endif; ?>
</div>


<?php
// Include the footer file
require_once APP_ROOT . "/templates/footer.php";

?>
