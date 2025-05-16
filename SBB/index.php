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

// Fixing the current page if its greater than the total page (現在のページが合計ページより大きい場合は修正します)
if ($current_page > $total_pages && $total_pages > 0) {
    $current_page = $total_pages;
}

// Calculating OFFset (オフセットの計算)
$offset = ($current_page - 1) * $post_per_page;

// Post Data (newest first) (投稿データ（最新順）)
$stmt = $pdo->prepare('SELECT * FROM posts ORDER BY post_date DESC LIMIT :limit OFFSET :offset');
$stmt->bindParam(':limit', $post_per_page, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll();

// Flash Message (フラッシュメッセージ)
$message = '';
$message_type = '';

if(isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $message_type = $_SESSION['message_type'];

    // Delete message after viewing (メッセージを表示したら削除)
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Board(掲示板)</title>
</head>
<body>
    
    <h1>Message Board(掲示板)</h1>

    <?php if ($message): ?>
        <div class="message <?php echo $message_type ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <!-- Submission Form (投稿フォーム) -->
     <div class="post-form">
        <h2>New Post</h2>
        <form action="post.php" method="post">
            <div class="form-group">
                <label for="poster_name">Name:</label>
                <input type="text" name="poster_name" id="poster_name" required>
            </div>

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" id="content" required></textarea>
            </div>

            <button type="submit" class="submit-btn">Post</button>


        </form>
     </div>
</body>
</html>