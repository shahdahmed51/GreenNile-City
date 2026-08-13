<?php

session_start();

require_once "../config/connection.php";
require_once "../includes/user-auth.php";

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
// HANDLE RESERVATION
// ========================================

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $vehicle_id = isset($_POST["vehicle_id"])
        ? (int) $_POST["vehicle_id"]
        : 0;

    $slot_id = isset($_POST["slot_id"])
        ? (int) $_POST["slot_id"]
        : 0;

    $date = $_POST["date"] ?? "";
    $start_time = $_POST["start_time"] ?? "";
    $end_time = $_POST["end_time"] ?? "";


    // ========================================
    // BASIC VALIDATION
    // ========================================

    if (
        $vehicle_id <= 0 ||
        $slot_id <= 0 ||
        empty($date) ||
        empty($start_time) ||
        empty($end_time)
    ) {

        $message = "Please fill in all fields.";
        $message_type = "danger";

    } else {

        $start_datetime = $date . " " . $start_time . ":00";
        $end_datetime = $date . " " . $end_time . ":00";


        // ========================================
        // CHECK TIME
        // ========================================

        if ($start_datetime >= $end_datetime) {

            $message = "End time must be after start time.";
            $message_type = "danger";

        } else {

            // ========================================
            // CHECK VEHICLE
            // ========================================

            $vehicle_sql = "
                SELECT vehicle_id
                FROM vehicles
                WHERE vehicle_id = $vehicle_id
                AND resident_id = $resident_id
            ";

            $vehicle_result = mysqli_query($conn, $vehicle_sql);


            if (
                !$vehicle_result ||
                mysqli_num_rows($vehicle_result) === 0
            ) {

                $message = "Invalid vehicle.";
                $message_type = "danger";

            } else {

                // ========================================
                // CHECK SLOT
                // ========================================

                $slot_sql = "
                    SELECT slot_id, status
                    FROM parking_slots
                    WHERE slot_id = $slot_id
                ";

                $slot_result = mysqli_query($conn, $slot_sql);


                if (
                    !$slot_result ||
                    mysqli_num_rows($slot_result) === 0
                ) {

                    $message = "Invalid parking slot.";
                    $message_type = "danger";

                } else {

                    $slot = mysqli_fetch_assoc($slot_result);


                    // ========================================
                    // CHECK SLOT AVAILABILITY
                    // ========================================

                    if ($slot["status"] !== "available") {

                        $message = "This parking slot is not available.";
                        $message_type = "danger";

                    } else {

                        // ========================================
                        // CHECK OVERLAPPING RESERVATION
                        // ========================================

                        $overlap_sql = "
                            SELECT reservation_id
                            FROM parking_reservations
                            WHERE slot_id = $slot_id
                            AND status IN ('pending', 'confirmed')AND start_time < '$end_datetime'
                            AND end_time > '$start_datetime'
                            LIMIT 1
                        ";

                        $overlap_result =
                            mysqli_query($conn, $overlap_sql);


                        if (
                            $overlap_result &&
                            mysqli_num_rows($overlap_result) > 0
                        ) {

                            $message =
                                "This slot is already reserved during this time.";

                            $message_type = "danger";

                        } else {

                            // ========================================
                            // INSERT RESERVATION
                            // ========================================

                            $insert_sql = "
                                INSERT INTO parking_reservations
                                (
                                    resident_id,
                                    vehicle_id,
                                    slot_id,
                                    start_time,
                                    end_time,
                                    status
                                )
                                VALUES
                                (
                                    $resident_id,
                                    $vehicle_id,
                                    $slot_id,
                                    '$start_datetime',
                                    '$end_datetime',
                                    'confirmed'
                                )
                            ";

                            $insert_result =
                                mysqli_query($conn, $insert_sql);


                            if ($insert_result) {

                                $reservation_id =
                                    mysqli_insert_id($conn);


                                // ========================================
                                // UPDATE SLOT
                                // ========================================

                                $update_slot_sql = "
                                    UPDATE parking_slots
                                    SET status = 'reserved'
                                    WHERE slot_id = $slot_id
                                ";

                                mysqli_query(
                                    $conn,
                                    $update_slot_sql
                                );


                                // ========================================
                                // REDIRECT TO VIEW
                                // ========================================

                                header(
                                    "Location: view-reservation.php?id="
                                    . $reservation_id
                                );

                                exit();

                            } else {

                                $message =
                                    "Something went wrong while creating the reservation.";

                                $message_type = "danger";

                            }

                        }

                    }

                }

            }

        }

    }

}


// ========================================
// GET USER VEHICLES
// ========================================

$vehicles_sql = "
    SELECT
        vehicle_id,
        plate_number,
        model,
        color

    FROM vehicles

    WHERE resident_id = $resident_id

    ORDER BY vehicle_id ASC
";

$vehicles_result =
    mysqli_query($conn, $vehicles_sql);


// ========================================
// GET ZONES
// ========================================

$zones_sql = "
    SELECT
        zone_id,
        zone_name

    FROM parking_zones

    ORDER BY zone_id ASC
";$zones_result =
    mysqli_query($conn, $zones_sql);
    


// ========================================
// GET AVAILABLE SLOTS
// ========================================

$slots_sql = "
    SELECT
        slot_id,
        zone_id,
        slot_number

    FROM parking_slots

    WHERE status = 'available'

    ORDER BY slot_number ASC
";

$slots_result =
    mysqli_query($conn, $slots_sql);


// ========================================
// HTML
// ========================================

include "../includes/header.php";

include "../includes/navbar.php";

include "../includes/user-sidebar.php";

?>


<div class="container mt-4">


    <!-- PAGE HEADER -->

    <div class="card shadow-sm border-0">


        <div class="card-header bg-success text-white">

            <h4 class="mb-0">

                <i class="fa-solid fa-square-parking me-2"></i>

                Reserve Parking

            </h4>

        </div>


        <div class="card-body">


            <!-- MESSAGE -->

            <?php if (!empty($message)): ?>

                <div class="alert alert-<?= $message_type ?>">

                    <?= htmlspecialchars($message) ?>

                </div>

            <?php endif; ?>


            <form method="POST">


                <div class="row">


                    <!-- VEHICLE -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Select Vehicle

                        </label>


                        <select
                            class="form-select"
                            name="vehicle_id"
                            required
                        >

                            <option value="" selected disabled>

                                Choose Vehicle

                            </option>


                            <?php if (
                                $vehicles_result &&
                                mysqli_num_rows($vehicles_result) > 0
                            ): ?>


                                <?php while (
                                    $vehicle =
                                    mysqli_fetch_assoc($vehicles_result)
                                ): ?>


                                    <option
                                        value="<?= $vehicle["vehicle_id"] ?>"
                                    >

                                        <?= htmlspecialchars(
                                            $vehicle["model"]
                                        ) ?>

                                        -
                                        <?= htmlspecialchars(
                                            $vehicle["plate_number"]
                                        ) ?>

                                    </option>


                                <?php endwhile; ?>


                            <?php else: ?>


                                <option disabled>

                                    No vehicles found

                                </option>


                            <?php endif; ?>


                        </select>

                    </div>


                    <!-- ZONE -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Parking Zone

                        </label>


                        <select class="form-select" name="zone_id" id="zone" required>

    <option value="" selected disabled>
        Choose Zone
    </option>

    <?php
    $zone_query = mysqli_query(
        $conn,
        "SELECT zone_id, zone_name FROM parking_zones ORDER BY zone_id ASC"
    );

    while ($zone = mysqli_fetch_assoc($zone_query)):
    ?>

        <option value="<?= $zone['zone_id'] ?>">
            <?= htmlspecialchars($zone['zone_name']) ?>
        </option>

    <?php endwhile; ?>

</select>

                    </div>

                </div>


                <div class="row">


                    <!-- SLOT -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Parking Slot

                        </label>


                        <select
    class="form-select"
    name="slot_id"
    id="slot"
    required
>

    <option value="" selected disabled>
        Choose Slot
    </option>

    <?php if ($slots_result): ?>

        <?php while ($slot = mysqli_fetch_assoc($slots_result)): ?>

            <option
                value="<?= $slot['slot_id'] ?>"
                data-zone="<?= $slot['zone_id'] ?>"
            >

                <?= htmlspecialchars($slot['slot_number']) ?>

            </option>

        <?php endwhile; ?>

    <?php endif; ?>

</select> 

                    </div>


                    <!-- DATE -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Reservation Date

                        </label>


                        <input
                            type="date"
                            class="form-control"
                            name="date"
                            min="<?= date("Y-m-d") ?>"
                            required
                        >

                    </div>

                </div>


                <div class="row">


                    <!-- START -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Start Time

                        </label>


                        <input
                            type="time"
                            class="form-control"
                            name="start_time"
                            required
                        >

                    </div>


                    <!-- END -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            End Time

                        </label>


                        <input
                            type="time"
                            class="form-control"
                            name="end_time"
                            required
                        >

                    </div>

                </div>


                <!-- BUTTONS -->

                <div class="mt-4">


                    <button
                        type="submit"
                        class="btn btn-success"
                    >

                        <i class="fa-solid fa-check me-2"></i>

                        Confirm Reservation

                    </button>


                    <a
                        href="parking.php"
                        class="btn btn-secondary"
                    >

                        Cancel</a>


                </div>


            </form>

        </div>

    </div>

</div>


<script>

const zoneSelect = document.getElementById("zone");
const slotSelect = document.getElementById("slot");

zoneSelect.addEventListener("change", function () {

    const selectedZone = this.value;

    slotSelect.value = "";

    const slots = slotSelect.querySelectorAll("option");

    slots.forEach(function (slot) {

        if (slot.value === "") {
            slot.style.display = "";
            return;
        }

        if (slot.dataset.zone === selectedZone) {
            slot.style.display = "";
        } else {
            slot.style.display = "none";
        }

    });

});

</script>


<?php include "../includes/footer.php"; ?> 