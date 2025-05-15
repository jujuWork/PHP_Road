<?php

$host = 'localhost';
$dbname = 'message_board_db';
$username = 'root';
$password = '';

// Database Connection (データベース接続)

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf9mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    // DATABASE ERROR MESSAGE
    die('データベース接続エラー: ' . $e->getMessage());
}

// SESSION START (セッションを開始)

session_start();