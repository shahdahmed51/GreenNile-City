<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fa-solid fa-eye me-2"></i>
                Reservation Details
            </h4>
        </div>

        <div class="card-body">

            <table class="table">

                <tr>
                    <th>Reservation ID</th>
                    <td>#1</td>
                </tr>

                <tr>
                    <th>Resident</th>
                    <td>Ahmed Ali</td>
                </tr>

                <tr>
                    <th>Vehicle</th>
                    <td>Toyota Corolla</td>
                </tr>

                <tr>
                    <th>Plate Number</th>
                    <td>ABC-123</td>
                </tr>

                <tr>
                    <th>Parking Slot</th>
                    <td>A01</td>
                </tr>

                <tr>
                    <th>Start Time</th>
                    <td>14 May 2026 - 10:00 AM</td>
                </tr>

                <tr>
                    <th>End Time</th>
                    <td>14 May 2026 - 01:00 PM</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-success">
                            Confirmed
                        </span>
                    </td>
                </tr>

            </table>

            <a href="reservations.php"
               class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>