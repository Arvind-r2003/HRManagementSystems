<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Notification - HRMS</title>
    <link rel="stylesheet" href="css/notifications.css">
</head>
<body>
    <?php include('includes/sidebar.php'); ?>
    <div class="container">
        <?php include('includes/header.php'); ?>
        <div class="card">
            <h2>Add New Notification</h2>
            <?php
            // Handle notification addition
            if (isset($_POST['add_notification'])) {
                $message = $_POST['message'];
                if (!empty($message)) {
                    $sql = "INSERT INTO notifications (message) VALUES (?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $message);
                    if ($stmt->execute()) {
                        echo "<div class='message success'>Notification added successfully!</div>";
                    } else {
                        echo "<div class='message error'>Error adding notification: " . $stmt->error . "</div>";
                    }
                } else {
                    echo "<div class='message error'>Notification message cannot be empty.</div>";
                }
            }
            ?>
            <form action="add-notification.php" method="POST">
                <label for="message">Notification Message:</label>
                <textarea id="message" name="message" rows="4" required></textarea>
                <button type="submit" name="add_notification">Add Notification</button>
            </form>
        </div>
    </div>
</body>
</html>
