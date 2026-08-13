<?php
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin-pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $language = $_POST['language'];
    $theme = $_POST['theme'];
    $font_size = $_POST['font_size'];

    $stmt = mysqli_prepare($conn, "SELECT id FROM appearance_settings WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $existing = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($existing) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE appearance_settings SET language=?, theme=?, font_size=? WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "sssi", $language, $theme, $font_size, $user_id);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO appearance_settings (user_id, language, theme, font_size) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isss", $user_id, $language, $theme, $font_size);
    }

    if (mysqli_stmt_execute($stmt)) {
        $success = "Appearance settings updated successfully";
    }
}

$stmt = mysqli_prepare($conn, "SELECT * FROM appearance_settings WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$settings = mysqli_fetch_assoc($result);

if (!$settings) {
    $settings = [
        'language' => 'English',
        'theme' => 'Light',
        'font_size' => 'Medium'
    ];
}

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';
?>

<link rel="stylesheet" href="../assets/css/settings.css">

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <div class="settings-tabs">
        <a href="settings.php" class="settings-tab">General</a>
        <a href="security.php" class="settings-tab">Security</a>
        <a href="notification-settings.php" class="settings-tab">Notifications</a>
        <a href="appearance.php" class="settings-tab active">Appearance</a>
    </div>

    <div class="settings-card">

        <div class="left-side">
            <div class="settings-icon">
                <i class="fa-solid fa-palette"></i>
            </div>
            <h3>Appearance</h3>
            <p>Customize the system appearance.</p>
        </div>

        <div class="right-side">

            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST">

                <label>Language</label>
                <select name="language">
                    <option value="English" <?= $settings['language'] === 'English' ? 'selected' : '' ?>>English</option>
                    <option value="Arabic" <?= $settings['language'] === 'Arabic' ? 'selected' : '' ?>>Arabic</option>
                </select>

                <label>Theme</label>
                <select name="theme">
                    <option value="Light" <?= $settings['theme'] === 'Light' ? 'selected' : '' ?>>Light</option>
                    <option value="Dark" <?= $settings['theme'] === 'Dark' ? 'selected' : '' ?>>Dark</option>
                </select>

                <label>Font Size</label>
                <select name="font_size">
                    <option value="Small" <?= $settings['font_size'] === 'Small' ? 'selected' : '' ?>>Small</option>
                    <option value="Medium" <?= $settings['font_size'] === 'Medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="Large" <?= $settings['font_size'] === 'Large' ? 'selected' : '' ?>>Large</option>
                </select>

                <button type="submit" class="save-btn">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>