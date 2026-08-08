<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/user-resident-details.css">

<div class="main-content">

    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="page-title">My Resident Details</h2>
                <p class="page-subtitle">
                    View your personal and apartment information
                </p>
            </div>

            <a href="billing.php" class="btn btn-outline-success">
                <i class="bi bi-receipt"></i>
                My Billing
            </a>

        </div>


        <!-- Profile Card -->
        <div class="user-details-card">

            <div class="profile-header">

                <div class="resident-avatar">
                    HA
                </div>

                <div>
                    <h3>Ahmed Ali</h3>

                    <p>
                        <i class="bi bi-building"></i>
                        Apartment A-204
                    </p>

                    <span class="status-badge">
                        Active
                    </span>
                </div>

            </div>


            <hr>


            <!-- Personal Information -->
            <h4>Personal Information</h4>

            <div class="details-grid">

                <div class="detail-box">
                    <span>Full Name</span>
                    <strong>Ahmed Ali</strong>
                </div>

                <div class="detail-box">
                    <span>Email</span>
                    <strong>ahmed@example.com</strong>
                </div>

                <div class="detail-box">
                    <span>Phone Number</span>
                    <strong>+20 100 123 4567</strong>
                </div>

                <div class="detail-box">
                    <span>Move In Date</span>
                    <strong>15 January 2025</strong>
                </div>

            </div>


            <hr>


            <!-- Apartment Information -->
            <h4>Apartment Information</h4>

            <div class="details-grid">

                <div class="detail-box">
                    <span>Apartment</span>
                    <strong>A-204</strong>
                </div>

                <div class="detail-box">
                    <span>Tower</span>
                    <strong>Tower A</strong>
                </div>

                <div class="detail-box">
                    <span>Floor</span>
                    <strong>2nd Floor</strong>
                </div>

                <div class="detail-box">
                    <span>Resident Status</span>
                    <strong class="active-text">
                        Active
                    </strong>
                </div>

            </div>


            <hr>


            <!-- Parking Information -->
            <h4>Parking Information</h4>

            <div class="parking-box">

                <div>
                    <i class="bi bi-car-front-fill"></i>
                </div>

                <div>
                    <span>Parking Slot</span>
                    <strong>A-15</strong>
                </div>

                <a href="parking.php" class="btn btn-success">
                    View Parking
                </a>

            </div>


            <!-- Billing -->
            <div class="billing-box">

                <div>
                    <i class="bi bi-receipt"></i>
                </div>

                <div>
                    <span>Billing</span>
                    <strong>View your invoices and payments</strong>
                </div>

                <a href="billing.php" class="btn btn-outline-success">
                    View Billing
                </a>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>