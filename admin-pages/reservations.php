<?php
require_once "../includes/admin-auth.php";
?>
<?php

include '../config/connection.php';

$current_page = basename($_SERVER['PHP_SELF']);

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


// ========================================
// Get Reservations
// ========================================

$sql = "
    SELECT
        pr.reservation_id,
        pr.start_time,
        pr.end_time,
        pr.status,

        r.resident_id,
        r.full_name,

        v.vehicle_id,
        v.plate_number,
        v.model,

        ps.slot_id,
        ps.slot_number

    FROM parking_reservations pr

    LEFT JOIN residents r
        ON pr.resident_id = r.resident_id

    LEFT JOIN vehicles v
        ON pr.vehicle_id = v.vehicle_id

    LEFT JOIN parking_slots ps
        ON pr.slot_id = ps.slot_id

    ORDER BY pr.reservation_id DESC
";


$result = mysqli_query($conn, $sql);


// ========================================
// Handle Error
// ========================================

$error_message = "";

if (!$result) {

    $error_message = "Unable to load reservations.";

}

?>


<div class="container mt-4">

    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Parking Reservations
        </h2>

    </div>


    <!-- Success Message -->

    <?php if (
        isset($_GET['deleted'])
        && $_GET['deleted'] === 'success'
    ): ?>

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            Reservation deleted successfully.

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <!-- Error Message -->

    <?php if (!empty($error_message)): ?>

        <div class="alert alert-danger">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            <?= htmlspecialchars($error_message) ?>

        </div>

    <?php endif; ?>


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


                    <?php if (
                        !empty($result)
                        && mysqli_num_rows($result) > 0
                    ): ?>


                        <?php while (
                            $reservation = mysqli_fetch_assoc($result)
                        ): ?>


                            <tr>


                                <!-- Reservation ID -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reservation['reservation_id']
                                    ) ?>

                                </td>


                                <!-- Resident -->

                                <td>

                                    <?php if (
                                        !empty($reservation['full_name'])
                                    ): ?>

                                        <?= htmlspecialchars(
                                            $reservation['full_name']
                                        ) ?>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            Unknown Resident</span>

                                    <?php endif; ?>

                                </td>


                                <!-- Vehicle -->

                                <td>

                                    <?php if (
                                        !empty($reservation['model'])
                                    ): ?>

                                        <?= htmlspecialchars(
                                            $reservation['model']
                                        ) ?>

                                        <br>

                                    <?php endif; ?>


                                    <?php if (
                                        !empty($reservation['plate_number'])
                                    ): ?>

                                        <small class="text-muted">

                                            <?= htmlspecialchars(
                                                $reservation['plate_number']
                                            ) ?>

                                        </small>

                                    <?php else: ?>

                                        <small class="text-muted">
                                            No Vehicle
                                        </small>

                                    <?php endif; ?>

                                </td>


                                <!-- Parking Slot -->

                                <td>

                                    <?php if (
                                        !empty($reservation['slot_number'])
                                    ): ?>

                                        <span class="fw-semibold">

                                            <?= htmlspecialchars(
                                                $reservation['slot_number']
                                            ) ?>

                                        </span>

                                    <?php else: ?>

                                        <span class="text-muted">
                                            No Slot
                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- Start Time -->

                                <td>

                                    <?php if (
                                        !empty($reservation['start_time'])
                                    ): ?>

                                        <?= date(
                                            'd M Y',
                                            strtotime(
                                                $reservation['start_time']
                                            )
                                        ) ?>

                                        <br>

                                        <small class="text-muted">

                                            <?= date(
                                                'h:i A',
                                                strtotime(
                                                    $reservation['start_time']
                                                )
                                            ) ?>

                                        </small>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </td>


                                <!-- End Time -->

                                <td>

                                    <?php if (
                                        !empty($reservation['end_time'])
                                    ): ?>

                                        <?= date(
                                            'd M Y',
                                            strtotime($reservation['end_time']
                                            )
                                        ) ?>

                                        <br>

                                        <small class="text-muted">

                                            <?= date(
                                                'h:i A',
                                                strtotime(
                                                    $reservation['end_time']
                                                )
                                            ) ?>

                                        </small>

                                    <?php else: ?>

                                        -

                                    <?php endif; ?>

                                </td>


                                <!-- Status -->

                                <td>

                                    <?php

                                    $status = strtolower(
                                        trim(
                                            $reservation['status']
                                        )
                                    );

                                    ?>


                                    <?php if (
                                        $status === 'confirmed'
                                    ): ?>

                                        <span class="badge bg-success">

                                            Confirmed

                                        </span>


                                    <?php elseif (
                                        $status === 'pending'
                                    ): ?>

                                        <span
                                            class="badge bg-warning text-dark">

                                            Pending

                                        </span>


                                    <?php elseif (
                                        $status === 'completed'
                                    ): ?>

                                        <span class="badge bg-primary">

                                            Completed

                                        </span>


                                    <?php elseif (
                                        $status === 'cancelled'
                                        || $status === 'canceled'
                                    ): ?>

                                        <span class="badge bg-danger">

                                            Cancelled

                                        </span>


                                    <?php else: ?>

                                        <span class="badge bg-secondary">

                                            <?= htmlspecialchars(
                                                ucfirst($status)
                                            ) ?>

                                        </span>

                                    <?php endif; ?>

                                </td>


                                <!-- Actions -->

                                <td>

                                    <!-- View -->

                                    <a
                                        href="view-reservations.php?id=<?= $reservation['reservation_id'] ?>"
                                        class="btn btn-sm btn-primary"
                                        title="View Reservation"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </a>


                                    <!-- Delete -->

                                    <a
                                        href="delete-reservations.php?id=<?= $reservation['reservation_id'] ?>"
                                        class="btn btn-sm btn-danger"title="Delete Reservation"
                                    >

                                        <i class="fa-solid fa-trash"></i>

                                    </a>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                    <?php elseif (
                        empty($error_message)
                    ): ?>


                        <!-- No Reservations -->

                        <tr>

                            <td
                                colspan="8"
                                class="text-center text-muted py-5"
                            >

                                <i
                                    class="fa-solid fa-calendar-xmark fa-2x mb-3"
                                ></i>

                                <br>

                                No reservations found.

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>


<?php include '../includes/footer.php'; ?>