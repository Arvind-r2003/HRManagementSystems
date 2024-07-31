<?php
include('./db.php');

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$department_id = $_POST['department'];
$designation_id = $_POST['designation'];
$date_of_birth = $_POST['date_of_birth'];
$date_of_joining = $_POST['date_of_joining'];

$sql = "INSERT INTO employees (first_name, last_name, email, phone, department_id, designation_id, date_of_birth, date_of_joining)
        VALUES ('$first_name', '$last_name', '$email', '$phone', '$department_id', '$designation_id', '$date_of_birth', '$date_of_joining')";

if ($conn->query($sql) === TRUE) {
    echo "New employee added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
