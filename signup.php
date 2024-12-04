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
            <form action="/signUp/php/signup.php" method="post">
                <label for="username">Username:</label>
                    <input type="text" name="username" placeholder="Username">
                <label for="password">Password:</label>
                    <input type="password" name="password" placeholder="Password">
                <label for="email">Email:</label>
                    <input type="email" name="email" placeholder="Email">

                <button type="submit" class="btnSubmit">Submit</button>
            </form>
    </div>
</body>
</html>