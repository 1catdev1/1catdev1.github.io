<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$social = $config['social'];
$pageTitle = 'Сообщество — ' . $config['site_name'];
$pageDescription = 'Discord и Telegram-канал CatDev Projects.';
require __DIR__ . '/includes/header.php';
?>

<section class="section" style="padding-top: calc(var(--navbar-h) + 60px);">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Сообщество</span>
            <h1 class="section-title">Присоединяйся к нам</h1>
            <p class="section-desc">Общайся с игроками, следи за новостями и будь в курсе всех событий проекта.</p>
        </div>

        <div class="community-grid">
            <?php if (!empty($social['discord'])): ?>
            <a href="<?= e($social['discord']) ?>" target="_blank" rel="noopener noreferrer" class="community-card reveal stagger-1">
                <div class="community-card-icon">💬</div>
                <h2 class="community-card-title">Discord</h2>
                <p class="community-card-desc">Основной чат сервера. Голосовые каналы, роли, ивенты и поддержка.</p>
                <span class="btn btn-secondary">Перейти в Discord</span>
            </a>
            <?php endif; ?>

            <?php if (!empty($social['telegram_channel'])): ?>
            <a href="<?= e($social['telegram_channel']) ?>" target="_blank" rel="noopener noreferrer" class="community-card reveal stagger-2">
                <div class="community-card-icon">📢</div>
                <h2 class="community-card-title">Telegram-канал</h2>
                <p class="community-card-desc">Официальные новости, обновления, анонсы и мероприятия.</p>
                <span class="btn btn-secondary">Подписаться</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
