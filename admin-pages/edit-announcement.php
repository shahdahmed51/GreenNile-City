<?php
require_once "../includes/admin-auth.php";
?>
<?php require '../config/connection.php'; ?>

<?php
$id = $_GET['id'] ?? 0;
$id = (int) $id;
$error = "";

$stmt = mysqli_prepare($conn, "SELECT * FROM announcements WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$announcement = mysqli_fetch_assoc($result);

if (!$announcement) {
    header("Location: announcements.php");
    exit;
}

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
        $error = "Please fill in all fields";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE announcements SET title=?, content=?, category=?, icon_class=?, icon_color=?, announcement_date=?, status=? WHERE id=?");
        mysqli_stmt_bind_param($stmt, "sssssssi", $title, $content, $category, $icon_class, $icon_color, $announcement_date, $status, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: announcements.php");
            exit;
        } else {
            $error = "Something went wrong while saving";
        }
    }
}

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';
?>

<link rel="stylesheet" href="../assets/css/add-announcement.css">

<div class="main-content">
    <div class="container-fluid py-4">

        <div class="page-header">
            <div>
                <h2 class="page-title">Edit Announcement</h2>
                <p class="page-subtitle">Update announcement details</p>
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
                    <input type="text" id="title" name="title"
                           value="<?= htmlspecialchars($announcement['title']) ?>" required>
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="general" <?= $announcement['category'] === 'general' ? 'selected' : '' ?>>General</option>
                            <option value="maintenance" <?= $announcement['category'] === 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                            <option value="events" <?= $announcement['category'] === 'events' ? 'selected' : '' ?>>Events</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date">Announcement Date</label>
                        <input type="date" id="date" name="date"
                               value="<?= htmlspecialchars($announcement['announcement_date']) ?>" required>
                    </div>

                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="6" required><?= htmlspecialchars($announcement['content']) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="active" <?= $announcement['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $announcement['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="form-actions">
                    <a href="announcements.php" class="cancel-btn">Cancel</a>
                    <button type="submit" class="save-btn">
                        <i class="bi bi-check-lg"></i>
                        Save Changes
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>