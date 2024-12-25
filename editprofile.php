<?php
include_once 'php/editprofile_logic.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <link rel="stylesheet" href="css/edit_profile.css">
</head>
<body>
    
    <header>
        <h1>Edit Profile</h1>
    </header>

    <main>

        <?php if ($error): ?>
            <p><?= $error ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p><?= $success ?></p>
        <?php endif; ?>

        <div id="bodyForm">
            <form action="php/editprofile_logic.php" method="post">

                <input type="password" name="password" placeholder="    New Password">

                <input type="text" name="firstName" placeholder="   Enter First Name">

                <input type="text" name="lastName" placeholder="   Enter Last Name">

                <input type="email" name="email" placeholder="   Enter Email">

                <input type="text" name="contactNumber" placeholder="   Enter Contact Number">

                <input type="text" name="prefecture" placeholder="   Enter Prefecture">

                <input type="text" name="city" placeholder="    Enter City">

                <input type="text" name="town" placeholder="    Enter Town/Street">

                <button type="submit" class="btnSave">Save Changes</button>

                <p><a href="../../profile.php">Back</a></p>
                
            </form>
        </div>
        
    </main>
</body>
</html>