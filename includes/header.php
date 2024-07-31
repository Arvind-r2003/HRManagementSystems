<?php
session_start();
?>
<header style="background: #2c3e50; color: #ecf0f1; padding: 20px; border-bottom: 1px solid #bdc3c7; border-radius: 8px;">
    <h1 style="margin: 0; font-size: 24px;">Dashboard</h1>
    <?php if (isset($_SESSION['first_name']) && isset($_SESSION['last_name'])): ?>
        <p style="margin: 5px 0 0; font-size: 18px; color: #ecf0f1;">Welcome, <?php echo htmlspecialchars($_SESSION['first_name']) . ' ' . htmlspecialchars($_SESSION['last_name']); ?>!</p>
    <?php endif; ?>
    <div id="clock" style="float: right; font-size: 18px; color: #ecf0f1;"></div>
</header>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        const strMinutes = minutes < 10 ? '0' + minutes : minutes;
        const strSeconds = seconds < 10 ? '0' + seconds : seconds;

        document.getElementById('clock').textContent = hours + ':' + strMinutes + ':' + strSeconds + ' ' + ampm;
    }

    setInterval(updateClock, 1000);
    updateClock(); // initial call
</script>
