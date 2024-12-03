<?php

    // Database connection
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO ("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email) ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':username' => $_POST['username'], // users name
        ':password' => password_hash($_POST['password'], PASSWORD_BCRYPT), // users password
        ':email' => $_POST['email'], // users email
    ]);

    echo "Signup Sucessful!"; // Output a success message upon insertion into database

    header("Location: login.php");
    
} catch (PDOException $e) {
    echo "Sign up error: " . $e->getMessage();
}