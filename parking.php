<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<div class="container mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Parking Overview</h2>

        <a href="add-parking.php" class="btn btn-success">
            <i class="fa-solid fa-plus"></i>
            Add Parking
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Slots</p>
                    <h3 class="fw-bold">320</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Available</p>
                    <h3 class="text-success fw-bold">82</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Occupied</p>
                    <h3 class="text-warning fw-bold">210</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Reserved</p>
                    <h3 class="text-danger fw-bold">28</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Second Row -->
    <div class="row mt-3">

        <!-- Parking Usage -->
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="mb-4">Parking Usage</h5>

                    <div class="row">

                        <!-- Circle -->
                        <div class="col-md-6">

                            <div class="d-flex justify-content-center align-items-center">

                                <div class="parking-circle">
                                    66%
                                </div>

                            </div>

                        </div>

                        <!-- Details -->
                        <div class="col-md-6 d-flex flex-column justify-content-center h-100">

                            <div class="mb-3 d-flex align-items-center">
                                <span class="status-dot bg-success"></span>
                                <span class="ms-2">Occupied</span>
                                <strong class="ms-auto">210</strong>
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <span class="status-dot bg-warning"></span>
                                <span class="ms-2">Available</span>
                                <strong class="ms-auto">82</strong>
                            </div>

                            <div class="d-flex align-items-center">
                                   <span class="status-dot bg-danger"></span>
                                   <span class="ms-2">Reserved</span>
                                   <strong class="ms-auto">28</strong>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>

        <!-- Recent Reservations -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="mb-4">Recent Reservations</h5>

                    <p class="text-muted">
                        No reservations yet.
                    </p>

                </div>

            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>