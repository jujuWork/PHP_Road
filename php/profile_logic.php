<?php

session_start();

    // Redirect to login if user is not logeed in
if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please login to access your profile.";
    header("Location: ../../login.php");
    exit;
}

    // Database Configuration
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

try {
        // Establish Connection
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch logged-in user's data
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['error'] = "User not found.";
        header("Location: ../../login.php");
        exit;
    }

} catch (PDOException $e) {
    echo ("Database error: " . $e->getMessage());
}

    // Include the HTML
include '../../profile.php';