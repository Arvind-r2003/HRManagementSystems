<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRMS Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/notifications.css"> <!-- Include notifications CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Add your custom styles here if needed */
        .card {
            cursor: pointer; /* Change cursor to pointer to indicate clickability */
        }
    </style>
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="main-content">
        <?php include('includes/header.php'); ?>
        <?php
        // Fetch employee count from the database
        $result = $conn->query("SELECT COUNT(*) as count FROM employees");
        $row = $result->fetch_assoc();
        $employeeCount = $row['count'];

        // Fetch departments count from the database
        $result = $conn->query("SELECT COUNT(*) as count FROM departments");
        $row = $result->fetch_assoc();
        $departmentCount = $row['count'];

        // Fetch designations count from the database
        $result = $conn->query("SELECT COUNT(*) as count FROM designations");
        $row = $result->fetch_assoc();
        $designationCount = $row['count'];

        // Fetch unread notifications count
        $result = $conn->query("SELECT COUNT(*) as count FROM notifications WHERE is_read = 0");
        $row = $result->fetch_assoc();
        $unreadCount = $row['count'];
        ?>

        <div class="cards">
            <div class="card blue" onclick="redirectToEmployees()">
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-content">
                    <h3><?php echo $employeeCount; ?></h3>
                    <p>Employees</p>
                </div>
            </div>
            <div class="card green">
                <div class="card-icon">
                    <i class="fas fa-plane"></i>
                </div>
                <div class="card-content">
                    <h3>0</h3>
                    <p>On Leave</p>
                </div>
            </div>
            <div class="card purple" onclick="redirectToDepartments()">
                <div class="card-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="card-content">
                    <h3><?php echo $departmentCount; ?></h3>
                    <p>Departments</p>
                </div>
            </div>
            <div class="card red" onclick="redirectToDesignations()">
                <div class="card-icon">
                    <i class="fas fa-user-tag"></i>
                </div>
                <div class="card-content">
                    <h3><?php echo $designationCount; ?></h3>
                    <p>Designations</p>
                </div>
            </div>
        </div>

        <div class="info-sections">
            <div class="info-section">
                <h4>Events</h4>
                <p>No Any New Events!</p>
            </div>
            <div class="info-section">
                <h4>Employee On Leave</h4>
                <p>No Any Employee On Leave!</p>
            </div>
            <div class="info-section">
                <h4>Upcoming Festivals</h4>
                <p>No Any New Festival!</p>
            </div>
            <div class="info-section">
                <h4>Notifications</h4>
                <div class="birthday-buddy">
                    <div>
                        <p><a href="notifications.php">You have <?php echo $unreadCount; ?> unread notification<?php echo $unreadCount > 1 ? 's' : ''; ?></a></p>
                    </div>
                </div>
            </div>
            <div class="info-section">
                <h4>Newly Recruited</h4>
                <p>No Any New Recruitment!</p>
            </div>
        </div>
    </div>

    <script>
        function redirectToEmployees() {
            window.location.href = 'employees.php';
        }

        function redirectToDepartments() {
            window.location.href = 'departments.php';
        }

        function redirectToDesignations() {
            window.location.href = 'designations.php';
        }
    </script>
</body>
</html>
