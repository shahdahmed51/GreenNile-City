<?php

session_start();
require_once "../includes/user-auth.php";
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
        pr.created_at,

        v.model,
        v.plate_number,

        ps.slot_number,

        pz.zone_name

    FROM parking_reservations pr

    LEFT JOIN vehicles v
        ON pr.vehicle_id = v.vehicle_id

    LEFT JOIN parking_slots ps
        ON pr.slot_id = ps.slot_id

    LEFT JOIN parking_zones pz
        ON ps.zone_id = pz.zone_id

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


        <h2 class="fw-bold">

            Reservation Details

        </h2>


        <a
            href="my-reservations.php"
            class="btn btn-secondary"
        >

            <i class="fa-solid fa-arrow-left"></i>

            Back

        </a>


    </div>


    <!-- RESERVATION DETAILS -->

    <div class="card shadow-sm border-0">


        <div class="card-body">


            <div class="row">


                <!-- SLOT -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Parking Slot

                    </p>


                    <h5 class="fw-bold">

                        <?= htmlspecialchars(
                            $reservation["slot_number"] ?? "-"
                        ) ?>

                    </h5>

                </div>


                <!-- ZONE -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Parking Zone

                    </p>


                    <h5 class="fw-bold">

                        <?= htmlspecialchars(
                            $reservation["zone_name"] ?? "-"
                        ) ?>

                    </h5>

                </div>


                <!-- VEHICLE -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Vehicle

                    </p>


                    <h5 class="fw-bold">

                        <?= htmlspecialchars(
                            $reservation["model"] ?? "-"
                        ) ?>

                    </h5>


                    <?php if (
                        !empty(
                            $reservation["plate_number"]
                        )
                    ): ?><small class="text-muted">

                            <?= htmlspecialchars(
                                $reservation["plate_number"]
                            ) ?>

                        </small>

                    <?php endif; ?>

                </div>


                <!-- DATE -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Reservation Date

                    </p>


                    <h5 class="fw-bold">

                        <?= date(
                            "d M Y",
                            strtotime(
                                $reservation["start_time"]
                            )
                        ) ?>

                    </h5>

                </div>


                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Status

                    </p>


                    <?php if ($status === "confirmed"): ?>

                        <span class="badge bg-success fs-6">

                            Confirmed

                        </span>


                    <?php elseif ($status === "pending"): ?>

                        <span
                            class="badge bg-warning text-dark fs-6"
                        >

                            Pending

                        </span>


                    <?php elseif ($status === "completed"): ?>

                        <span class="badge bg-primary fs-6">

                            Completed

                        </span>


                    <?php else: ?>

                        <span class="badge bg-secondary fs-6">

                            <?= htmlspecialchars(
                                ucfirst($status)
                            ) ?>

                        </span>

                    <?php endif; ?>

                </div>


                <!-- START TIME -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Start Time

                    </p>


                    <h5 class="fw-bold">

                        <?= date(
                            "h:i A",
                            strtotime(
                                $reservation["start_time"]
                            )
                        ) ?>

                    </h5>

                </div>


                <!-- END TIME -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        End Time

                    </p>


                    <h5 class="fw-bold">

                        <?= date(
                            "h:i A",
                            strtotime(
                                $reservation["end_time"]
                            )
                        ) ?>

                    </h5>

                </div>


                <!-- CREATED -->

                <div class="col-md-6 mb-3">

                    <p class="text-muted mb-1">

                        Reservation Created

                    </p>


                    <h5 class="fw-bold">

                        <?= date(
                            "d M Y h:i A",
                            strtotime(
                                $reservation["created_at"]
                            )
                        ) ?>

                    </h5>

                </div>


            </div>


            <hr>


            <!-- ACTION -->

            <div class="text-end">


                <?php if (
                    $status === "confirmed" ||
                    $status === "pending"
                ): ?>

                    <a
                        href="cancel-reservation.php?id=<?= $reservation["reservation_id"] ?>"
                        class="btn btn-danger"
                    >

                        <i class="fa-solid fa-xmark"></i>

                        Cancel Reservation

                    </a><?php endif; ?>


            </div>


        </div>

    </div>


</div>


<?php include "../includes/footer.php"; ?>