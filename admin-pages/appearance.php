<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <div class="tabs">
        <button onclick="location.href='settings.php'">General</button>
        <button onclick="location.href='security.php'">Security</button>
        <button onclick="location.href='notification-settings.php'">Notifications</button>
        <button class="active">Appearance</button>
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