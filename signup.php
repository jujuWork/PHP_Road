<?php

session_start();
// require_once 'php/signup_logic.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="css/signup_styles.css">
</head>
<body>
    <header>
        <h1>Sign Up</h1>
    </header>

    <?php if (!empty($_SESSION['error'])): ?>
                    <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error']);?></p>
                    <?php unset($_SESSION['error']);?>
        <?php endif; ?>
    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_SESSION['success']);?></p>
                    <?php unset($_SESSION['success']);?>
        <?php endif; ?>
    

    <main>
        <div id="bodyForm">
                <form action="php/signup_logic.php" method="post">

                    <input type="text" name="username" placeholder="    Username">
                
                    <input type="password" name="password" placeholder="    Password">
                    
                    <input type="email" name="email" placeholder="    E-mail">

                    <input type="text" name="firstName" placeholder="    First Name">    

                    <input type="text" name="lastName" placeholder="    Last Name">

                    <input type="number" name="contactNumber" placeholder="    Contact Number">

                    <input type="text" name="prefecture" placeholder="    Prefecture">

                    <input type="text" name="city" placeholder="    City">

                    <input type="text" name="town" placeholder="    Town/Street">

                    

                    <button type="submit" class="btnSubmit">Submit</button>
                </form>

        <div class="loginfooter">
            <a href="../../login.php">
                <p>Back to Login</p>
            </a>
        </div>  
        </div>
    </main>
</body>
</html>