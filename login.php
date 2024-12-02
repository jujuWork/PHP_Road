<?php include 'signUp/php/login.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
        <!-- Display any message -->
    <?php if(!empty($message)): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div id="bodyForm">
        <form action="signUp/php/login_logic.php">
            <label for="username">Username:</label>
                <input type="text" name="username" placeholder="Enter Username">

            <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter Password">
            <button type="submit" class="btnSubmit">Login</button>
        </form>
    </div>
</body>
</html>