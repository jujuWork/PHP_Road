<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    
    <div id="bodyForm">
            <form action="php/signup.php" method="post">
                <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Enter Username">
                <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Enter Password">
                <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Enter Email">

                <button type="submit" class="btnSubmit">Submit</button>
            </form>
    </div>
</body>
</html>