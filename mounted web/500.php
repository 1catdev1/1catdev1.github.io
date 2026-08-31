<?php
declare(strict_types=1);
http_response_code(500);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$pageTitle = '500 — Ошибка сервера';
$pageDescription = 'Внутренняя ошибка сервера.';
require __DIR__ . '/includes/header.php';
?>

<div class="error-page">
    <div>
        <div class="error-code hero-animate">500</div>
        <h1 class="error-title hero-animate delay-1">Что-то пошло не так</h1>
        <p class="error-desc hero-animate delay-2">Сервер столкнулся с неожиданной ошибкой. Попробуйте позже.</p>
        <div class="error-actions hero-animate delay-3">
            <a href="<?= url() ?>" class="btn btn-primary">На главную</a>
            <button class="btn btn-secondary" onclick="location.reload()">Попробовать снова</button>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
