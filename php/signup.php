<?php

$session_start();

    // Database connection
$host = '127.0.0.1';
$port = '8889';
$dbname = 'db_users';
$username = 'root';
$password = 'root';

    // Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO ("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Collect and sanitize form data
        $username = htmlspecialchars($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = htmlspecialchars($_POST['email']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $lastName = htmlspecialchars($_POST['lastName']);
        $contactNumber = htmlspecialchars($_POST['contactNumber']);

        if (empty($username) || empty($password) || empty($email) || empty($firstName) || empty($lastName) || empty($contactNumber)) {
            $_SESSION['error'] = "All fields are required";
            header("Location: ../../signup.php");
            exit;
        }

        // var_dump($firstName, $lastName, $username, $password, $email, $contactNumber);
        // exit;

            // Inserting data to MYSQL
        $sql = "INSERT INTO users (username, password, email, first_name, last_name, contact_number) 
                VALUES (:username, :password, :email, :firstName, :lastName, :contactNumber)";

        $stmt = $pdo->prepare($sql);

            // Bind parameters to the prepared statement
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':contactNumber', $contactNumber);

            // Execute query
        $stmt->execute();    
        
        if ($user) {
            $_SESSION['success'] = 'Sign up Successfull.';
        } else {
            $_SESSIOn['error'] = 'Sign up failed.';
        }

        echo "Signup Sucessful!"; // Output a success message upon insertion into database

    } catch (PDOException $e) {
        echo "Sign up error: " . $e->getMessage();
    }
}
// header("Location: ../../login.php");
// exit;