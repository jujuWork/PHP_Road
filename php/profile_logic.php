<?php

require_once __DIR__ . '/../db/db.php';

session_start();


//     // Database Configuration
// $host = '127.0.0.1';
// $port = '8889';
// $dbname = 'db_users';
// $username = 'root';
// $password = 'root';

try {
    //     // Establish Connection
    // $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch logged-in user's data
    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!isset($user)) {
        error_log(("User not found for username: " . $inputUsername));
        $_SESSION['error'] = "User not found.";
        header("Location: ../../login.php");
        exit;
    }
    
} catch (PDOException $e) {
    echo ("Database error: " . $e->getMessage());
    header("Location: ../../profile.php");
    exit;
}
