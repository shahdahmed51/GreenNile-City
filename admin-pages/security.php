<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<link rel="stylesheet" href="../assets/css/settings.css">
<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <!-- Tabs -->
    <div class="settings-tabs">

    <a href="settings.php" class="settings-tab">
        General
    </a>

    <a href="security.php" class="settings-tab active">
        Security
    </a>

    <a href="notification-settings.php" class="settings-tab">
        Notifications
    </a>

    <a href="appearance.php" class="settings-tab">
        Appearance
    </a>

</div>

    <div class="settings-card">

        <!-- Left -->
        <div class="left-side">

            <div class="settings-icon">
                <i class="fa-solid fa-lock"></i>
            </div>

            <h3>Security</h3>

            <p>Update your password and secure your account.</p>

        </div>

        <!-- Right -->
        <div class="right-side">

            <form>

                <label>Current Password</label>
                <input type="password" placeholder="********">

                <label>New Password</label>
                <input type="password" placeholder="********">

                <label>Confirm Password</label>
                <input type="password" placeholder="********">

                <button type="submit" class="save-btn">
                    Update Password
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>