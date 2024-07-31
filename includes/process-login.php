<?php
session_start();
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to fetch user details
    $stmt = $conn->prepare("SELECT * FROM hr_user WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if ($password === $user['password']) { // Assuming passwords are stored in plain text
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];

            // Redirect with success message
            header('Location: ../index.php?message=Login successful');
            exit;
        } else {
            header('Location: ../login.php?error=Invalid username or password');
            exit;
        }
    } else {
        header('Location: ../login.php?error=Invalid username or password');
        exit;
    }
}
?>
