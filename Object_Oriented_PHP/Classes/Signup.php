<?php

class Signup extends Dbh // this means that the DBH is the parent class and the Signup class is the child class
{
    // Create a property for the UN and PW
    private $username;
    private $pwd;

    // Create a Contructor
    public function __construct($username, $pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
    }

    private function insertUser () {
        // QUERY STATEMENT
        $query = "INSERT INTO users ('username', 'pwd') VALUES (:username, :pwd);";

        // SAME AS PROCEDURAL PHP
        $stmt = $this->connect()->prepare($query); // this->connect means that you want to connect to the dbh that is assign as a private in dbh.php instead of using the normal $pdo connection
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":pwd", $this->pwd);
        $stmt->execute();
    }

    private function isEmptySubmit() {
        if (isset($this->username) && isset($this->pwd)) {
            return false; // IF there no error
        } else {
            return true; // if There is an error
        }
    }

    public function signupUser() {
        // ERROR HANDLERS
        // If there is a error this code will run
        if ($this->isEmptySubmit()) {
            header("Location: " . $_SERVER['DOCUMENT_ROOT'] . './index.php');
            die();
        }
        // IF no errors, signup user
        $this->insertUser();
    }
}