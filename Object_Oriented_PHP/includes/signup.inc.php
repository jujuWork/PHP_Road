<?php 
    // BASIC PHP
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];


    // OBJECT ORIENTED PHP
        // MUST BE IN ORDER
    require_once '../Classes/Dbh.php'; //(FIRST to be called PARENT CLASS)
    require_once '../Classes/Signup.php'; //(SECOND , CHILD CLASS)

    $signup = new Signup($username, $pwd);
    $signup->signupUser();
}