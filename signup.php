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
    <main>
        <div id="bodyForm">
                <form action="/signUp/php/signup.php" method="post">
                    <input type="text" name="firstName" placeholder="First Name">    

                    <input type="text" name="lastName" placeholder="Last Name">

                    <input type="text" name="username" placeholder="Username">
                
                    <input type="password" name="password" placeholder="Password">
                    
                    <input type="email" name="email" placeholder="Email">

                    <textarea name="address" placeholder="Address"></textarea>
                
                    <input type="number" name="contactNumber" placeholder="Contact Number">

                    <button type="submit" class="btnSubmit">Submit</button>
                </form>
        </div>
    </main>
</body>
</html>