<?php

$isLocal = in_array(
    $_SERVER['HTTP_HOST'] ?? '',
    ['localhost', '127.0.0.1'],
    true
);

if ($isLocal) {
    // ローカル環境（XAMPP）
    $host = 'localhost';
    $dbname = 'ccdonuts';
    $user = 'root';
    $password = '';

} else {
    // レンタルサーバー環境
    $host = '';
    $dbname = '';
    $user = '';
    $password = '';
}

$pdo = new PDO(
    "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
    $user,
    $password,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);