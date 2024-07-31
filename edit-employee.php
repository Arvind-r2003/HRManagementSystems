<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee - HRMS</title>
    <link rel="stylesheet" href="css/employees.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php
    // Check if a message is set for redirection
    if (isset($_GET['message'])) {
        echo '<meta http-equiv="refresh" content="5;url=employees.php?message=' . urlencode($_GET['message']) . '">';
    } elseif (isset($_GET['error'])) {
        echo '<meta http-equiv="refresh" content="5;url=employees.php?error=' . urlencode($_GET['error']) . '">';
    }
    ?>
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>

        <?php
        if (isset($_GET['id'])) {
            $employee_id = $_GET['id'];
            $sql = "SELECT * FROM employees WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $employee_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $employee = $result->fetch_assoc();
            } else {
                echo "<p>Employee not found.</p>";
                exit;
            }
        } else {
            echo "<p>No employee ID provided.</p>";
            exit;
        }
        ?>

        <h2>Edit Employee</h2>

        <?php if (isset($_GET['message'])): ?>
            <div class="message success">
                <?php echo htmlspecialchars($_GET['message']); ?>
            </div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="message error">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="includes/process-edit-employee.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($employee['first_name']); ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($employee['last_name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required>

            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($employee['phone']); ?>" required>

            <label for="department">Department:</label>
            <select id="department" name="department" required>
                <?php
                $departments = $conn->query("SELECT * FROM departments");
                while ($dept = $departments->fetch_assoc()) {
                    $selected = $employee['department_id'] == $dept['id'] ? 'selected' : '';
                    echo "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
                }
                ?>
            </select>

            <label for="designation">Designation:</label>
            <select id="designation" name="designation" required>
                <?php
                $designations = $conn->query("SELECT * FROM designations");
                while ($desig = $designations->fetch_assoc()) {
                    $selected = $employee['designation_id'] == $desig['id'] ? 'selected' : '';
                    echo "<option value='{$desig['id']}' $selected>{$desig['name']}</option>";
                }
                ?>
            </select>

            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($employee['date_of_birth']); ?>" required>

            <label for="date_of_joining">Date of Joining:</label>
            <input type="date" id="date_of_joining" name="date_of_joining" value="<?php echo htmlspecialchars($employee['date_of_joining']); ?>" required>

            <button type="submit">Update Employee</button>
        </form>
    </div>
</body>
</html>
