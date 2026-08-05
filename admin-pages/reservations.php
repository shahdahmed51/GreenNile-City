<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Parking Reservations</h2>

    </div>

    <!-- Reservations Table -->
    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>
                            <th>#</th>
                            <th>Resident</th>
                            <th>Vehicle</th>
                            <th>Parking Slot</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>1</td>

                            <td>Ahmed Ali</td>

                            <td>Toyota Corolla</td>

                            <td>A01</td>

                            <td>14 May 2026 <br> 10:00 AM</td>

                            <td>14 May 2026 <br> 01:00 PM</td>

                            <td>
                                <span class="badge bg-success">
                                    Confirmed
                                </span>
                            </td>

                            <td>

                                <a href="view-reservations.php" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="delete-reservations.php" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>2</td>

                            <td>Sara Mohamed</td>

                            <td>Hyundai Elantra</td>

                            <td>B03</td>

                            <td>14 May 2026 <br> 11:30 AM</td>

                            <td>14 May 2026 <br> 02:30 PM</td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>
                            </td>

                            <td>

                                <a href="view-reservations.php" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="delete-reservations.php" class="btn btn-sm btn-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </a>

                            </td>

                        </tr>

                        <tr>

                            <td>3</td>

                            <td>Omar Hassan</td>

                            <td>Kia Sportage</td>

                            <td>C08</td>

                            <td>15 May 2026 <br> 09:00 AM</td>

                            <td>15 May 2026 <br> 12:00 PM</td>

                            <td>
                                <span class="badge bg-danger">
                                    Cancelled
                                </span>
                            </td>

                            <td>

                                <a href="view-reservations.php" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="delete-reservations.php" class="btn btn-sm btn-danger">
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

<?php include '../includes/footer.php'; ?>