<?php

require_once 'db/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please login to access your profile";
    header("Location: ../../login.php");
    exit;
}

$userID = $_SESSION['user_id'];
$error = "";
$success = "";

    // FETCH current user data
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

    // PROCESS from submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // COLLECT INPUT FIELDS
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $contactNumber = htmlspecialchars($_POST['contact_number']);
    $prefecture = htmlspecialchars($_POST['prefecture']);
    $city = htmlspecialchars($_POST['city']);
    $town = htmlspecialchars($_POST['town']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    try {
            // UPDATE QUERY (EXCLUDE PASSWORD IF EMPTY)
        if ($password) {
            $updateQuery = "UPDATE users SET
                            first_name = :first_name,
                            last_name = :last_name,
                            email = :email,
                            contact_number = :contact_number,
                            prefecture = :prefecture,
                            city = :city,
                            town = :town,
                            password = :password 
                            WHERE id = :user_id
                            ";
        } else {
            $updateQuery = "UPDATE users SET
                            first_name = :first_name,
                            last_name = :last_name,
                            email = :email,
                            contact_number = :contact_number,
                            prefecture = :prefecture,
                            city = :city,
                            town = :town,
                            WHERE id = :user_id
                            ";
        }
            // PREPARE and BIND PARAMETERS
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
        $updateStmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $updateStmt->bindParam(':contact_number', $contactNumber, PDO::PARAM_STR);
        $updateStmt->bindParam(':prefecture', $prefecture, PDO::PARAM_STR);
        $updateStmt->bindParam(':city', $city, PDO::PARAM_STR);
        $updateStmt->bindParam(':town', $town, PDO::PARAM_STR);
        $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

        if ($password) {
            $updateStmt->bindParam(':password', $password, PDO::PARAM_STR);
        }

            // EXECUTE QUERY AND CHECK
        if ($updateStmt->execute()) {
            $success = "Profile has beend updated successfully!";
            header("Location: ../../profile.php");
            exit;
        } else {
            $error = "Error updating profile.";
        }


    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}