<?php
require_once "../includes/admin-auth.php";
?>
<?php

include "../config/connection.php";


// ===============================
// Variables
// ===============================

$error = "";
$success = "";

$reservation = null;


// ===============================
// Get Reservation ID
// ===============================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    $error = "Invalid reservation ID.";

} else {

    $reservation_id = (int) $_GET['id'];


    // ===============================
    // Get Reservation Information
    // ===============================

    $query = "
        SELECT
            pr.reservation_id,
            r.full_name,
            v.plate_number,
            v.model,
            v.color,
            ps.slot_number,
            pr.start_time,
            pr.end_time,
            pr.status

        FROM parking_reservations pr

        LEFT JOIN residents r
            ON pr.resident_id = r.resident_id

        LEFT JOIN vehicles v
            ON pr.vehicle_id = v.vehicle_id

        LEFT JOIN parking_slots ps
            ON pr.slot_id = ps.slot_id

        WHERE pr.reservation_id = $reservation_id
    ";


    $result = mysqli_query($conn, $query);


    if (!$result) {

        $error = "Something went wrong while loading the reservation.";

    } else {

        $reservation = mysqli_fetch_assoc($result);


        // ===============================
        // Reservation Doesn't Exist
        // ===============================

        if (!$reservation) {

            $error = "This reservation does not exist or has already been deleted.";

        }

    }

}


// ===============================
// Delete Reservation
// ===============================

if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && empty($error)
    && $reservation
) {

    $deleteQuery = "
        DELETE FROM parking_reservations
        WHERE reservation_id = $reservation_id
    ";


    if (mysqli_query($conn, $deleteQuery)) {

        /*
         * Reservation deleted successfully.
         *
         * Payments are NOT deleted.
         * Because the foreign key uses:
         *
         * ON DELETE SET NULL
         *
         * the payment will remain in the database
         * and reservation_id will become NULL.
         */


        header("Location: parking.php?deleted=success");
        exit;


    } else {

        $error = "Unable to delete this reservation. Please try again.";

    }

}

?>


<?php include '../includes/header.php'; ?>

<?php include '../includes/navbar.php'; ?>

<?php include '../includes/sidebar.php'; ?>


<div class="container mt-4">


    <!-- ===============================
         Error Message
    ================================ -->

    <?php if (!empty($error)): ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="fa-solid fa-circle-exclamation me-2"></i>

            <strong>Error:</strong>

            <?= htmlspecialchars($error) ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>


        <div class="text-center mt-3">

            <a
                href="parking.php"
                class="btn btn-secondary"
            >

                <i class="fa-solid fa-arrow-left me-2"></i>

                Back to Parking

            </a>

        </div>


    <?php else: ?>


        <!-- ===============================
             Delete Card
        ================================ -->

        <div class="row justify-content-center">

            <div class="col-md-6">

                <div class="card shadow-sm border-0">


                    <!-- Header -->

                    <div class="card-header bg-danger text-white">

                        <h4 class="mb-0">

                            <i class="fa-solid fa-trash me-2"></i>

                            Delete Reservation

                        </h4>

                    </div>


                    <!-- Body -->

                    <div class="card-body text-center"><!-- Warning Icon -->

                        <i
                            class="fa-solid fa-circle-exclamation text-danger mb-3"
                            style="font-size:70px;"
                        ></i>


                        <!-- Question -->

                        <h5 class="mb-3">

                            Are you sure you want to delete this reservation?

                        </h5>


                        <!-- Reservation ID -->

                        <p class="text-muted">

                            Reservation #

                            <strong>

                                <?= $reservation['reservation_id'] ?>

                            </strong>

                        </p>


                        <!-- Resident -->

                        <p class="text-muted">

                            Resident:

                            <strong>

                                <?= htmlspecialchars(
                                    $reservation['full_name'] ?? '-'
                                ) ?>

                            </strong>

                        </p>


                        <!-- Vehicle -->

                        <p class="text-muted">

                            Vehicle:

                            <strong>

                                <?= htmlspecialchars(
                                    $reservation['plate_number'] ?? '-'
                                ) ?>


                                <?php if (!empty($reservation['model'])): ?>

                                    -

                                    <?= htmlspecialchars(
                                        $reservation['model']
                                    ) ?>

                                <?php endif; ?>

                            </strong>

                        </p>


                        <!-- Parking Slot -->

                        <p class="text-muted">

                            Parking Slot:

                            <strong>

                                <?= htmlspecialchars(
                                    $reservation['slot_number'] ?? '-'
                                ) ?>

                            </strong>

                        </p>


                        <!-- Status -->

                        <p class="text-muted">

                            Status:

                            <strong>

                                <?= htmlspecialchars(
                                    $reservation['status'] ?? '-'
                                ) ?>

                            </strong>

                        </p>


                        <!-- ===============================
                             Delete Form
                        ================================ -->

                        <form
                            action="delete-reservations.php?id=<?= $reservation_id ?>"
                            method="POST"
                        >

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >

                                <i class="fa-solid fa-trash me-2"></i>

                                Delete

                            </button>


                            <a
                                href="parking.php"
                                class="btn btn-secondary"
                            >

                                Cancel

                            </a>

                        </form>


                    </div>

                </div>

            </div>

        </div>


    <?php endif; ?>


</div>


<?php include '../includes/footer.php'; ?>
