<?php
declare(strict_types=1);
http_response_code(403);
require_once __DIR__ . '/includes/functions.php';
$config = getConfig();
$pageTitle = '403 — Доступ запрещён';
$pageDescription = 'Доступ запрещён.';
require __DIR__ . '/includes/header.php';
?>

<div class="error-page">
    <div>
        <div class="error-code hero-animate">403</div>
        <h1 class="error-title hero-animate delay-1">Доступ запрещён</h1>
        <p class="error-desc hero-animate delay-2">У вас нет прав для просмотра этой страницы.</p>
        <div class="error-actions hero-animate delay-3">
            <a href="<?= url() ?>" class="btn btn-primary">На главную</a>
        </div>
    </div>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
