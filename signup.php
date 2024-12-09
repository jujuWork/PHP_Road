<?php

session_start();

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

    <?php 
    
    if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
    }
    if (isset($_SESSION['success'])) {
        echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }

    ?>

    <main>
        <div id="bodyForm">
                <form action="php/signup_logic.php" method="post">

                    <input type="text" name="username" placeholder="    Username">
                
                    <input type="password" name="password" placeholder="    Password">
                    
                    <input type="email" name="email" placeholder="    E-mail">

                    <input type="text" name="firstName" placeholder="    First Name">    

                    <input type="text" name="lastName" placeholder="    Last Name">

                    <input type="number" name="contactNumber" placeholder="    Contact Number">




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