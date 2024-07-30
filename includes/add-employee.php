<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee - HRMS</title>
    <link rel="stylesheet" href="css/add-employee.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>
        <h2>Add Employee</h2>
        <form action="process-add-employee.php" method="POST">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="department">Department:</label>
            <select id="department" name="department" required>
                <?php
                $departments = $conn->query("SELECT * FROM departments");
                while ($dept = $departments->fetch_assoc()) {
                    echo "<option value='{$dept['id']}'>{$dept['name']}</option>";
                }
                ?>
            </select>

            <label for="designation">Designation:</label>
            <select id="designation" name="designation" required>
                <?php
                $designations = $conn->query("SELECT * FROM designations");
                while ($desig = $designations->fetch_assoc()) {
                    echo "<option value='{$desig['id']}'>{$desig['name']}</option>";
                }
                ?>
            </select>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" required>

            <label for="date_of_joining">Date of Joining:</label>
            <input type="date" id="date_of_joining" name="date_of_joining" required>

            <button type="submit">Add Employee</button>
        </form>
    </div>
</body>
</html>
