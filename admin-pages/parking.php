<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Parking Management</h2>
    </div>

    <!-- Statistics -->
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

    <!-- Parking Usage + Recent Reservations -->
    <div class="row mt-3">

        <!-- Parking Usage -->
        <div class="col-md-7 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="mb-4">Parking Usage</h5>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="d-flex justify-content-center align-items-center">

                                <div class="parking-circle">
                                    <div class="circle-content">
                                        66%
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-6 d-flex flex-column justify-content-center">

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

                    <div class="reservation-item d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex align-items-center">

                            <div class="reservation-icon">
                                <i class="fa-solid fa-car"></i>
                            </div>

                            <div class="ms-3">
                                <h6 class="mb-1">Ahmed Ali</h6>
                                <small class="text-muted">Slot A01</small>
                            </div>

                        </div>

                        <small class="text-muted">
                            Today 10:30 AM
                        </small>

                    </div>

                    <hr>

                    <div class="reservation-item d-flex justify-content-between align-items-center mb-3">

                        <div class="d-flex align-items-center">

                            <div class="reservation-icon">
                                <i class="fa-solid fa-car"></i>
                            </div>

                            <div class="ms-3">
                                <h6 class="mb-1">Sara Mohamed</h6>
                                <small class="text-muted">Slot B12</small>
                            </div>

                        </div>

                        <small class="text-muted">
                            Today 11:00 AM
                        </small>

                    </div>

                    <hr>

                    <div class="reservation-item d-flex justify-content-between align-items-center">

                        <div class="d-flex align-items-center">

                            <div class="reservation-icon">
                                <i class="fa-solid fa-car"></i>
                            </div>

                            <div class="ms-3">
                                <h6 class="mb-1">Omar Hassan</h6>
                                <small class="text-muted">Slot C08</small>
                            </div>

                        </div>

                        <small class="text-muted">
                            Today 01:15 PM
                        </small>

                    </div>

                    <div class="text-center mt-3">

                        <a href="reservations.php"
                           class="text-success text-decoration-none fw-semibold">

                            View All
                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
        <!-- Parking Management -->
    <div class="row mt-3">

        <div class="col-md-12 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="mb-0">Parking Management</h5>

                        <a href="add-slot.php" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i>
                            Add Slot
                        </a>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="table-light">

                                <tr>
                                    <th>Slot ID</th>
                                    <th>Zone</th>
                                    <th>Status</th>
                                    <th>Vehicle</th>
                                    <th>Resident</th>
                                    <th>Actions</th>
                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>A01</td>

                                    <td>Zone A</td>

                                    <td>
                                        <span class="badge bg-success">
                                            Available
                                        </span>
                                    </td>

                                    <td>ABC-789</td>

                                    <td>Shahd ahmed</td>

                                    <td>

                                        <a href="edit-slot.php"
                                           class="btn btn-sm btn-primary">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a href="delete-slot.php"
                                           class="btn btn-sm btn-danger">

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                                <tr>

                                    <td>A02</td>

                                    <td>Zone A</td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            Occupied
                                        </span>
                                    </td>

                                    <td>ABC-123</td>

                                    <td>Ahmed Ali</td>

                                    <td>

                                        <a href="edit-slot.php"
                                           class="btn btn-sm btn-primary">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a href="delete-slot.php"
                                           class="btn btn-sm btn-danger">

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                                <tr>

                                    <td>B03</td>

                                    <td>Zone B</td>

                                    <td>
                                        <span class="badge bg-danger">
                                            Reserved
                                        </span>
                                    </td>

                                    <td>XYZ-458</td>

                                    <td>Sara Mohamed</td>

                                    <td>

                                        <a href="edit-slot.php"
                                           class="btn btn-sm btn-primary">

                                            <i class="fa-solid fa-pen"></i>

                                        </a>

                                        <a href="delete-slot.php"
                                           class="btn btn-sm btn-danger">

                                            <i class="fa-solid fa-trash"></i>

                                        </a>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>