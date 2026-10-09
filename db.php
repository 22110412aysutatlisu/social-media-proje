<?php
$host     = 'localhost';
$db_name  = 'social_media_db';
$username = 'root'; // Yerel sunucu kullanıyorsanız varsayılan genelde 'root'tur
$password = '';     // Yerel sunucuda genelde şifre boştur

try {
    $pdo = new PDO("mysql:host={$host};dbname={$db_name};charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}