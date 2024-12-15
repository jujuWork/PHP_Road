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
    <title>My Profile</title>

    <link rel="stylesheet" href="css/profile_style.css">
</head>
<body>
  
    <section class="links">
        <ul>
            <li>Logout</li>
            <li>Portfolio</li>
        </ul>
    </section>
    <!-- <section>
        <form action="logout.php" method="post">
            <button type="submit" class="btn_logout">Logout</button>
            <button>Portfolio</button>
        </form>
    </section> -->
    
    <header>
        <h1>My Profile</h1>
    </header>

    <main>
        <?php if ($user): ?>

            <table>
                        <th><strong>User ID:</strong>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                        </th>
                    <tr>
                        <th><strong>Username:</strong> 
                            <td><?= htmlspecialchars($user['username']) ?></td>
                        </th>
                    </tr>
                    <tr>
                        <th><strong>Password:</strong> 
                            <td>
                                <?= str_repeat('*', strlen(htmlspecialchars(substr($user['password'], 0, 10)))) ?>
                            </td>
                        </th>
                    </tr>
                    <tr>
                        <th><strong>First Name:</strong>
                            <td><?= htmlspecialchars($user['first_name']) ?></td>
                        </th>
                    </tr>
                        <th><strong>Last Name:</strong> 
                            <td><?= htmlspecialchars($user['last_name']) ?></td>
                        </th>
                    <tr>
                        <th><strong>Email:</strong>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </th>
                    </tr>
                    <tr>
                        <th><strong>Contact Number:</strong>
                            <td><?= htmlspecialchars($user['contact_number']) ?></td>
                        </th>
                    </tr>
            </table>
                    <?php else: ?>
                        <p>No data found in the database.</p>
        <?php endif; ?>
    </main>

</body>
</html>