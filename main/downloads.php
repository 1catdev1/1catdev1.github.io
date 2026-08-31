<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$pageTitle = 'Скачивания — ' . $config['site_name'];
$pageDescription = 'Ядра, плагины и лаунчер для CatDev Projects.';
$extraScripts = ['assets/js/downloads.js'];

$allDownloads = [];

foreach ($config['plugins'] as $plugin) {
    $allDownloads[] = [
        'name'     => $plugin['name'],
        'version'  => $plugin['version'],
        'desc'     => $plugin['description'],
        'size'     => $plugin['size'],
        'category' => 'Plugins',
        'file'     => $plugin['file'],
        'icon'     => $plugin['icon'] ?? '🔌',
    ];
}
foreach ($config['downloads'] as $dl) {
    $allDownloads[] = [
        'name'     => $dl['name'],
        'version'  => $dl['version'],
        'desc'     => $dl['description'],
        'size'     => $dl['size'],
        'category' => $dl['category'],
        'file'     => $dl['file'],
        'icon'     => $dl['icon'] ?? '📁',
    ];
}

require __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: calc(var(--navbar-h) + 60px);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Файлы</span>
            <h1 class="section-title">Скачивания</h1>
            <p class="section-desc">Ядра, плагин и лаунчер для игры на сервере.</p>
        </div>

        <div class="downloads-toolbar reveal">
            <input type="search" id="downloadSearch" class="search-input" placeholder="Найти файл..." aria-label="Поиск файлов">
            <div class="filter-tabs" role="tablist">
                <button class="filter-tab active" data-filter="all" role="tab">Все</button>
                <button class="filter-tab" data-filter="Core" role="tab">Ядра</button>
                <button class="filter-tab" data-filter="Plugins" role="tab">Плагины</button>
                <button class="filter-tab" data-filter="Launcher" role="tab">Лаунчер</button>
            </div>
        </div>

        <div class="cards-grid" id="downloadsGrid">
            <?php foreach ($allDownloads as $i => $item): ?>
            <article class="card reveal stagger-<?= min($i % 6 + 1, 6) ?>"
                     data-category="<?= e($item['category']) ?>"
                     data-name="<?= e($item['name']) ?>"
                     data-desc="<?= e($item['desc']) ?>">
                <div class="card-icon"><?= e($item['icon']) ?></div>
                <h2 class="card-title"><?= e($item['name']) ?></h2>
                <p class="card-desc"><?= e($item['desc']) ?></p>
                <div class="card-meta">
                    <span>v<?= e($item['version']) ?></span>
                    <span><?= e($item['size']) ?></span>
                    <span><?= e($item['category']) ?></span>
                </div>
                <div class="card-actions">
                    <a href="<?= url('download.php?file=' . urlencode($item['file'])) ?>" class="btn btn-primary">Скачать</a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
