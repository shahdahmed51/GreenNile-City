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
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email_notifications = isset($_POST['email_notifications']) ? 1 : 0;
    $sms_notifications = isset($_POST['sms_notifications']) ? 1 : 0;
    $maintenance_alerts = isset($_POST['maintenance_alerts']) ? 1 : 0;
    $billing_reminders = isset($_POST['billing_reminders']) ? 1 : 0;
    $parking_notifications = isset($_POST['parking_notifications']) ? 1 : 0;

    $stmt = mysqli_prepare($conn, "SELECT id FROM notification_settings WHERE user_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $existing = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($existing) > 0) {
        $stmt = mysqli_prepare($conn, "UPDATE notification_settings SET email_notifications=?, sms_notifications=?, maintenance_alerts=?, billing_reminders=?, parking_notifications=? WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "iiiiii", $email_notifications, $sms_notifications, $maintenance_alerts, $billing_reminders, $parking_notifications, $user_id);
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO notification_settings (user_id, email_notifications, sms_notifications, maintenance_alerts, billing_reminders, parking_notifications) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iiiiii", $user_id, $email_notifications, $sms_notifications, $maintenance_alerts, $billing_reminders, $parking_notifications);
    }

    if (mysqli_stmt_execute($stmt)) {
        $success = "Notification settings updated successfully";
    }
}

$stmt = mysqli_prepare($conn, "SELECT * FROM notification_settings WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$settings = mysqli_fetch_assoc($result);

// لو أول مرة يفتح الصفحة ومفيش صف له، استخدمي القيم الافتراضية
if (!$settings) {
    $settings = [
        'email_notifications' => 1,
        'sms_notifications' => 1,
        'maintenance_alerts' => 0,
        'billing_reminders' => 1,
        'parking_notifications' => 0
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
        <a href="notification-settings.php" class="settings-tab active">Notifications</a>
        <a href="appearance.php" class="settings-tab">Appearance</a>
    </div>

    <div class="settings-card">

        <div class="left-side">
            <div class="settings-icon">
                <i class="fa-solid fa-bell"></i>
            </div>
            <h3>Notifications</h3>
            <p>Manage how you receive notifications.</p>
        </div>

        <div class="right-side">

            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="POST">

                <label>
                    <input type="checkbox" name="email_notifications" <?= $settings['email_notifications'] ? 'checked' : '' ?>>
                    Email Notifications
                </label>

                <br><br>

                <label>
                    <input type="checkbox" name="sms_notifications" <?= $settings['sms_notifications'] ? 'checked' : '' ?>>
                    SMS Notifications
                </label>

                <br><br>

                <label>
                    <input type="checkbox" name="maintenance_alerts" <?= $settings['maintenance_alerts'] ? 'checked' : '' ?>>
                    Maintenance Alerts
                </label>

                <br><br>

                <label>
                    <input type="checkbox" name="billing_reminders" <?= $settings['billing_reminders'] ? 'checked' : '' ?>>
                    Billing Reminders
                </label>

                <br><br>

                <label>
                    <input type="checkbox" name="parking_notifications" <?= $settings['parking_notifications'] ? 'checked' : '' ?>>
                    Parking Notifications
                </label>

                <br><br>

                <button type="submit" class="save-btn">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>