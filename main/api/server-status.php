<?php
/**
 * RollzSMP — Server Status API
 * Returns JSON with Minecraft server status (cached)
 */

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../includes/functions.php';

try {
    $status = getCachedServerStatus();
    echo json_encode($status, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'online'      => false,
        'players'     => 0,
        'max_players' => 0,
        'version'     => null,
        'motd'        => null,
        'latency'     => null,
        'error'       => 'internal',
    ], JSON_UNESCAPED_UNICODE);
}
