<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Departments - HRMS</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>
        <h2>Manage Departments</h2>

        <?php
        // Handle department addition
        if (isset($_POST['add_department'])) {
            $department_name = $_POST['department_name'];
            if (!empty($department_name)) {
                $sql = "INSERT INTO departments (name) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $department_name);
                if ($stmt->execute()) {
                    echo "<div class='message success'>Department added successfully!</div>";
                } else {
                    echo "<div class='message error'>Error adding department: " . $stmt->error . "</div>";
                }
            } else {
                echo "<div class='message error'>Department name cannot be empty.</div>";
            }
        }

        // Handle department deletion
        if (isset($_GET['delete'])) {
            $department_id = $_GET['delete'];
            $sql = "DELETE FROM departments WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $department_id);
            if ($stmt->execute()) {
                echo "<div class='message success'>Department deleted successfully!</div>";
            } else {
                echo "<div class='message error'>Error deleting department: " . $stmt->error . "</div>";
            }
        }
        ?>

        <h3>Add New Department</h3>
        <form action="departments.php" method="POST">
            <label for="department_name">Department Name:</label>
            <input type="text" id="department_name" name="department_name" required>
            <button type="submit" name="add_department">Add Department</button>
        </form>

        <h3>Existing Departments</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Department Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM departments";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>
                                    <a href='departments.php?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this department?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No departments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
