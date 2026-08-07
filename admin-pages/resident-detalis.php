<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<div class="main-content">
    <div class="container-fluid py-4">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Resident Details</h2>
                <p class="text-muted">View resident information.</p>
            </div>

            <a href="residents.php" class="btn btn-outline-success">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <div class="row">

            <!-- Resident Profile -->
            <div class="col-lg-4">

                <div class="card shadow-sm border-0 text-center">

                    <div class="card-body">

                        <img src="../assets/images/user.png"
                             class="rounded-circle mb-3"
                             width="120"
                             height="120">

                        <h4 class="fw-bold">Ahmed Ali</h4>

                        <p class="text-muted">
                            Resident ID : RES-001
                        </p>

                        <span class="badge bg-success">
                            Active
                        </span>

                    </div>

                </div>

            </div>

            <!-- Information -->
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Personal Information
                        </h5>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <strong>Full Name</strong>
                                <p>Ahmed Ali</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Email</strong>
                                <p>ahmed@gmail.com</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Phone</strong>
                                <p>+20 100 123 4567</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Unit Number</strong>
                                <p>A-203</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Building</strong>
                                <p>Building A</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <strong>Move In Date</strong>
                                <p>10 Jan 2025</p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Vehicle -->

                <div class="card shadow-sm border-0 mt-4">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Vehicle Information
                        </h5>

                        <div class="row">

                            <div class="col-md-4">
                                <strong>Vehicle</strong>
                                <p>Toyota Corolla</p>
                            </div>

                            <div class="col-md-4">
                                <strong>Plate Number</strong>
                                <p>ABC-1234</p>
                            </div>

                            <div class="col-md-4">
                                <strong>Parking Slot</strong>
                                <p>A-15</p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- Billing -->

                <div class="card shadow-sm border-0 mt-4">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Billing Status
                        </h5>

                        <div class="row">

                            <div class="col-md-4">

                                <strong>Total Due</strong>

                                <p>$250</p>

                            </div>

                            <div class="col-md-4">

                                <strong>Status</strong>

                                <p>
                                    <span class="badge bg-success">
                                        Paid
                                    </span>
                                </p>

                            </div>

                        </div>

                        <div class="mt-4">

                            <a href="edit-resident.php"
                               class="btn btn-success">
                                Edit Resident
                            </a>
                           <button
                               class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to delete this resident?')">

                              <i class="bi bi-trash"></i>
                               Delete

                                </button> 

                            <a href="billing.php"
                               class="btn btn-outline-success">
                                View Billing
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>