<?php
/**
 * CatDev Projects - Центральный конфигурационный файл
 *
 * Здесь находятся ВСЕ основные настройки сайта.
 * Изменяйте только этот файл для обновления IP, ссылок и т.д.
 *
 * PHP 8.1+
 */

return [
    // ==================== ОСНОВНЫЕ НАСТРОЙКИ САЙТА ====================
    'site_name'        => 'CatDev Projects',
    'site_description' => 'CatDev Projects — Minecraft-проект с атмосферой, сообществом и стабильной работой. Твой мир. Твои правила.',
    'site_url'         => 'https://smpd.l.cd',
    'seo_title'        => 'CatDev Projects — Minecraft сервер',
    'seo_description'  => 'Играй на CatDev Projects — Minecraft SMP сервере с сообществом и стабильной работой. Заходи прямо сейчас!',
    'seo_keywords'     => 'minecraft, smp, catdev, catdev projects, сервер, minecraft server',
    'favicon'          => 'assets/img/favicon.svg',
    'logo'             => 'assets/img/logo.svg',

    // ==================== СЕРВЕР ====================
    'server' => [
        'name'        => 'CatDev Projects',
        'ip'          => 'play.smpd.l.cd',
        'port'        => 30362, // fallback; SRV _minecraft._tcp имеет приоритет
        'version'     => '1.21.1',
        'mode'        => 'SMP',
        'description' => 'Выживание с атмосферой и дружным сообществом. Строй, исследуй, общайся.',
        'max_players' => 100,
    ],

    // Все доступные IP-адреса сервера
    'server_ips' => [
        'play.smpd.l.cd',
        'mc.smpd.l.cd',
        'smpd.l.cd',
    ],

    'server_status' => [
        'enabled'   => true,
        'cache_ttl' => 2,
        'timeout'   => 3,
    ],

    // ==================== СОЦИАЛЬНЫЕ СЕТИ ====================
    'social' => [
        'discord'          => 'https://discord.gg/mountedsmp',
        'telegram'         => '',
        'telegram_channel' => 'https://t.me/mountedsmp',
        'youtube'          => '',
        'tiktok'           => '',
    ],

    // ==================== ASTRALITE ====================
    'astra_lite' => [
        'enabled'     => true,
        'status'      => 'coming_soon',
        'title'       => 'AstraLite',
        'description' => 'Мы готовим что-то новое. AstraLite — следующий уровень опыта на CatDev Projects.',
        'learn_more'  => 'https://t.me/mountedsmp',
    ],

    // ==================== МОДЫ (отключены) ====================
    'mods' => [],

    // ==================== ПЛАГИНЫ ====================
    'plugins' => [
        [
            'id'            => 'coreprotect',
            'name'          => 'CoreProtect',
            'version'       => '22.4',
            'description'   => 'Логирование действий игроков и восстановление после грифа.',
            'size'          => '1.9 MB',
            'category'      => 'Protection',
            'compatibility' => '1.21+',
            'file'          => 'plugins/CoreProtect.jar',
            'icon'          => '📋',
        ],
    ],

    // ==================== ЯДРА И ЛАУНЧЕР ====================
    'downloads' => [
        [
            'id'          => 'paper',
            'name'        => 'Paper',
            'version'     => '1.21.1',
            'description' => 'Высокопроизводительное ядро на базе Spigot. Рекомендуется для большинства серверов.',
            'size'        => '48 MB',
            'category'    => 'Core',
            'file'        => 'other/paper-1.21.1.jar',
            'icon'        => '📜',
        ],
        [
            'id'          => 'purpur',
            'name'        => 'Purpur',
            'version'     => '1.21.1',
            'description' => 'Ядро с дополнительными оптимизациями и настройками поверх Paper.',
            'size'        => '49 MB',
            'category'    => 'Core',
            'file'        => 'other/purpur-1.21.1.jar',
            'icon'        => '⚡',
        ],
        [
            'id'          => 'launcher',
            'name'        => 'CatDev Launcher',
            'version'     => '1.0.0',
            'description' => 'Официальный лаунчер CatDev Projects с быстрым подключением к серверу.',
            'size'        => '42 MB',
            'category'    => 'Launcher',
            'file'        => 'other/mounted-launcher.exe',
            'icon'        => '🚀',
        ],
    ],

    'footer' => [
        'text'      => 'Minecraft-проект с атмосферой и сообществом.',
        'copyright' => '© 2026 CatDev Projects. Все права защищены.',
    ],

    'theme' => [
        'primary_color'   => '#ffffff',
        'accent_color'    => '#a0a0a0',
        'background'      => '#0a0a0b',
        'card_bg'         => 'rgba(255, 255, 255, 0.03)',
        'border'          => 'rgba(255, 255, 255, 0.08)',
    ],
];
