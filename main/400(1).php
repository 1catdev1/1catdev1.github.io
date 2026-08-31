<?php
declare(strict_types=1);
http_response_code(400);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$pageTitle = '400 — Неверный запрос';
$pageDescription = 'Неверный запрос.';
require __DIR__ . '/includes/header.php';
?>

<div class="error-page">
    <div>
        <div class="error-code hero-animate">400</div>
        <h1 class="error-title hero-animate delay-1">Неверный запрос</h1>
        <p class="error-desc hero-animate delay-2">Сервер не смог обработать ваш запрос. Проверьте адрес и попробуйте снова.</p>
        <div class="error-actions hero-animate delay-3">
            <a href="<?= url() ?>" class="btn btn-primary">На главную</a>
            <button class="btn btn-secondary" onclick="history.back()">Назад</button>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
