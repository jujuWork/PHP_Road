<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $to = "joharrywork@gmail.com";                              // ACTUAL EMAIL
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    
    $headers = "From: $email\r\n";                              // SENDERS EMAIL
    $headers .= "Reply-To: $email\r\n";     
    $header .= "Content-Type: /text/html; charset=UTF-8\r\n";

    $fullMessage = "<html><body>";
    $fullMessage .= "<p><strong>Name:</strong> $name</p>";
    $fullMessage .= "<p><strong>Email:</strong> $email</p>";
    $fullMessage .= "<p><strong>Subject:</strong> $subject</p>";
    $fullMessage .= "<p><strong>Message:</strong> $message</p>";
    $fullMessage = "</body></html>";

    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "Message sent successfullly!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request.";
}