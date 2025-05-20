<?php

// Database
require_once  'config.php';

// POST data checker
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    // GET POST ID
    $post_id = (int)$_POST['post_id'];

    try {
        $stmt = $pdo->prepare('DELETE FROM posts WHERE post_id = :post_id');
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result && $stmt->rowCount() > 0) {
            $_SESSION['message'] = 'Post Deleted / 投稿を削除しました.';
            $_SESSION['message_type'] = 'Success';
        } else {
            $_SESSION['message'] = 'Delete Error / 削除できませんでした.';
            $_SESSION['message_type'] = 'error';
        }
    }
    catch (PDOException $e) {
        // Database Error
        $_SESSION['message'] = 'Database Error: ' . $e->getMessage();
        $_SESSION['message_type'] = 'error';
    } 

    } else {
        $_SESSION['message'] = 'Unauthorized Access / 不正なアクセスです';
        $_SESSION['message_type'] = 'error';
    }

    header('Location: index.php');
    exit;