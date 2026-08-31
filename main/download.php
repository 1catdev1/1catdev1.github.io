<?php
/**
 * RollzSMP — Secure file download
 * Usage: /download.php?file=mods/rollzsmp-modpack.zip
 * Only files listed in config.php are allowed.
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$file = $_GET['file'] ?? '';

if (!is_string($file) || $file === '') {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

// Normalize & reject traversal
$file = str_replace(['\\', "\0"], '/', $file);
$file = ltrim($file, '/');

if (str_contains($file, '..') || str_contains($file, '//')) {
    http_response_code(403);
    require __DIR__ . '/403.php';
    exit;
}

safeDownload($file);
