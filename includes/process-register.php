<?php
include('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $email = $conn->real_escape_string($_POST['email']);

    // Check if user already exists
    $sql = "SELECT * FROM hr_user WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        header("Location: ../register.php?error=Username already exists");
        exit();
    }

    // Insert new user into the database
    $sql = "INSERT INTO hr_user (username, password, email) VALUES ('$username', '$password', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: ../login.php?message=Registration successful. Please login.");
        exit();
    } else {
        header("Location: ../register.php?error=Error: " . $conn->error);
        exit();
    }
}
?>
