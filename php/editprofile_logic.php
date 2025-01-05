<?php

require_once __DIR__ . '/../db/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please login to access your profile";
    header("Location: ../../login.php");
    exit;
}

$userID = $_SESSION['user_id'];

    // FETCH current user data
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $userID, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);


    // PROCESS from submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // COLLECT INPUT FIELDS
    $firstName = htmlspecialchars($_POST['firstName']);
    $lastName = htmlspecialchars($_POST['lastName']);
    $email = htmlspecialchars($_POST['email']);
    $contactNumber = htmlspecialchars($_POST['contactNumber']);
    $prefecture = htmlspecialchars($_POST['prefecture']);
    $city = htmlspecialchars($_POST['city']);
    $town = htmlspecialchars($_POST['town']);
    $linkedin = htmlspecialchars($_POST['linkedin']);
    $facebook = htmlspecialchars($_POST['facebook']);
    $instagram = htmlspecialchars($_POST['instagram']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;

    if (
        empty($firstName) ||
        empty($lastName) ||
        empty($email) ||
        empty($contactNumber) ||
        empty($prefecture) ||
        empty($city) ||
        empty($town) ||
        empty($password) ||
        empty($linkedin) ||
        empty($facebook) ||
        empty($instagram)
        )
    
    {
        $_SESSION['error'] = "All fields are required except for password";
        header("Location: ../../editprofile.php");
        exit;
    }

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
                            linkedin = :linkedin,
                            facebook = :facebook,
                            instagram = :instagram,
                            password = :password 
                            WHERE id = :user_id";
        } else {
            // IF PASSWORD IS NOT PROVIDED
            $updateQuery = "UPDATE users SET
                            first_name = :first_name,
                            last_name = :last_name,
                            email = :email,
                            contact_number = :contact_number,
                            prefecture = :prefecture,
                            city = :city,
                            town = :town,
                            linkedin = :linkedin,
                            facebook = :facebook,
                            instagram = :instagram
                            WHERE id = :user_id";
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
        $updateStmt->bindParam(':linkedin', $linkedin, PDO::PARAM_STR);
        $updateStmt->bindParam(':facebook', $facebook, PDO::PARAM_STR);
        $updateStmt->bindParam(':instagram', $instagram, PDO::PARAM_STR);
        $updateStmt->bindParam(':user_id', $userID, PDO::PARAM_INT);


        if ($password) {
            $updateStmt->bindParam(':password', $password, PDO::PARAM_STR);
        }

            // EXECUTE QUERY AND CHECK
        if ($updateStmt->execute()) {
            $_SESSION ['success'] = "Profile has beend updated successfully!";
            header("Location: ../../editprofile.php");
            exit;
        } else {
            $_SESSION ['error'] = "Error updating profile.";
            print_r($updateStmt->errorInfo());
            // header("Location: ../../editprofile.php");
            exit;
        }


    } catch (PDOException $e) {
        $_SESSION ['error'] = "Database error: " . $e->getMessage();
        header("Location: ../../editprofile.php");
        exit;
    }
}