<?php
require_once "../includes/admin-auth.php";
?>
<?php
session_start();
require_once '../config/connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin-pages/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $error = "Please fill in all fields";
    } elseif ($new_password !== $confirm_password) {
        $error = "New password and confirmation do not match";
    } elseif (strlen($new_password) < 6) {
        $error = "New password must be at least 6 characters";
    } else {

        $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if (!$user || $current_password !== $user['password']) {
            $error = "Current password is incorrect";
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE user_id = ?");
            mysqli_stmt_bind_param($stmt, "si", $new_password, $user_id);

            if (mysqli_stmt_execute($stmt)) {
                $success = "Password updated successfully";
            } else {
                $error = "Something went wrong while updating the password";
            }
        }
    }
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
        <a href="security.php" class="settings-tab active">Security</a>
        <a href="notification-settings.php" class="settings-tab">Notifications</a>
        <a href="appearance.php" class="settings-tab">Appearance</a>
    </div>

    <div class="settings-card">

        <div class="left-side">
            <div class="settings-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h3>Security</h3>
            <p>Update your password and secure your account.</p>
        </div>

        <div class="right-side">

            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST">

                <label>Current Password</label>
                <input type="password" name="current_password" placeholder="********">

                <label>New Password</label>
                <input type="password" name="new_password" placeholder="********">

                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="********">

                <button type="submit" class="save-btn">
                    Update Password
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>