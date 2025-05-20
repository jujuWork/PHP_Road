<?php

// Database
require_once 'config.php';

// Post data check
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // GET data submitted from form
    $poster_name = trim($_POST['poster_name'] ?? '');
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // Data checker
    if (empty($poster_name) || empty($title) || empty($content)) {
        // If empty error message will appear
        $_SESSION['message'] = 'Please Enter all fields / 全ての項目を入力してください。';
        $_SESSION['message_type'] = 'error';
        header('Location: index.php');
        exit;
    }

    // Database Saved
    try {
        $stmt = $pdo->prepare('INSERT INTO posts (poster_name, title, content) VALUES (:poster_name, :title, :content)');
        $stmt->bindParam(':poster_name', $poster_name, PDO::PARAM_STR);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['message'] = 'Posting Completed / 投稿が完了しました';
        }
    }

    catch {

    }
}