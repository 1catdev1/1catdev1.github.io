<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$astra = $config['astra_lite'];
$pageTitle = 'AstraLite — ' . $config['site_name'];
$pageDescription = $astra['description'];
require __DIR__ . '/includes/header.php';
?>

<section class="astra-hero">
    <div class="container">
        <div class="astra-content">
            <div class="astra-badge hero-animate">В разработке</div>
            <h1 class="astra-title hero-animate delay-1"><?= e($astra['title']) ?></h1>
            <p class="astra-status hero-animate delay-2">COMING SOON</p>
            <p class="astra-desc hero-animate delay-3"><?= e($astra['description']) ?></p>
            <div class="astra-progress hero-animate delay-4">
                <div class="astra-progress-bar"></div>
            </div>
            <div class="hero-animate delay-5">
                <?php if (!empty($astra['learn_more'])): ?>
                <a href="<?= e($astra['learn_more']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-lg">Узнать больше</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
