<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Notifications - HRMS</title>
    <link rel="stylesheet" href="css/notifications.css">
</head>
<body class="notifications-page">
    <?php include('includes/sidebar.php'); ?>
    <div class="container">
        <?php include('includes/header.php'); ?>
        <div class="card">
            <h2>All Notifications</h2>
            <?php
            // Fetch all notifications from the database
            $sql = "SELECT * FROM notifications ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Message</th>
                                <th>Created At</th>
                                <th>Read Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($row = $result->fetch_assoc()) {
                    $readStatus = $row['is_read'] ? 'Read' : 'Unread';
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['created_at']}</td>
                            <td>{$readStatus}</td>
                            <td>
                                " . (!$row['is_read'] ? "<a href='mark-as-read.php?id={$row['id']}' onclick='return confirm(\"Mark this notification as read?\")'>Mark as Read</a>" : "Already Read") . "
                            </td>
                          </tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<div class='message'>No notifications found.</div>";
            }
            ?>
        </div>
    </div>
</body>
</html>
