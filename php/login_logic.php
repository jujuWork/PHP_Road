<?php

// require_once 'db/db.php';

session_start();

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
                
            $inputUsername = trim($_POST['username'] ?? ''); // Retrieve / Sanitize the entered username
            $inputPassword = $_POST['password'] ?? ''; // Retrieve the entered password

            error_log("Input Username: " . $inputUsername);

            if (empty($inputUsername) || empty($inputPassword)) {
                $_SESSION['error'] = "Username and password are required.";
                header("Location: ../../login.php");
                exit;
                } 

                        // Prepare a SQL query to fetch the user details
                    $sql = "SELECT * FROM users WHERE LOWER(username) = LOWER(:username)";
                    
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':username', $inputUsername);
                    // $stmt->bindParam(':password', $inputPassword);
                    $stmt->execute();
       
                        // Fetch the result
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                // Check if the users exists
                if ($user) { 
                        // Verify password
                    if (password_verify($inputPassword, $user['password'])) {
                        // echo "Login Successful.";
                        $_SESSION['user_id'] = $user['id']; // Set the logged-in user;s ID
                        // $_SESSION['success'] = "Login Successful.";
                        header("Location: ../../profile.php");
                        exit;
                    } else {
                        // $error = "Invalid password.";
                        $_SESSION['error'] = "Invalid password.";
                        error_log("Password mismatch for user: $inputUsername");
                        header("Location: ../../login.php");
                        exit;
                    }
            

            } else {
                $_SESSION['error'] = "Username not found.";
                error_log("Username not found: $inputUsername");
                header("Location: ../../login.php");
                exit;
            }

         }
         } catch (PDOException $e) {
    echo "Login Error: " . $e->getMessage();
}
