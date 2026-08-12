<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>

<div class="container mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">My Parking</h2>

        <a href="reserve-parking.php" class="btn btn-success">
            <i class="fa-solid fa-square-parking"></i>
            Reserve Parking
        </a>

    </div>

    <!-- Statistics -->
    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">Available Slots</p>

                    <h3 class="fw-bold text-success">82</h3>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">My Reservations</p>

                    <h3 class="fw-bold text-primary">2</h3>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">Upcoming Reservation</p>

                    <h3 class="fw-bold text-warning">1</h3>

                </div>

            </div>

        </div>

    </div>

    <!-- Recent Reservations -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">My Recent Reservations</h5>

                <a href="my-reservations.php"
                   class="text-success text-decoration-none fw-semibold">

                    View All
                    <i class="fa-solid fa-arrow-right"></i>

                </a>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th>Slot</th>
                            <th>Vehicle</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>A01</td>

                            <td>Toyota Corolla</td>

                            <td>14 May 2026</td>

                            <td>

                                <span class="badge bg-success">
                                    Confirmed
                                </span>

                            </td>

                            <td>

                                <a href="view-reservation.php"
                                   class="btn btn-sm btn-primary">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>B05</td>

                            <td>Hyundai Elantra</td>

                            <td>16 May 2026</td>

                            <td>

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            </td>

                            <td>

                                <a href="view-reservation.php"
                                   class="btn btn-sm btn-primary">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>