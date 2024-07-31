<?php
// Start the session
session_start();

// Clear session data
$_SESSION = array();

// If a session cookie exists, delete it
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Destroy the session
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ecf0f1;
            color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-container {
            text-align: center;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin: 0 0 20px;
        }
        a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .timer {
            font-size: 16px;
            color: #7f8c8d;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h2>You have been logged out.</h2>
        <p><a href="login.php" id="manualRedirect">Click here to log in again</a></p>
        <p class="timer" id="countdown">You will be redirected to the login page in <span id="seconds">10</span> seconds...</p>
    </div>

    <script>
        // Countdown function
        function startCountdown(duration) {
            let timer = duration, secondsDisplay = document.getElementById('seconds');
            const interval = setInterval(function() {
                secondsDisplay.textContent = timer;
                if (timer <= 0) {
                    clearInterval(interval);
                    window.location.href = 'login.php'; // Redirect when countdown finishes
                }
                timer--;
            }, 1000);
        }

        // Start the countdown with 10 seconds
        startCountdown(10);
    </script>
</body>
</html>
