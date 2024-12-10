<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    $_SESSION['error'] = "Please login to access your profile";
    header("Location: ../../login.php");
    exit;
}

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
        <table>
                <th><strong>User ID:</strong>
                    <td>wjaoidjawo</td>
                </th>
            <tr>
                <th><strong>Username:</strong> 
                    <td>duhauw</td>
                </th>
            </tr>
            <tr>
                <th><strong>First Name:</strong>
                    <td>dwadwa</td>
                </th> 
            </tr>
                <th><strong>Last Name:</strong> 
                    <td>dwadwadwa</td>
                </th>
            <tr>
                <th><strong>Email:</strong>
                    <td>dwadwa</td>
                </th>
            </tr>
            <tr>
                <th><strong>Contact Number:</strong>
                    <td>dwadadaw</td>
                </th>
            </tr>
        </table>
    </main>
</body>
</html>