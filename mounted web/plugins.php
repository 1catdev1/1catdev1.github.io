<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$pageTitle = 'Плагины — ' . $config['site_name'];
$pageDescription = 'Плагины сервера CatDev Projects.';
require __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: calc(var(--navbar-h) + 60px);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Плагины</span>
            <h1 class="section-title">Плагины сервера</h1>
            <p class="section-desc">Техническая основа CatDev Projects.</p>
        </div>

        <div class="cards-grid">
            <?php if (empty($config['plugins'])): ?>
            <p class="section-desc">Плагины пока не добавлены.</p>
            <?php else: ?>
            <?php foreach ($config['plugins'] as $i => $plugin): ?>
            <article class="card reveal stagger-<?= min($i + 1, 6) ?>">
                <div class="card-icon"><?= e($plugin['icon'] ?? '🔌') ?></div>
                <h2 class="card-title"><?= e($plugin['name']) ?></h2>
                <p class="card-desc"><?= e($plugin['description']) ?></p>
                <div class="card-meta">
                    <span>v<?= e($plugin['version']) ?></span>
                    <span><?= e($plugin['size']) ?></span>
                    <span><?= e($plugin['category']) ?></span>
                    <span><?= e($plugin['compatibility']) ?></span>
                </div>
                <div class="card-actions">
                    <a href="<?= url('download.php?file=' . urlencode($plugin['file'])) ?>" class="btn btn-primary">Скачать</a>
                </div>
            </article>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
