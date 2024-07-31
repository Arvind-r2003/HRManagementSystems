<?php
include('db.php');

if (isset($_GET['id'])) {
    $notification_id = $_GET['id'];

    // Update the notification status
    $sql = "UPDATE notifications SET is_read = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $notification_id);

    if ($stmt->execute()) {
        header("Location: notifications.php"); // Redirect to notifications page after updating
    } else {
        echo "Error marking notification as read: " . $stmt->error;
    }
} else {
    echo "Notification ID not specified.";
}
?>
