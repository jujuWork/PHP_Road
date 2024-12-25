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
    $password = htmlspecialchars($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : null;
    $firstName = htmlspecialchars($_POST['first_name']);
    $lastName = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $contactNumber = htmlspecialchars($_POST['contact_number']);
    $prefecture = htmlspecialchars($_POST['prefecture']);
    $city = htmlspecialchars($_POST['city']);
    $town = htmlspecialchars($_POST['town']);
}