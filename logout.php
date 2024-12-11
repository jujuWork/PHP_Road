<?php

session_start();

    // Destroy all Session
session_unset();
session_destroy();

    // Redirecting into homepage
header("Location: login.php");
exit;