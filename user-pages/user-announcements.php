<?php $current_page = basename($_SERVER['PHP_SELF']);
require_once "../includes/user-auth.php";?>
<?php require '../config/connection.php'; ?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/user-announcements.css">

<?php
$result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY announcement_date DESC");
?>

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
            <button class="announcement-tab active" data-category="all">All</button>
            <button class="announcement-tab" data-category="general">General</button>
            <button class="announcement-tab" data-category="maintenance">Maintenance</button>
            <button class="announcement-tab" data-category="events">Events</button>
        </div>

        <div class="announcement-list">

            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($item = mysqli_fetch_assoc($result)): ?>

                    <a href="announcement-details.php?id=<?= $item['id'] ?>"
                       class="announcement-item"
                       data-category="<?= htmlspecialchars($item['category']) ?>">

                        <div class="announcement-icon <?= htmlspecialchars($item['icon_color']) ?>">
                            <i class="bi <?= htmlspecialchars($item['icon_class']) ?>"></i>
                        </div>

                        <div class="announcement-content">

                            <div class="announcement-title-row">
                                <h4><?= htmlspecialchars($item['title']) ?></h4>

                                <span class="category-badge <?= htmlspecialchars($item['category']) ?>">
                                    <?= htmlspecialchars(ucfirst($item['category'])) ?>
                                </span>
                            </div>

                            <p>
                                <?= htmlspecialchars($item['content']) ?>
                            </p>

                            <span class="read-more">
                                Read More
                                <i class="bi bi-arrow-right"></i>
                            </span>

                        </div>

                        <div class="announcement-date">
                            <?= date('M j, Y', strtotime($item['announcement_date'])) ?>
                        </div>

                    </a>

                <?php endwhile; ?>
            <?php else: ?>
                <p>No announcements available.</p>
            <?php endif; ?>

        </div>

    </div>

</div>

<script src="../assets/js/user-announcements.js"></script>

<?php include '../includes/footer.php'; ?>