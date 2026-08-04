<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <!-- Tabs -->
    <div class="tabs">
        <button class="active">General</button>
        <button>Security</button>
        <button>Notifications</button>
        <button>Appearance</button>
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

                <label>Site Name</label>
                <input type="text" placeholder="EcoCity Management System">

                <label>Admin Email</label>
                <input type="email" placeholder="admin@ecocity.com">

                <label>Phone Number</label>
                <input type="text" placeholder="+20 100 61 70 560">

                <label>Address</label>
                <input type="text" placeholder="EcoCity Residence">

                <div class="double-input">

                    <div>
                        <label>Language</label>
                        <select>
                            <option>English</option>
                            <option>Arabic</option>
                        </select>
                    </div>

                    <div>
                        <label>Currency</label>
                        <select>
                            <option>USD</option>
                            <option>EGP</option>
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