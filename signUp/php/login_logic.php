<?php

    // Database Configuration
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

$message = "";

try {
            // Establish database connection
        $pdo = new PDO ("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
                // Debugging: Check if the form is submitted
            if (empty($_POST)) {
                $message = "No data received from the form";
                return;
            }

            $inputUsername = $_POST['username']; // Retrieve the entered username
            $inputPassword = $_post['password']; // Retrieve the entered password

                // Debugging: Verify formm data
            if (empty($inputUsername) || empty($inputPassword)) {
                $message = "Please fill in both username and password.";
                return;
            }

            // Prepare a SQL query to fetch the user details
        $sql = "SELECT username, password FROM users WHERE username = :username";   
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':username' => $inputUsername]);
            
            // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if the users exists
        if ($user) { 
                // Verify password
            if (password_verify($inputPassword, $user['password'])) {
                $message = "Login Successful, " . htmlspecialchars($user['username']) . ".";
            } else {
                $message = "Invalid password.";
            } 
        } else {
            $message = "User does not exist.";
        }

        }
    // header("Location: ../../welcome.php");
    // exit;

} catch (PDOException $e) {
    $message = "Login Error: " . $e->getMessage();
}
