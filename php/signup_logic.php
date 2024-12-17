<?php

session_start();

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
        $prefecture = htmlspecialchars($_POST['prefecture']);
        $city = htmlspecialchars($_POST['city']);
        $town = htmlspecialchars($_POST['town']);

        if (
                empty($username) || 
                empty($password) || 
                empty($email) || 
                empty($firstName) || 
                empty($lastName) || 
                empty($contactNumber) ||
                empty($prefecture) ||
                empty($city) ||
                empty($town)
            )

            {
            $_SESSION['error'] = "All fields are required";
            // header("Location: ../../signup.php");
            // exit;
        } else {

            // Inserting data to MYSQL
        $sql = "INSERT INTO users (username, password, email, first_name, last_name, contact_number, prefecture, city, town) 
                VALUES (:username, :password, :email, :firstName, :lastName, :contactNumber, :prefecture, :city, :town)";

        $stmt = $pdo->prepare($sql);

            // Bind parameters to the prepared statement
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':contactNumber', $contactNumber);
        $stmt->bindParam(':prefecture' , $prefecture);
        $stmt->bindParam(':city' , $city);
        $stmt->bindParam(':town' , $town);

            // Execute query
        $stmt->execute();
        
        $_SESSION['success'] = "Sign up successful.";

        }

        header("Location: ../../signup.php");
        exit;

    } catch (PDOException $e) {
        $_SESSION['error'] = "Sign up error: " . $e->getMessage();
    }
}
