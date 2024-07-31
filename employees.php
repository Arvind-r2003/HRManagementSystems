<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees - HRMS</title>
    <link rel="stylesheet" href="css/employees.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Inline CSS for simplicity */
        .edit-box {
            display: none;
        }
        .edit-box.active {
            display: table-row;
        }
        .edit-box input {
            margin: 0;
            padding: 5px;
            width: 100%;
        }
    </style>
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>
        <h2>Employees List</h2>

        <?php if (isset($_GET['message'])): ?>
            <div class="message success">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="message error">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

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
                    <th>Action</th>
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
                        echo "<tr id='row-{$row['id']}'>
                                <td>{$row['id']}</td>
                                <td>{$row['first_name']}</td>
                                <td>{$row['last_name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['phone']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['designation']}</td>
                                <td>{$row['date_of_birth']}</td>
                                <td>{$row['date_of_joining']}</td>
                                <td>
                                    <a href='#' onclick='showEditBox({$row['id']})'>Edit</a> | 
                                    <a href='includes/delete-employee.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this employee?\")'>Delete</a>
                                </td>
                              </tr>
                              <tr class='edit-box' id='edit-box-{$row['id']}'>
                                <form action='includes/process-edit-employee.php' method='POST'>
                                    <input type='hidden' name='id' value='{$row['id']}'>
                                    <td colspan='10'>
                                        <input type='text' name='first_name' value='{$row['first_name']}' required>
                                        <input type='text' name='last_name' value='{$row['last_name']}' required>
                                        <input type='email' name='email' value='{$row['email']}' required>
                                        <input type='text' name='phone' value='{$row['phone']}' required>
                                        <select name='department' required>
                                            ";
                                            $departments = $conn->query("SELECT * FROM departments");
                                            while ($dept = $departments->fetch_assoc()) {
                                                $selected = $row['department_id'] == $dept['id'] ? 'selected' : '';
                                                echo "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
                                            }
                                            echo "
                                        </select>
                                        <select name='designation' required>
                                            ";
                                            $designations = $conn->query("SELECT * FROM designations");
                                            while ($desig = $designations->fetch_assoc()) {
                                                $selected = $row['designation_id'] == $desig['id'] ? 'selected' : '';
                                                echo "<option value='{$desig['id']}' $selected>{$desig['name']}</option>";
                                            }
                                            echo "
                                        </select>
                                        <input type='date' name='date_of_birth' value='{$row['date_of_birth']}' required>
                                        <input type='date' name='date_of_joining' value='{$row['date_of_joining']}' required>
                                        <button type='submit'>Update</button>
                                        <button type='button' onclick='hideEditBox({$row['id']})'>Cancel</button>
                                    </td>
                                </form>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="add-employee.php" class="add-employee-button">Add Employee</a>
    </div>

    <script>
        function showEditBox(id) {
            document.getElementById('row-' + id).style.display = 'none';
            document.getElementById('edit-box-' + id).style.display = 'table-row';
        }

        function hideEditBox(id) {
            document.getElementById('row-' + id).style.display = 'table-row';
            document.getElementById('edit-box-' + id).style.display = 'none';
        }
    </script>
</body>
</html>
