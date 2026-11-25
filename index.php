<?php

require_once __DIR__ . '/helpers/helpers.php';

// Daftar halaman yang boleh dibuka (whitelist)
$routes = [
    'dashboard' => __DIR__ . '/views/dashboard.php',
    'user/list' => __DIR__ . '/modules/user/list.php',
    'user/add' => __DIR__ . '/modules/user/add.php',
    'user/edit' => __DIR__ . '/modules/user/edit.php',
    'user/delete' => __DIR__ . '/modules/user/delete.php'
];

// Mengambil halaman dari URL
$page = $_GET['page'] ?? 'dashboard';

// Memeriksa apakah halaman tersedia
if (is_string($page) && array_key_exists($page, $routes)) {
    $contentFile = $routes[$page];
} else {
    http_response_code(404);
    $contentFile = __DIR__ . '/views/404.php';
}

// Memanggil template
require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';

?>
