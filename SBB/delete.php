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
    }
    catch (PDOException $e) {

    }
}