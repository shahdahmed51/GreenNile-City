<?php $current_page = basename($_SERVER['PHP_SELF']);?>

<?php include("../includes/header.php"); ?>

<?php include("../includes/sidebar.php"); ?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/notifications.css">

<body>

<div class="main-content">
    <div class="page-header">
    <h2>Notifications</h2>

    <div class="notification-tabs">
        <button class="active">All</button>
        <button>Unread</button>
        <button>Read</button>
    </div>

    <a href="#" class="mark-read">Mark all as read</a>
</div>
<div class="notifications-list">

    <div class="notification-card unread">

        <div class="icon">
            <i class="bi bi-tools ></i>
        </div>

        <div class="notification-content">
            <h4>New Maintenance Request</h4>
            <p>Apartment 205 has submitted a maintenance request.</p>
        </div>

        <span class="time">2 min ago</span>

    </div>

</div>
<div class="notification-card unread">

    <div class="icon">
        <i class="bi bi-p-circle-fill"></i>
    </div>

    <div class="notification-content">
        <h4>Parking Reservation Confirmed</h4>
        <p>Your parking slot has been successfully reserved.</p>
    </div>

    <span class="time">10 min ago</span>

</div>

<div class="notification-card">

    <div class="icon">
        <i class="bi bi-credit-card-fill"></i>
    </div>

    <div class="notification-content">
        <h4>New Bill Generated</h4>
        <p>Your monthly maintenance bill is now available.</p>
    </div>

    <span class="time">1 hour ago</span>

</div>

<div class="notification-card">

    <div class="icon">
        <i class="bi bi-people-fill"></i>
    </div>

    <div class="notification-content">
        <h4>New Resident Added</h4>
        <p>A new resident has been added to the system.</p>
    </div>

    <span class="time">Yesterday</span>

</div>

<div class="notification-card">

    <div class="icon">
        <i class="bi bi-megaphone-fill"></i>
    </div>

    <div class="notification-content">
        <h4>Community Announcement</h4>
        <p>Monthly community meeting will be held on Friday.</p>
    </div>

    <span class="time">2 days ago</span>

</div>
</div>

<script src="/GREENNILE-CITY/assets/js/notifications.js"></script>

</body>