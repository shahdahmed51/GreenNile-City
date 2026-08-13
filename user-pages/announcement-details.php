<?php
 require_once "../includes/user-auth.php";
 require '../config/connection.php'; 
?>

<?php
$id = $_GET['id'] ?? 1;
$id = (int) $id;

$stmt = mysqli_prepare($conn, "SELECT * FROM announcements WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$announcement = mysqli_fetch_assoc($result);


if (!$announcement) {
    $result = mysqli_query($conn, "SELECT * FROM announcements ORDER BY id ASC LIMIT 1");
    $announcement = mysqli_fetch_assoc($result);
}

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/user-sidebar.php';
?>

<link rel="stylesheet" href="../assets/css/announcement-details.css">

<div class="main-content">

    <div class="container-fluid py-4">

        <a href="user-announcements.php" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Announcements
        </a>

        <?php if ($announcement): ?>

        <div class="details-card">

            <div class="details-icon <?= htmlspecialchars($announcement['icon_color']) ?>">
                <i class="bi <?= htmlspecialchars($announcement['icon_class']) ?>"></i>
            </div>

            <span class="details-category <?= htmlspecialchars($announcement['icon_color']) ?>">
                <?= htmlspecialchars(ucfirst($announcement['category'])) ?>
            </span>

            <h2>
                <?= htmlspecialchars($announcement['title']) ?>
            </h2>

            <div class="details-date">
                <i class="bi bi-calendar3"></i>
                <?= date('F j, Y', strtotime($announcement['announcement_date'])) ?>
            </div>

            <hr>

            <p class="details-text">
                <?= nl2br(htmlspecialchars($announcement['content'])) ?>
            </p>

            <?php if (!empty($announcement['details'])): ?>
                <p class="details-text">
                    <?= nl2br(htmlspecialchars($announcement['details'])) ?>
                </p>
            <?php endif; ?>

        </div>

        <?php else: ?>
            <p>No ANnouncements now</p>
        <?php endif; ?>

    </div>

</div>

<?php include '../includes/footer.php'; ?>