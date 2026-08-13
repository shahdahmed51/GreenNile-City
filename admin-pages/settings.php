<?php
require_once "../includes/admin-auth.php";
?>
<?php
// session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin-pages/login.php");
    exit();
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $site_name = trim($_POST['site_name']);
    $admin_email = trim($_POST['admin_email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $language = $_POST['language'];
    $currency = $_POST['currency'];

    if (empty($site_name) || empty($admin_email)) {
        $error = "Please fill in all required fields";
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE settings SET site_name=?, admin_email=?, phone=?, address=?, language=?, currency=? WHERE id=1");
        mysqli_stmt_bind_param($stmt, "ssssss", $site_name, $admin_email, $phone, $address, $language, $currency);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Settings updated successfully";
        } else {
            $error = "Something went wrong while saving";
        }
    }
}

$result = mysqli_query($conn, "SELECT * FROM settings WHERE id = 1");
$settings = mysqli_fetch_assoc($result);

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';
?>

<link rel="stylesheet" href="../assets/css/settings.css">

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <div class="settings-tabs">
        <a href="settings.php" class="settings-tab active">General</a>
        <a href="security.php" class="settings-tab">Security</a>
        <a href="notification-settings.php" class="settings-tab">Notifications</a>
        <a href="appearance.php" class="settings-tab">Appearance</a>
    </div>

    <div class="settings-card">

        <div class="left-side">
            <div class="settings-icon">
                <i class="fa-solid fa-gear"></i>
            </div>
            <h3>General Settings</h3>
            <p>Manage your system account settings.</p>
        </div>

        <div class="right-side">

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST">

                <label>Site Name</label>
                <input type="text" name="site_name" value="<?= htmlspecialchars($settings['site_name']) ?>">

                <label>Admin Email</label>
                <input type="email" name="admin_email" value="<?= htmlspecialchars($settings['admin_email']) ?>">

                <label>Phone Number</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($settings['phone']) ?>">

                <label>Address</label>
                <input type="text" name="address" value="<?= htmlspecialchars($settings['address']) ?>">

                <div class="double-input">

                    <div>
                        <label>Language</label>
                        <select name="language">
                            <option value="English" <?= $settings['language'] === 'English' ? 'selected' : '' ?>>English</option>
                            <option value="Arabic" <?= $settings['language'] === 'Arabic' ? 'selected' : '' ?>>Arabic</option>
                        </select>
                    </div>

                    <div>
                        <label>Currency</label>
                        <select name="currency">
                            <option value="USD" <?= $settings['currency'] === 'USD' ? 'selected' : '' ?>>USD</option>
                            <option value="EGP" <?= $settings['currency'] === 'EGP' ? 'selected' : '' ?>>EGP</option>
                        </select>
                    </div>

                </div>

                <button type="submit" class="save-btn">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>