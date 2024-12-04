<?php include 'signUp/php/login_logic.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
        <?php if(!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif ?>
    
    <header>
        <h1>Login</h1>
    </header>

    <main id="bodyForm">
            <form action="signUp/php/login_logic.php" method="post">
                
                <input type="text" name="username" placeholder="Enter Username">
                <input type="password" name="password" placeholder="Enter Password">
              
                <button type="submit" class="btnSubmit">Login</button>
            </form>
    </main>
</body>
</html>