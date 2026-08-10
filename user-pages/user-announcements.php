<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/user-announcements.css">

<div class="main-content">

    <div class="container-fluid py-4">

        <div class="announcement-top">

            <div>
                <h2 class="page-title">Announcements</h2>

                <p class="page-subtitle">
                    Stay updated with the latest community news
                </p>
            </div>

            <div class="notification-icon">
                <i class="bi bi-bell"></i>
            </div>

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


            <a href="announcement-details.php?id=1"
               class="announcement-item"
               data-category="maintenance">

                <div class="announcement-icon green">
                    <i class="bi bi-droplet-fill"></i>
                </div>

                <div class="announcement-content">

                    <div class="announcement-title-row">

                        <h4>Water Maintenance</h4>

                        <span class="category-badge maintenance">
                            Maintenance
                        </span>

                    </div>

                    <p>
                        Water maintenance will take place tomorrow
                        from 10:00 AM to 2:00 PM.
                    </p>

                    <span class="read-more">
                        Read More
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

                <div class="announcement-date">
                    May 30, 2026
                </div>

            </a>


            <a href="announcement-details.php?id=2"
               class="announcement-item"
               data-category="general">

                <div class="announcement-icon purple">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="announcement-content">

                    <div class="announcement-title-row">

                        <h4>Community Meeting</h4>

                        <span class="category-badge general">
                            General
                        </span>

                    </div>

                    <p>
                        Community meeting will be held on
                        May 25 at 4:00 PM in the main hall.
                    </p>

                    <span class="read-more">
                        Read More
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

                <div class="announcement-date">
                    May 25, 2026
                </div>

            </a>


            <a href="announcement-details.php?id=3"
               class="announcement-item"
               data-category="events">

                <div class="announcement-icon blue">
                    <i class="bi bi-building"></i>
                </div>

                <div class="announcement-content">

                    <div class="announcement-title-row">

                        <h4>New Facility Opening</h4>

                        <span class="category-badge events">
                            Events
                        </span>

                    </div>

                    <p>
                        We are excited to announce the opening
                        of our new facility.
                    </p>

                    <span class="read-more">
                        Read More
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

                <div class="announcement-date">
                    May 18, 2026
                </div>

            </a>


            <a href="announcement-details.php?id=4"
               class="announcement-item"
               data-category="events">

                <div class="announcement-icon orange">
                    <i class="bi bi-calendar-event-fill"></i>
                </div>

                <div class="announcement-content">

                    <div class="announcement-title-row">

                        <h4>Emergency Drill</h4>

                        <span class="category-badge events">
                            Events
                        </span>

                    </div>

                    <p>
                        Fire drill will be conducted on
                        May 17 at 4:00 PM.
                    </p>

                    <span class="read-more">
                        Read More
                        <i class="bi bi-arrow-right"></i>
                    </span>

                </div>

                <div class="announcement-date">
                    May 17, 2026
                </div>

            </a>


        </div>

    </div>

</div>

<script src="../assets/js/user-announcements.js"></script>

<?php include '../includes/footer.php'; ?>