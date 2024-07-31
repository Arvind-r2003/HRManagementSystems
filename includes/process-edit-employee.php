<?php
include('../db.php');

$id = $_POST['id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department_id = $_POST['department'];
$designation_id = $_POST['designation'];
$date_of_birth = $_POST['date_of_birth'];
$date_of_joining = $_POST['date_of_joining'];

// Update employee details
$sql = "UPDATE employees 
        SET first_name = '$first_name', 
            last_name = '$last_name', 
            email = '$email', 
            phone = '$phone', 
            department_id = '$department_id', 
            designation_id = '$designation_id', 
            date_of_birth = '$date_of_birth', 
            date_of_joining = '$date_of_joining' 
        WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../employees.php?message=Employee updated successfully");
} else {
    header("Location: ../employees.php?error=" . urlencode("Error: " . $conn->error));
}

$conn->close();
?>
