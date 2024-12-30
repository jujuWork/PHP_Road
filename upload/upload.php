<?php
    session_start(); // Starting sessino for image upload
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
    
    <?php
        if(isset($_SESSION['success'])) {
            echo "<p style='color: red;'>" . $_SESSION['success'] . "</p>";
            unset($_SESSION['success']);
        }
    
        if (isset($_SESSION['error_message'])) {
            echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
            unset($_SESSION['error_message']); // Clearing message after display
        }
    ?>

    <!-- Upload form for image file -->
    <form action="uploadAction.php" method="post" enctype="multipart/form-data">
        <label for="image">Upload Image</label> <br><br>
            <input type="file" name="image"> <br><br>
                <button type="submit">Upload</button>
    </form>
</body>
</html>