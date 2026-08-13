<?php
require_once "../includes/admin-auth.php";
?>
<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<?php require '../config/connection.php'; ?>

<?php
$sql = "SELECT * FROM announcements ORDER BY announcement_date DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="main-content">

    <div class="container-fluid py-4">

        <div class="announcement-top">
            <div>
                <h2 class="page-title">Announcements</h2>
                <p class="page-subtitle">Manage announcements for residents</p>
            </div>

            <a href="add-announcement.php" class="new-announcement-btn">
                <i class="bi bi-plus-lg"></i>
                New Announcement
            </a>
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

                    <div class="announcement-item" data-category="<?= htmlspecialchars($item['category']) ?>">

                        <div class="announcement-icon <?= htmlspecialchars($item['icon_color']) ?>">
                            <i class="bi <?= htmlspecialchars($item['icon_class']) ?>"></i>
                        </div>

                        <div class="announcement-content">
                            <h4><?= htmlspecialchars($item['title']) ?></h4>
                            <p><?= nl2br(htmlspecialchars($item['content'])) ?></p>
                        </div>

                        <div class="announcement-date">
                            <?= date('d M Y', strtotime($item['announcement_date'])) ?>
                        </div>

                        <div class="announcement-actions">
                            <a href="edit-announcement.php?id=<?= $item['id'] ?>" class="edit-btn">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="delete-announcement.php?id=<?= $item['id'] ?>"
                               onclick="return confirm('Are you sure you want to delete this announcement?');"
                               class="delete-btn">
                                <i class="bi bi-trash"></i>
                            </a>
                        </div>

                    </div>

                <?php endwhile; ?>
            <?php else: ?>
                <p>No announcements available.</p>
            <?php endif; ?>

        </div>

        <div class="view-all">
            View All Announcements
        </div>

    </div>

</div>

<script src="../assets/js/announcement.js"></script>

<?php include '../includes/footer.php'; ?>