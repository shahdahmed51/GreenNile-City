<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

    <div class="container-fluid py-4">

        <div class="announcement-top">

            <div>
                <h2 class="page-title">Announcements</h2>
                <p class="page-subtitle">
                    Manage announcements for residents
                </p>
            </div>

            <a href="add-announcement.php" class="new-announcement-btn">
                <i class="bi bi-plus-lg"></i>
                New Announcement
            </a>

        </div>

        <div class="announcement-tabs">

            <button class="announcement-tab active" data-category="all">
                All
            </button>

            <button class="announcement-tab" data-category="general">
                General
            </button>

            <button class="announcement-tab" data-category="maintenance">
                Maintenance
            </button>

            <button class="announcement-tab" data-category="events">
                Events
            </button>

        </div>

        <div class="announcement-list">

            <div class="announcement-item" data-category="maintenance">

                <div class="announcement-icon green">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <div class="announcement-content">

                    <h4>Water Maintenance</h4>

                    <p>
                        Water maintenance will take place tomorrow
                        from 10:00 AM to 2:00 PM.
                    </p>

                </div>

                <div class="announcement-date">
                    30 May 2026
                </div>

            </div>


            <div class="announcement-item" data-category="general">

                <div class="announcement-icon purple">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <div class="announcement-content">

                    <h4>Community Meeting</h4>

                    <p>
                        Community meeting will be held on
                        25 May 2026 at 4:00 PM in the main hall.
                    </p>

                </div>

                <div class="announcement-date">
                    25 May 2026
                </div>

            </div>


            <div class="announcement-item" data-category="events">

                <div class="announcement-icon blue">
                    <i class="bi bi-building"></i>
                </div>

                <div class="announcement-content">

                    <h4>New Facility Opening</h4>

                    <p>
                        We are excited to announce the opening
                        of our new facility.
                    </p>

                </div>

                <div class="announcement-date">
                    18 May 2026
                </div>

            </div>


            <div class="announcement-item" data-category="events">

                <div class="announcement-icon orange">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>

                <div class="announcement-content">

                    <h4>Emergency Drill</h4>

                    <p>
                        Fire drill will be conducted on
                        17 May at 4:00 PM.
                    </p>

                </div>

                <div class="announcement-date">
                    17 May 2026
                </div>

            </div>

        </div>

        <div class="view-all">
            View All Announcements
        </div>

    </div>

</div>

<script src="../assets/js/announcement.js"></script>

<?php include '../includes/footer.php'; ?>