<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <!-- Tabs -->
    <div class="tabs">
        <button onclick="location.href='settings.php'">General</button>
        <button onclick="location.href='security.php'">Security</button>
        <button class="active">Notifications</button>
        <button onclick="location.href='appearance.php'">Appearance</button>
    </div>

    <div class="settings-card">

        <!-- Left -->
        <div class="left-side">

            <div class="settings-icon">
                <i class="fa-solid fa-bell"></i>
            </div>

            <h3>Notifications</h3>

            <p>Manage how you receive notifications.</p>

        </div>

        <!-- Right -->
        <div class="right-side">

            <form>

                <label>
                    <input type="checkbox" checked>
                    Email Notifications
                </label>

                <br><br>

                <label>
                    <input type="checkbox" checked>
                    SMS Notifications
                </label>

                <br><br>

                <label>
                    <input type="checkbox">
                    Maintenance Alerts
                </label>

                <br><br>

                <label>
                    <input type="checkbox" checked>
                    Billing Reminders
                </label>

                <br><br>

                <label>
                    <input type="checkbox">
                    Parking Notifications
                </label>

                <br><br>

                <button class="save-btn">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>