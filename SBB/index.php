<?php

// Database Connection Setting (データベース設定を読み込む)
require_once 'config.php';

// Number of post per page (１ページあたりの投稿数表ジース)
$post_per_page = 20;

// Current page number, default is 1 (現在のページ番号、デフォルトは1)
$current_page = isset($_get['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    }

// Total number of posts (投稿総数)
$stmt = $pdo->query('SELECT COUNT(*) FROM posts');
$total_posts = $stmt->fetchColumn();

// Calculate the number of page (ページ数を計算する)
$total_pages = ceil($total_posts / $posts_per_page);

// Fixing the current page if its greater than the total page
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Calculating OFFset
$offset = ($current_page - 1) * $post_per_page;

// Post Data (newest first)