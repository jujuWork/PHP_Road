<?php

session_start(); // Starting session to save error message

ini_set('display_errors', 1);
error_reporting(E_ALL);

    // Creating Image folder if doesn't exist

if (!is_dir('images')) {
    mkdir('images');
}

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Setting the file destination
    $targetFile = 'images/' . basename($_FILES['image']['name']);

    //Move the upload file to the "Image Folder"
    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        header("Location: upload.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Error: Cound not save the upload file.";
    }
} else {
    $_SESSION['error_message'] = "Error: no file uploaded.";
}