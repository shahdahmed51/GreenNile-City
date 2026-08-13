<?php
require_once "../includes/user-auth.php";

session_start();

require_once "../config/connection.php";

// ========================================
// CHECK LOGIN
// ========================================

if (!isset($_SESSION["user_id"])) {

    header("Location: ../admin-pages/login.php");
    exit();

}


// ========================================
// CHECK RESIDENT
// ========================================

if (
    !isset($_SESSION["resident_id"]) ||
    empty($_SESSION["resident_id"])
) {

    header("Location: ../admin-pages/login.php");
    exit();

}

$resident_id = (int) $_SESSION["resident_id"];


// ========================================
// GET RESERVATION ID
// ========================================

if (
    !isset($_GET["id"]) ||
    !is_numeric($_GET["id"])
) {

    header("Location: parking.php");
    exit();

}

$reservation_id = (int) $_GET["id"];


// ========================================
// GET RESERVATION
// ========================================

$sql = "
    SELECT
        pr.reservation_id,
        pr.start_time,
        pr.end_time,
        pr.status,

        v.model,
        v.plate_number,

        ps.slot_id,
        ps.slot_number

    FROM parking_reservations pr

    LEFT JOIN vehicles v
        ON pr.vehicle_id = v.vehicle_id

    LEFT JOIN parking_slots ps
        ON pr.slot_id = ps.slot_id

    WHERE pr.reservation_id = $reservation_id
    AND pr.resident_id = $resident_id

    LIMIT 1
";

$result = mysqli_query($conn, $sql);


// ========================================
// CHECK RESERVATION
// ========================================

if (
    !$result ||
    mysqli_num_rows($result) === 0
) {

    header("Location: parking.php");
    exit();

}

$reservation = mysqli_fetch_assoc($result);


// ========================================
// HANDLE CANCEL
// ========================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // ========================================
    // ONLY CONFIRMED / PENDING CAN BE CANCELLED
    // ========================================

    if (
        $reservation["status"] !== "confirmed" &&
        $reservation["status"] !== "pending"
    ) {

        header(
            "Location: view-reservation.php?id="
            . $reservation_id
        );

        exit();

    }


    // ========================================
    // CANCEL RESERVATION
    // ========================================

    $cancel_sql = "
        UPDATE parking_reservations

        SET status = 'cancelled'

        WHERE reservation_id = $reservation_id

        AND resident_id = $resident_id
    ";

    $cancel_result = mysqli_query(
        $conn,
        $cancel_sql
    );


    if ($cancel_result) {


        // ========================================
        // FREE PARKING SLOT
        // ========================================

        $slot_id = (int) $reservation["slot_id"];


        $slot_sql = "
            UPDATE parking_slots

            SET status = 'available'

            WHERE slot_id = $slot_id
        ";

        mysqli_query(
            $conn,
            $slot_sql
        );


        // ========================================
        // GO BACK TO PARKING
        // ========================================

        header("Location: parking.php");

        exit();

    }

}


// ========================================
// STATUS
// ========================================

$status = strtolower(
    trim($reservation["status"])
);


?>


<?php include "../includes/header.php"; ?>

<?php include "../includes/navbar.php"; ?>

<?php include "../includes/user-sidebar.php"; ?>


<div class="container mt-4">


    <!-- PAGE HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">


        <h2 class="fw-bold text-danger">

            Cancel Reservation

        </h2>


        <a
            href="my-reservations.php"
            class="btn btn-secondary"
        >

            <i class="fa-solid fa-arrow-left"></i>

            Back

        </a>


    </div>


    <!-- CONFIRMATION CARD --><div class="card shadow-sm border-0">


        <div class="card-body text-center">


            <div class="mb-4">

                <i
                    class="fa-solid fa-circle-exclamation text-danger"
                    style="font-size:60px;"
                >
                </i>

            </div>


            <h4 class="fw-bold mb-3">

                Are you sure you want to cancel this reservation?

            </h4>


            <p class="text-muted">

                You are about to cancel your parking reservation:

            </p>


            <!-- RESERVATION INFO -->

            <div class="row justify-content-center mt-4">


                <div class="col-md-6">


                    <div class="card bg-light border-0">


                        <div class="card-body">


                            <!-- SLOT -->

                            <p class="mb-2">

                                <strong>Slot:</strong>

                                <?= htmlspecialchars(
                                    $reservation["slot_number"]
                                ) ?>

                            </p>


                            <!-- VEHICLE -->

                            <p class="mb-2">

                                <strong>Vehicle:</strong>

                                <?= htmlspecialchars(
                                    $reservation["model"] ?? "-"
                                ) ?>

                                <?php if (
                                    !empty(
                                        $reservation["plate_number"]
                                    )
                                ): ?>

                                    -

                                    <?= htmlspecialchars(
                                        $reservation["plate_number"]
                                    ) ?>

                                <?php endif; ?>

                            </p>


                            <!-- DATE -->

                            <p class="mb-2">

                                <strong>Date:</strong>

                                <?= date(
                                    "d M Y",
                                    strtotime(
                                        $reservation["start_time"]
                                    )
                                ) ?>

                            </p>


                            <!-- TIME -->

                            <p class="mb-0">

                                <strong>Time:</strong>

                                <?= date(
                                    "h:i A",
                                    strtotime(
                                        $reservation["start_time"]
                                    )
                                ) ?>

                                -

                                <?= date(
                                    "h:i A",
                                    strtotime(
                                        $reservation["end_time"]
                                    )
                                ) ?>

                            </p>


                        </div>

                    </div>

                </div>

            </div>


            <!-- BUTTONS -->

            <div class="mt-4">


                <a
                    href="view-reservation.php?id=<?= $reservation_id ?>"
                    class="btn btn-secondary me-2"
                >

                    No, Keep Reservation

                </a>


                <form
                    method="POST"
                    style="display:inline;"
                >

                    <button
                        type="submit"
                        class="btn btn-danger"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        Yes, Cancel Reservation

                    </button>

                </form>


            </div>


        </div>

    </div>

</div>
<?php include "../includes/footer.php"; ?>