<?php
declare(strict_types=1);
http_response_code(404);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$pageTitle = '404 — Страница не найдена';
$pageDescription = 'Страница не найдена.';
require __DIR__ . '/includes/header.php';
?>

<div class="error-page">
    <div>
        <div class="error-code hero-animate">404</div>
        <h1 class="error-title hero-animate delay-1">Страница не найдена</h1>
        <p class="error-desc hero-animate delay-2">Похоже, эта страница отправилась исследовать мир Minecraft.</p>
        <div class="error-actions hero-animate delay-3">
            <a href="<?= url() ?>" class="btn btn-primary">На главную</a>
            <button class="btn btn-secondary" onclick="history.back()">Назад</button>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
