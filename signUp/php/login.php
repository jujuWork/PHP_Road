<?php

    // Database Configuration
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

try {
            // Establish database connection
        $pdo = new PDO ("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $inputUsername = $_POST['username']; // Retrieve the entered username
            $inputPassword = $_post['password']; // Retrieve the entered password

            // Prepare a SQL query to fetch the user details
        $sql = "SELECT username, password FROM users WHERE username = :username";   
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $inputUsername]);
            
            // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify password
        if ($user && password_verify($inputPassword, $user['password'])) {
            echo "Login Successful, " . htmlspecialchars($user['username']) . ".";
        } else {
            echo "Invalid username or password.";
        }

        }


} catch (PDOException $e) {
    echo "Login Error: " . $e->getMessage();
}