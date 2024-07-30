<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees - HRMS</title>
    <link rel="stylesheet" href="css/employees.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>
        <h2>Employees List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Designation</th>
                    <th>Date of Birth</th>
                    <th>Date of Joining</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT e.id, e.first_name, e.last_name, e.email, e.phone, d.name as department, de.name as designation, e.date_of_birth, e.date_of_joining 
                        FROM employees e 
                        LEFT JOIN departments d ON e.department_id = d.id 
                        LEFT JOIN designations de ON e.designation_id = de.id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['designation']}</td>
                                <td>{$row['date_of_birth']}</td>
                                <td>{$row['date_of_joining']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="includes/add-employee.php" class="add-employee-button">Add Employee</a>
    </div>
</body>
</html>
