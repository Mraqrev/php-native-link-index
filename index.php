<?php
include 'config.php'; // Sesuaikan path jika perlu

$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = parse_url($request_uri, PHP_URL_PATH);

if ($request_uri === '/') {
    include 'views/index.php'; // Halaman daftar post
} elseif (preg_match('/\/post\/(.+)/', $request_uri, $matches)) {
    $slug = $matches[1];
    include 'views/post.php'; // Halaman single post
} elseif ($request_uri === '/add_user') {
    include 'views/add_user.php'; // Halaman tambah pengguna
} elseif ($request_uri === '/login') {
    include 'views/login.php'; // Halaman login
} elseif ($request_uri === '/dashboard') {
    include 'views/dashboard.php'; // Halaman dashboard
} else {
    http_response_code(404);
    include 'views/404.php'; // Halaman 404
}
