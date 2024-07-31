<?php
include('../db.php');

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    $sql = "DELETE FROM employees WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $employee_id);

    if ($stmt->execute()) {
        header("Location: ../employees.php?message=Employee deleted successfully");
    } else {
        header("Location: ../employees.php?error=Error deleting employee");
    }

    $stmt->close();
} else {
    header("Location: ../employees.php?error=No employee ID provided");
}

$conn->close();
?>
