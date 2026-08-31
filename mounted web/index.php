<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$server = $config['server'];
$serverIps = $config['server_ips'] ?? [$server['ip']];
$pageTitle = $config['seo_title'];
$pageDescription = $config['seo_description'];
require __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge hero-animate">
                    <span class="status-dot online" style="width:6px;height:6px;"></span>
                    Minecraft SMP
                </div>
                <h1 class="hero-title hero-animate delay-1">
                    <?= e($config['site_name']) ?>
                    <span>Твой мир. Твои правила.<br>Твоя история.</span>
                </h1>
                <p class="hero-desc hero-animate delay-2">
                    Добро пожаловать в CatDev Projects — Minecraft-проект с атмосферой, активным сообществом и стабильной работой.
                </p>
                <div class="hero-actions hero-animate delay-3">
                    <a href="<?= url('server.php') ?>" class="btn btn-primary btn-lg">Играть на сервере</a>
                    <a href="<?= url('downloads.php') ?>" class="btn btn-secondary btn-lg">Скачивания</a>
                </div>
            </div>

            <div class="hero-status hero-animate delay-4" data-server-status>
                <div data-status-loading class="status-loading">
                    Проверяем сервер...
                </div>
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
        </div>
    </div>
</section>

<!-- SERVER INTRO / FEATURES -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Почему мы</span>
            <h2 class="section-title">Что ждёт на сервере</h2>
            <p class="section-desc">Стабильность, справедливость и сообщество, в котором приятно играть.</p>
        </div>
        <div class="cards-grid">
            <article class="card reveal stagger-1">
                <div class="card-icon">🛡️</div>
                <h3 class="card-title">Защита и справедливость</h3>
                <p class="card-desc">Логирование и модерация. Твои постройки под защитой, гриф не пройдёт.</p>
            </article>
            <article class="card reveal stagger-2">
                <div class="card-icon">💬</div>
                <h3 class="card-title">Живое сообщество</h3>
                <p class="card-desc">Discord и Telegram-канал — общайся, находи друзей и следи за новостями.</p>
            </article>
            <article class="card reveal stagger-3">
                <div class="card-icon">⚡</div>
                <h3 class="card-title">Стабильная работа</h3>
                <p class="card-desc">Проверенные ядра и оптимизация. Меньше лагов — больше игры.</p>
            </article>
            <article class="card reveal stagger-4">
                <div class="card-icon">🌍</div>
                <h3 class="card-title">Несколько IP</h3>
                <p class="card-desc">Подключайся через любой удобный адрес — все ведут на один сервер.</p>
            </article>
        </div>
    </div>
</section>

<!-- READY -->
<section class="ready-section">
    <div class="container">
        <div class="ready-card reveal-scale">
            <h2 class="ready-title">Готов?</h2>
            <p class="ready-desc">Выбери IP, копируй и заходи на сервер.</p>
            <div class="ready-actions">
                <a href="<?= url('server.php') ?>" class="btn btn-primary btn-lg">Играть на сервере</a>
                <a href="<?= url('downloads.php') ?>" class="btn btn-secondary btn-lg">Скачивания</a>
            </div>
        </div>
    </div>
</section>

<!-- IPS -->
<section class="section">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Подключение</span>
            <h2 class="section-title">IP-адреса сервера</h2>
            <p class="section-desc">Любой из адресов ведёт на CatDev Projects. Копируй и вставляй в Minecraft.</p>
        </div>
        <div class="cards-grid">
            <?php foreach ($serverIps as $i => $ip): ?>
            <article class="card reveal stagger-<?= $i + 1 ?>">
                <div class="card-icon">🔗</div>
                <h3 class="card-title"><?= e($ip) ?></h3>
                <p class="card-desc">Основной адрес для подключения к серверу.</p>
                <div class="card-actions">
                    <button class="btn btn-primary" data-copy="<?= e($ip) ?>">Скопировать</button>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ASTRALITE TEASER -->
<section class="section">
    <div class="container">
        <div class="ready-card reveal" style="padding:60px 40px;">
            <span class="section-label" style="display:block;margin-bottom:12px;">В разработке</span>
            <h2 class="ready-title" style="font-size:clamp(2rem,4vw,2.8rem);">AstraLite</h2>
            <p class="ready-desc"><?= e($config['astra_lite']['description']) ?></p>
            <div class="ready-actions">
                <a href="<?= url('astra-lite.php') ?>" class="btn btn-secondary btn-lg">Узнать больше</a>
            </div>
        </div>
    </div>
</section>

<!-- COMMUNITY TEASER -->
<section class="section" style="padding-bottom:40px;">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Сообщество</span>
            <h2 class="section-title">Присоединяйся</h2>
            <p class="section-desc">Discord и Telegram-канал — всё в одном месте.</p>
        </div>
        <div class="community-grid">
            <?php if (!empty($config['social']['discord'])): ?>
            <a href="<?= e($config['social']['discord']) ?>" target="_blank" rel="noopener noreferrer" class="community-card reveal-left">
                <div class="community-card-icon">💬</div>
                <h3 class="community-card-title">Discord</h3>
                <p class="community-card-desc">Общайся с игроками CatDev Projects, находи напарников и следи за ивентами.</p>
                <span class="btn btn-secondary">Перейти</span>
            </a>
            <?php endif; ?>
            <?php if (!empty($config['social']['telegram_channel'])): ?>
            <a href="<?= e($config['social']['telegram_channel']) ?>" target="_blank" rel="noopener noreferrer" class="community-card reveal-right">
                <div class="community-card-icon">📢</div>
                <h3 class="community-card-title">Telegram-канал</h3>
                <p class="community-card-desc">Новости проекта, анонсы и обновления.</p>
                <span class="btn btn-secondary">Подписаться</span>
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
