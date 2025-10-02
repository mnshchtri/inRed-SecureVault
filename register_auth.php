<?php
include 'config/db.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Vulnerability: SQL Injection
    // The input is not sanitized before being used in the query.
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";

    if($conn->query($sql) === TRUE){
        header("location: login.php?message=Registration successful!");
    } else {
        header("location: register.php?error=Error: " . $sql . "<br>" . $conn->error);
    }
}
?>