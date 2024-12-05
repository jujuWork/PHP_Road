<?php

    // Database Configuration
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

// $message = "";

try {
            // Establish database connection
        $pdo = new PDO ("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // echo "Form submit successfully"; // Debugging output
            
            $inputUsername = $_POST['username'] ?? ''; // Retrieve the entered username
            $inputPassword = $_POST['password'] ?? ''; // Retrieve the entered password

        // var_dump($inputUsername, $inputPassword); // Debugging output

            // Prepare a SQL query to fetch the user details
        $sql = "SELECT * FROM users WHERE username = :username";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $inputUsername);
        // $stmt->bindParam(':password', $inputPassword);
        $stmt->execute();
        // $stmt->execute([':username' => $inputUsername]);
            
            // Fetch the result
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if the users exists
        if ($user) { 
                // Verify password
            if (password_verify($inputPassword, $user['password'])) {
                echo "Login Successful.";
            } else {
                echo "Invalid password.";
            } 
        } else {
            echo "User does not exist.";
        }
            // echo "Message: " . $message;

        }

} catch (PDOException $e) {
    echo "Login Error: " . $e->getMessage();
}
