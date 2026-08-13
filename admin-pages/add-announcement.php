<?php require '../config/connection.php'; ?>
<?php
require_once "../includes/admin-auth.php";
?>
<?php
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title']);
    $content = trim($_POST['description']);
    $category = $_POST['category'];
    $announcement_date = $_POST['date'];
    $status = $_POST['status'];

    switch ($category) {
        case 'maintenance':
            $icon_class = 'bi-droplet-fill';
            $icon_color = 'green';
            break;
        case 'events':
            $icon_class = 'bi-calendar-event-fill';
            $icon_color = 'orange';
            break;
        case 'general':
        default:
            $icon_class = 'bi-megaphone-fill';
            $icon_color = 'purple';
            break;
    }

    if (empty($title) || empty($content) || empty($announcement_date)) {
        $error = "من فضلك املأ كل الحقول";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO announcements (title, content, category, icon_class, icon_color, announcement_date, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssssss", $title, $content, $category, $icon_class, $icon_color, $announcement_date, $status);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: announcements.php");
            exit;
        } else {
            $error = "حصل خطأ أثناء الحفظ";
        }
    }
}
?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/add-announcement.css">

<div class="main-content">

    <div class="container-fluid py-4">

        <div class="page-header">
            <div>
                <h2 class="page-title">New Announcement</h2>
                <p class="page-subtitle">
                    Create a new announcement for residents
                </p>
            </div>

            <a href="announcements.php" class="back-btn">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="announcement-form-card">

            <form action="" method="POST">

                <div class="form-group">
                    <label for="title">Announcement Title</label>
                    <input type="text" id="title" name="title" placeholder="Enter announcement title" required>
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="">Select Category</option>
                            <option value="general">General</option>
                            <option value="maintenance">Maintenance</option>
                            <option value="events">Events</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Announcement Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>

                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="6" placeholder="Write your announcement here..." required></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <div class="form-actions">
                    <a href="announcements.php" class="cancel-btn">Cancel</a>
                    <button type="submit" class="save-btn">
                        <i class="bi bi-check-lg"></i>
                        Publish Announcement
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>