<?php

require_once 'db/db.php';


session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please login to access your profile";
    header("Location: ../../login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>

    <link rel="stylesheet" href="css/index.css">

            <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="leftSide">
        <header>
            <div class="profile_info">
                <img src="upload/images/profilepic.jpg" alt="profile">
                    <span>
                        <h1>Sanchez <br> Joharry</h1>
                    </span>
            </div>
            <div class="contact">
                <table>
                    <tr>
                        <td class="info_img"><img src="upload/images/CS.png" alt="contact"></td>
                        <td class="info_name"><h2>CONTACT ME</h2></td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/email.png" alt="email"></td>
                        <td class="info_name">
                            <?= htmlspecialchars($user['email']) ?></td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/mobile.png" alt="mobile"></td>
                        <td class="info_name">
                            <?= htmlspecialchars($user['contact_number']) ?></td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/location.png" alt="location"></td>
                        <td class="info_name">
                            <p><?= htmlspecialchars($user['prefecture']) ?></p>
                            <p><?= htmlspecialchars($user['city']) ?></p>
                            <p><?= htmlspecialchars($user['town'])?></p>
                        </td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/linkedin.png" alt="linkedIN"></td>
                        <td class="info_name">
                            <a href="<?= htmlspecialchars($user['linkedin']) ?>" target="_blank">linkedIn</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/facebook.png" alt="facebook"></td>
                        <td class="info_name">
                            <a href="<?= htmlspecialchars($user['facebook']) ?>" target="_blank">Facebook</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/instagram.png" alt="instagram"></td>
                        <td class="info_name">
                            <a href="<?= htmlspecialchars($user['instagram']) ?>" target="_blank">instagram</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/instagram.png" alt="instagram"></td>
                        <td class="info_name">
                            <a href="<?= htmlspecialchars($user['instagram']) ?>" target="_blank">instagram</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="info_img"><img src="upload/images/instagram.png" alt="instagram"></td>
                        <td class="info_name">
                            <a href="<?= htmlspecialchars($user['instagram']) ?>" target="_blank">instagram</a>
                        </td>
                    </tr>
                </table>
            </div>
        </header>
    </div>
    <div class="rightSide">
            <h2>Education:</h2>
    </div>
</body>
</html>