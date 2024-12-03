<?php

    // Database Configuration
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

try {
    //code...
} catch (PDOException $e) {
    echo "Login Error: " . $e->getMessage();
}