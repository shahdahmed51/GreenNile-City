<?php

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
// CURRENT PAGE
// ========================================

$current_page = basename($_SERVER["PHP_SELF"]);


// ========================================
// AVAILABLE SLOTS
// ========================================

$available_slots = 0;

$sql = "
    SELECT COUNT(*) AS total
    FROM parking_slots
    WHERE status = 'available'
";

$result = mysqli_query($conn, $sql);

if ($result) {

    $row = mysqli_fetch_assoc($result);

    $available_slots = (int) $row["total"];

}


// ========================================
// MY RESERVATIONS
// ========================================

$my_reservations = 0;

$sql = "
    SELECT COUNT(*) AS total
    FROM parking_reservations
    WHERE resident_id = $resident_id
";

$result = mysqli_query($conn, $sql);

if ($result) {

    $row = mysqli_fetch_assoc($result);

    $my_reservations = (int) $row["total"];

}


// ========================================
// UPCOMING RESERVATION
// ========================================

$upcoming_reservation = 0;

$sql = "
    SELECT COUNT(*) AS total
    FROM parking_reservations
    WHERE resident_id = $resident_id
    AND start_time > NOW()
    AND status IN ('confirmed', 'pending')
";

$result = mysqli_query($conn, $sql);

if ($result) {

    $row = mysqli_fetch_assoc($result);

    $upcoming_reservation = (int) $row["total"];

}


// ========================================
// RECENT RESERVATIONS
// ========================================

$sql = "
    SELECT
        pr.reservation_id,
        pr.start_time,
        pr.end_time,
        pr.status,
        v.model,
        v.plate_number,
        ps.slot_number

    FROM parking_reservations pr

    LEFT JOIN vehicles v
        ON pr.vehicle_id = v.vehicle_id

    LEFT JOIN parking_slots ps
        ON pr.slot_id = ps.slot_id

    WHERE pr.resident_id = $resident_id

    ORDER BY pr.created_at DESC

    LIMIT 5
";

$recent_reservations = mysqli_query($conn, $sql);


// ========================================
// HTML INCLUDES
// ========================================

include "../includes/header.php";

include "../includes/navbar.php";

include "../includes/user-sidebar.php";

?>


<div class="container mt-4">


    <!-- PAGE HEADER -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            My Parking
        </h2>

        <a
            href="reserve-parking.php"
            class="btn btn-success"
        >

            <i class="fa-solid fa-square-parking"></i>

            Reserve Parking

        </a>

    </div>


    <!-- STATISTICS -->

    <div class="row">


        <!-- AVAILABLE -->

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Available Slots
                    </p>

                    <h3 class="fw-bold text-success">

                        <?= $available_slots ?>

                    </h3>

                </div>

            </div>

        </div>


        <!-- MY RESERVATIONS -->

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        My Reservations
                    </p>

                    <h3 class="fw-bold text-primary">

                        <?= $my_reservations ?></h3>

                </div>

            </div>

        </div>


        <!-- UPCOMING -->

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Upcoming Reservation
                    </p>

                    <h3 class="fw-bold text-warning">

                        <?= $upcoming_reservation ?>

                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- RECENT RESERVATIONS -->

    <div class="card shadow-sm border-0">

        <div class="card-body">


            <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="mb-0">
                    My Recent Reservations
                </h5>


                <a
                    href="my-reservations.php"
                    class="text-success text-decoration-none fw-semibold"
                >

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


                    <?php

                    if (
                        $recent_reservations &&
                        mysqli_num_rows($recent_reservations) > 0
                    ):

                    ?>


                        <?php while (
                            $reservation =
                            mysqli_fetch_assoc($recent_reservations)
                        ):

                        ?>


                            <tr>


                                <!-- SLOT -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reservation["slot_number"] ?? "-"
                                    ) ?>

                                </td>


                                <!-- VEHICLE -->

                                <td>

                                    <?= htmlspecialchars(
                                        $reservation["model"] ?? "-"
                                    ) ?>

                                    <?php if (
                                        !empty(
                                            $reservation["plate_number"]
                                        )
                                    ): ?>

                                        <br>

                                        <small class="text-muted">

                                            <?= htmlspecialchars(
                                                $reservation["plate_number"]
                                            ) ?>

                                        </small>

                                    <?php endif; ?>

                                </td>


                                <!-- DATE -->

                                <td>

                                    <?= date(
                                        "d M Y",
                                        strtotime(
                                            $reservation["start_time"]
                                        )
                                    ) ?>

                                    <br>

                                    <small class="text-muted">

                                        <?= date(
                                            "h:i A",
                                            strtotime($reservation["start_time"]
                                            )
                                        ) ?>

                                    </small>

                                </td>


                                <!-- STATUS -->

                                <td>


                                    <?php

                                    $status = strtolower(
                                        trim(
                                            $reservation["status"]
                                        )
                                    );

                                    ?>


                                    <?php if (
                                        $status === "confirmed"
                                    ): ?>

                                        <span class="badge bg-success">
                                            Confirmed
                                        </span>


                                    <?php elseif (
                                        $status === "pending"
                                    ): ?>

                                        <span class="badge bg-warning text-dark">
                                            Pending
                                        </span>


                                    <?php elseif (
                                        $status === "completed"
                                    ): ?>

                                        <span class="badge bg-primary">
                                            Completed
                                        </span>


                                    <?php elseif (
                                        $status === "cancelled" ||
                                        $status === "canceled"
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


                                <!-- ACTION -->

                                <td>

                                    <a
                                        href="view-reservation.php?id=<?= $reservation["reservation_id"] ?>"
                                        class="btn btn-sm btn-primary"
                                    >

                                        <i class="fa-solid fa-eye"></i>

                                    </a>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                    <?php else: ?>


                        <tr>

                            <td
                                colspan="5"
                                class="text-center text-muted py-5"
                            >

                                <i
                                    class="fa-solid fa-square-parking fa-2x mb-3"
                                ></i>

                                <br>

                                You don't have any reservations yet.


                                <br>


                                <a
                                    href="reserve-parking.php"
                                    class="btn btn-success btn-sm mt-3"
                                >

                                    Reserve Parking

                                </a>

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody></table>

            </div>

        </div>

    </div>

</div>


<?php include "../includes/footer.php"; ?>