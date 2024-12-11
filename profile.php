<?php


session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please login to access your profile";
    header("Location: ../../login.php");
    exit;
}


include 'db/db.php';

$query = "SELECT * FROM users";
$stmt = $pdo->prepare($query);
$stmt->execute();

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    
    <header>
        <h1>My Profile</h1>
        <h2>Hello</h2>
    </header>

    <main>
        <?php if ($results): ?>
            <table>
                <?php foreach ($results as $row): ?>
                        <th><strong>User ID:</strong>
                            <td><?= htmlspecialchars($row('id')) ?></td>
                        </th>
                    <tr>
                        <th><strong>Username:</strong> 
                            <td><?= htmlspecialchars($row('username')) ?></td>
                        </th>
                    </tr>
                    <tr>
                        <th><strong>First Name:</strong>
                            <td><?= htmlspecialchars($row('firstName')) ?></td>
                        </th> 
                    </tr>
                        <th><strong>Last Name:</strong> 
                            <td><?= htmlspecialchars($row('lastName')) ?></td>
                        </th>
                    <tr>
                        <th><strong>Email:</strong>
                            <td><?= htmlspecialchars($row('email')) ?></td>
                        </th>
                    </tr>
                    <tr>
                        <th><strong>Contact Number:</strong>
                            <td><?= htmlspecialchars($row('contactNumber')) ?></td>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </table>
                    <?php else: ?>
                        <p>No data found in the database.</p>
        <?php endif; ?>
    </main>
</body>
</html>