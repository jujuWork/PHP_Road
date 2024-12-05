<?php include 'php/login_logic.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="css/login_styles.css">
</head>
<body>
 
    
    <header>
        <h1>Login</h1>
    </header>

    <main id="bodyForm">
            <form action="php/login_logic.php" method="post">
                
                <input type="text" name="username" placeholder="    Username">
                <input type="password" name="password" placeholder="    Password">
                    <p class="forgot">Forgot <a href="forgot.php">Username / Password?</a></p>
                <button type="submit" class="btnSubmit">Login</button>
            </form>
        <div class="signUpFooter">
            <p>Don't have an account?</p>
            <a href="signup.php" class="noAccount"><p>Sign Up Now</p></a>
        </div>
    </main>

</body>
</html>