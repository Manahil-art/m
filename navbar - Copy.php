<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar">
    <div class="logo">
        <a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">
            ServiceBooking
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">Home</a></li>

        <li><a href="services.php" class="<?= ($currentPage == 'services.php') ? 'active' : '' ?>">Services</a></li>

        <li><a href="booking_status.php" class="<?= ($currentPage == 'booking_status.php') ? 'active' : '' ?>">Booking Status</a></li>

        <li><a href="aboutus.php" class="<?= ($currentPage == 'aboutus.php') ? 'active' : '' ?>">About Us</a></li>


        <li><a href="feedback.php" class="<?= ($currentPage == 'feedback.php') ? 'active' : '' ?>">Feedback</a></li>

        <li><a href="admin_login.php" class="<?= ($currentPage == 'admin_login.php') ? 'active admin-btn' : 'admin-btn' ?>">Login</a></li>
    </ul>
</nav>
