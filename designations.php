<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Designations - HRMS</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #fff;
            font-weight: bold;
        }
        .message.success {
            background-color: #28a745;
        }
        .message.error {
            background-color: #dc3545;
        }
        .message.info {
            background-color: #17a2b8;
        }
        form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f4f4f4;
        }
        a {
            color: #dc3545;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>
        <h2>Manage Designations</h2>

        <?php
        // Handle designation addition
        if (isset($_POST['add_designation'])) {
            $designation_name = $_POST['designation_name'];
            if (!empty($designation_name)) {
                $sql = "INSERT INTO designations (name) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $designation_name);
                if ($stmt->execute()) {
                    echo "<div class='message success'>Designation added successfully!</div>";
                } else {
                    echo "<div class='message error'>Error adding designation: " . $stmt->error . "</div>";
                }
            } else {
                echo "<div class='message error'>Designation name cannot be empty.</div>";
            }
        }

        // Handle designation deletion
        if (isset($_GET['delete'])) {
            $designation_id = $_GET['delete'];
            
            // Check if the designation is being used
            $checkSql = "SELECT COUNT(*) as count FROM employees WHERE designation_id = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("i", $designation_id);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            $checkRow = $checkResult->fetch_assoc();

            if ($checkRow['count'] > 0) {
                echo "<div class='message info'>Cannot delete this designation because it is assigned to employees. Please reassign employees first.</div>";
            } else {
                $sql = "DELETE FROM designations WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $designation_id);
                if ($stmt->execute()) {
                    echo "<div class='message success'>Designation deleted successfully!</div>";
                } else {
                    echo "<div class='message error'>Error deleting designation: " . $stmt->error . "</div>";
                }
            }
        }
        ?>

        <h3>Add New Designation</h3>
        <form action="designations.php" method="POST">
            <label for="designation_name">Designation Name:</label>
            <input type="text" id="designation_name" name="designation_name" required>
            <button type="submit" name="add_designation">Add Designation</button>
        </form>

        <h3>Existing Designations</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Designation Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM designations";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>
                                    <a href='designations.php?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this designation?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No designations found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
