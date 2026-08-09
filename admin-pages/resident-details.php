<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php';?>

<div class="main-content">

    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">Resident Details</h2>
                <p class="text-muted">
                    View resident information
                </p>
            </div>

            <a href="resident.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Back to Residents
            </a>

        </div>

        <!-- Resident Card -->
        <div class="card shadow-sm border-0 resident-card">

            <div class="card-body p-4">

                <!-- Profile -->
                <div class="profile-section">

                    <div class="resident-avatar">
                        HA
                    </div>

                    <div>
                        <h3 class="fw-bold mb-1">
                            Ahmed Ali
                        </h3>

                        <p class="text-muted mb-2">
                            Apartment A-204
                        </p>

                        <span class="badge bg-success">
                            Active
                        </span>
                    </div>

                </div>

                <hr class="my-4">

                <!-- Information -->
                <h5 class="fw-bold mb-3">
                    Personal Information
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Full Name</span>
                            <strong>Ahmed Ali</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Email</span>
                            <strong>ahmed@example.com</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Phone Number</span>
                            <strong>+20 100 123 4567</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Apartment</span>
                            <strong>A-204</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Move In Date</span>
                            <strong>15 January 2025</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Status</span>
                            <strong class="text-success">
                                Active
                            </strong>
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                <!-- Vehicle Information -->
                <h5 class="fw-bold mb-3">
                    Vehicle Information
                </h5>

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Vehicle</span>
                            <strong>Toyota Corolla</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Plate Number</span>
                            <strong>ABC-1234</strong>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="info-box">
                            <span>Parking Slot</span>
                            <strong>A-15</strong>
                        </div>
                    </div>

                </div>

                <!-- Actions -->
                <div class="actions mt-4">

                    <a href="edit-resident.php"
                       class="btn btn-success">

                        <i class="bi bi-pencil"></i>
                        Edit Resident

                    </a>

                    <a href="billing.php"
                       class="btn btn-outline-success">

                        <i class="bi bi-receipt"></i>
                        View Billing

                    </a>

                    <button type="button"
                            id="deleteResident"
                            class="btn btn-danger">

                        <i class="bi bi-trash"></i>
                        Delete Resident

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="../assets/js/resident-details.js"></script>

<?php include '../includes/footer.php'; ?>