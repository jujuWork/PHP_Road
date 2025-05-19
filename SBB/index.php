<?php

// Database Connection Setting (データベース設定を読み込む)
require_once 'config.php';

// Number of post per page (１ページあたりの投稿数表ジース)
$post_per_page = 20;

// Current page number, default is 1 (現在のページ番号、デフォルトは1)
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($current_page < 1) {
        $current_page = 1;
    }

// Total number of posts (投稿総数)
$stmt = $pdo->query('SELECT COUNT(*) FROM posts');
$total_posts = $stmt->fetchColumn();

// Calculate the number of page (ページ数を計算する)
$total_pages = ceil($total_posts / $post_per_page);

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

    <link rel="stylesheet" href="../SBB/styles.css">
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

    <!-- List of Post -->
    <div class="posts-container">
        <h2>List of Post</h2>

        <?php if (count($posts) > 0): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <div class="post-header">
                        <h3 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h3>
                        <div class="post-meta">
                            <span>Posted By: <?php echo htmlspecialchars($post['poster_name']); ?></span>
                            <span>Time and Date Posted: <?php echo htmlspecialchars($post['post_date']); ?></span>
                        </div>
                    </div>

                    <div class="post-content">
                        <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                    </div>
                    <form action="delete.php" method="post" onsubmit="return confirm('Are you sure to delete this?');">
                        <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>There is no post yet.</p>
        <?php endif; ?>
    </div>


    <!-- Pagination -->
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($current_page > 1): ?>
                <a href="?page=<?php echo $current_page - 1 ?>">Back</a>
            <?php endif; ?>

            <?php
                // Page link
                $range = 2;

                for ($i = 1; $i <= $total_pages; $i++) {
                    // Dispaly within $range before and after 
                    if ($i <= $range || $i > $total_pages - $range || abs($i - $current_page) <= $range) {
                        if ($i == $current_page) {
                            echo "<span class=\"active\"></span>";
                        } else {
                            echo "<a href=\"?page=$i\">$i</a>";
                        }
                    } else if ($i == $range + 1 || $i == $total_pages - $range) {
                        echo "<span>...</span>";
                    }
                }
            ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="?page=<?php echo $current_page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>

</body>
</html>