<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$server = $config['server'];
$serverIps = $config['server_ips'] ?? [$server['ip']];
$pageTitle = 'Сервер — ' . $config['site_name'];
$pageDescription = 'Информация о сервере CatDev Projects: IP, версия, статус, режим игры.';
require __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: calc(var(--navbar-h) + 60px);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Сервер</span>
            <h1 class="section-title"><?= e($server['name']) ?></h1>
            <p class="section-desc"><?= e($server['description']) ?></p>
        </div>

        <div class="hero-status reveal" style="max-width:480px;margin:0 auto 48px;" data-server-status>
            <div data-status-loading class="status-loading">Проверяем сервер...</div>
            <div data-status-error class="status-error" style="display:none;">
                <p>Не удалось получить статус сервера</p>
                <button class="btn btn-secondary" data-status-retry>Повторить</button>
            </div>
            <div data-status-content style="display:none;">
                <div class="status-header">
                    <span class="status-label">Статус сервера</span>
                    <div class="status-indicator" data-status-online>
                        <span class="status-dot unknown"></span> ...
                    </div>
                </div>
                <div class="status-players">
                    <span data-status-players>0</span> / <span data-status-max>0</span>
                </div>
                <div class="status-players-label">игроков онлайн</div>
                <div class="status-progress">
                    <div class="status-progress-bar" data-status-progress></div>
                </div>
                <div class="status-meta">
                    <span>Minecraft <span data-status-version><?= e($server['version']) ?></span></span>
                    <span style="display:none;"><span data-status-latency></span></span>
                </div>
                <div class="status-ip">
                    <code><?= e($server['ip']) ?></code>
                    <button class="btn-copy" data-copy="<?= e($server['ip']) ?>">Скопировать IP</button>
                </div>
                <div class="status-updated" data-status-updated></div>
            </div>
        </div>

        <div class="server-info-grid">
            <div class="info-card reveal stagger-1">
                <div class="info-card-label">Основной IP</div>
                <div class="info-card-value"><?= e($server['ip']) ?></div>
            </div>
            <div class="info-card reveal stagger-2">
                <div class="info-card-label">Версия</div>
                <div class="info-card-value"><?= e($server['version']) ?></div>
            </div>
            <div class="info-card reveal stagger-3">
                <div class="info-card-label">Режим</div>
                <div class="info-card-value"><?= e($server['mode']) ?></div>
            </div>
        </div>

        <div class="section-header reveal" style="margin-top:56px;margin-bottom:32px;">
            <h2 class="section-title" style="font-size:1.6rem;">Все IP-адреса</h2>
        </div>
        <div class="cards-grid">
            <?php foreach ($serverIps as $i => $ip): ?>
            <article class="card reveal stagger-<?= $i + 1 ?>">
                <div class="card-icon">🔗</div>
                <h3 class="card-title"><?= e($ip) ?></h3>
                <div class="card-actions">
                    <button class="btn btn-primary" data-copy="<?= e($ip) ?>">Скопировать</button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <div class="ready-actions reveal" style="justify-content:center;margin-top:48px;">
            <a href="<?= url('downloads.php') ?>" class="btn btn-primary">Скачивания</a>
            <?php if (!empty($config['social']['discord'])): ?>
            <a href="<?= e($config['social']['discord']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">Discord</a>
            <?php endif; ?>
            <?php if (!empty($config['social']['telegram_channel'])): ?>
            <a href="<?= e($config['social']['telegram_channel']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-secondary">Telegram-канал</a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
