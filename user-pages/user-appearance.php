<?php 
require_once "../includes/user-auth.php";
include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/settings.css">
<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <div class="settings-tabs">

    <a href="settings.php" class="settings-tab">
        General
    </a>

    <a href="user-security.php" class="settings-tab">
        Security
    </a>

    <a href="user-notification-settings.php" class="settings-tab">
        Notifications
    </a>

    <a href="user-appearance.php" class="settings-tab active">
        Appearance
    </a>

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

            <form>

                <label>Language</label>

                <select>
                    <option>English</option>
                    <option>Arabic</option>
                </select>

                <label>Theme</label>

                <select>
                    <option>Light</option>
                    <option>Dark</option>
                </select>

                <label>Font Size</label>

                <select>
                    <option>Small</option>
                    <option selected>Medium</option>
                    <option>Large</option>
                </select>

                <button class="save-btn">
                    Save Changes
                </button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>