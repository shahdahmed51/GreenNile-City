<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <!-- Tabs -->
    <div class="settings-tabs">

    <a href="settings.php" class="settings-tab active">
        General
    </a>

    <a href="../user-pages/user-security.php" class="settings-tab">
        Security
    </a>

    <a href="../user-pages/user-notification-settings.php" class="settings-tab">
        Notifications
    </a>

    <a href="../user-pages/user-appearance.php" class="settings-tab">
        Appearance
    </a>

</div>
    <!-- Card -->
    <div class="settings-card">

        <!-- Left -->
        <div class="left-side">

            <div class="settings-icon">
                <i class="fa-solid fa-gear"></i>
            </div>

            <h3>General Settings</h3>

            <p>Manage your system account settings.</p>

        </div>

        <!-- Right -->
        <div class="right-side">

            <form>

                <label>Full Name</label>
                <input type="text" placeholder="Shahd Ahmed">

                <label>Email</label>
                <input type="email" placeholder="user@ecocity.com">

                <label>Phone Number</label>
                <input type="text" placeholder="+20 100 61 70 560">

                <label>Address</label>
                <input type="text" placeholder="EcoCity Residence">

                 <label>Apartment</label>
                  <select>
                    <option value="">Select Apartment</option>
                    <option value="A-101">A-101</option>
                    <option value="A-102">A-102</option>
                    <option value="B-201">B-201</option>
                    <option value="B-202">B-202</option>
                  </select>

                <div class="double-input">

                    <div>
                        <label>Language</label>
                        <select>
                            <option>English</option>
                            <option>Arabic</option>
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