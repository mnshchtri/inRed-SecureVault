<?php
session_start();
include 'config/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vulnerability: SQL Injection
    // The input is not sanitized before being used in the query.
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $_SESSION['username'] = $username;
        header("location: index.php");
    } else {
        header("location: login.php?error=Invalid username or password");
    }
}
?>