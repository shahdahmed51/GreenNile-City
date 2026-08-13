<?php

$current_page = basename($_SERVER['PHP_SELF']);

include '../config/connection.php';
include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';


if (isset($_GET['deleted']) && $_GET['deleted'] === 'success') {

    echo '
    <div class="container mt-3">

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fa-solid fa-circle-check me-2"></i>

            Reservation deleted successfully.

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    </div>
    ';

}



// =====================================
// PARKING STATISTICS
// =====================================

// Total Slots
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM parking_slots
");
if (!$result) {
    die("Query error (total slots): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$totalSlots = $row['total'];


// Available
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM parking_slots
    WHERE status = 'available'
");
if (!$result) {
    die("Query error (available slots): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$availableSlots = $row['total'];


// Occupied
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM parking_slots
    WHERE status = 'occupied'
");
if (!$result) {
    die("Query error (occupied slots): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$occupiedSlots = $row['total'];


// Reserved
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM parking_slots
    WHERE status = 'reserved'
");
if (!$result) {
    die("Query error (reserved slots): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$reservedSlots = $row['total'];


// Parking usage percentage
$parkingUsage = $totalSlots > 0
    ? round(($occupiedSlots / $totalSlots) * 100)
    : 0;


// =====================================
// PARKING SLOTS
// =====================================

// Only pick the most recent ACTIVE reservation per slot (status
// 'confirmed' or 'pending'). Completed reservations are excluded so a
// slot that's free again doesn't still show the old vehicle/resident.
$slots = mysqli_query($conn, "

    SELECT
        ps.slot_id,
        ps.slot_number,
        ps.zone_id,
        ps.status,

        v.plate_number,

        r.full_name

    FROM parking_slots ps

    LEFT JOIN parking_reservations res
        ON res.reservation_id = (
            SELECT MAX(r2.reservation_id)
            FROM parking_reservations r2
            WHERE r2.slot_id = ps.slot_id
            AND r2.status IN ('confirmed', 'pending')
        )

    LEFT JOIN vehicles v
        ON res.vehicle_id = v.vehicle_id

    LEFT JOIN residents r
        ON res.resident_id = r.resident_id

    ORDER BY ps.slot_id ASC

");
if (!$slots) {
    die("Query error (parking slots): " . mysqli_error($conn));
}


// =====================================
// RECENT RESERVATIONS
// =====================================

$recentReservations = mysqli_query($conn, "

    SELECT

        res.reservation_id,
        res.start_time,
        res.created_at,

        r.full_name,

        v.plate_number,

        ps.slot_number

    FROM parking_reservations res

    LEFT JOIN residents r
        ON res.resident_id = r.resident_id

    LEFT JOIN vehicles v
        ON res.vehicle_id = v.vehicle_id

    LEFT JOIN parking_slots ps
        ON res.slot_id = ps.slot_id

    ORDER BY res.created_at DESC

    LIMIT 5

");
if (!$recentReservations) {
    die("Query error (recent reservations): " . mysqli_error($conn));
}

?>

<div class="container mt-4">

    <!-- =====================================
         PAGE HEADER
    ====================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            Parking Management
        </h2>

    </div>


    <!-- =====================================
         STATISTICS
    ====================================== -->

    <div class="row">

        <!-- Total Slots -->

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Total Slots
                    </p>

                    <h3 class="fw-bold">
                        <?= $totalSlots ?>
                    </h3>

                </div>

            </div>

        </div>


        <!-- Available -->

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Available
                    </p>

                    <h3 class="text-success fw-bold">
                        <?= $availableSlots ?>
                    </h3>

                </div>

            </div>

        </div>


        <!-- Occupied -->

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Occupied
                    </p><h3 class="text-warning fw-bold">
                        <?= $occupiedSlots ?>
                    </h3>

                </div>

            </div>

        </div>


        <!-- Reserved -->

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <p class="text-muted mb-1">
                        Reserved
                    </p>

                    <h3 class="text-danger fw-bold">
                        <?= $reservedSlots ?>
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================
         PARKING USAGE + RECENT RESERVATIONS
    ====================================== -->

    <div class="row mt-3">


        <!-- Parking Usage -->

        <div class="col-md-7 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="mb-4">
                        Parking Usage
                    </h5>


                    <div class="row">


                        <!-- Circle -->

                        <div class="col-md-6">

                            <div class="d-flex justify-content-center align-items-center">

                                <div class="parking-circle">

                                    <div class="circle-content">

                                        <?= $parkingUsage ?>%

                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- Statistics -->

                        <div class="col-md-6 d-flex flex-column justify-content-center">


                            <div class="mb-3 d-flex align-items-center">

                                <span class="status-dot bg-success"></span>

                                <span class="ms-2">
                                    Available
                                </span>

                                <strong class="ms-auto">
                                    <?= $availableSlots ?>
                                </strong>

                            </div>


                            <div class="mb-3 d-flex align-items-center">

                                <span class="status-dot bg-warning"></span>

                                <span class="ms-2">
                                    Occupied
                                </span>

                                <strong class="ms-auto">
                                    <?= $occupiedSlots ?>
                                </strong>

                            </div>


                            <div class="d-flex align-items-center">

                                <span class="status-dot bg-danger"></span>

                                <span class="ms-2">
                                    Reserved
                                </span>

                                <strong class="ms-auto">
                                    <?= $reservedSlots ?>
                                </strong>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- =====================================
             RECENT RESERVATIONS
        ====================================== -->

        <div class="col-md-5 mb-4">

            <div class="card shadow-sm border-0 h-100">

                <div class="card-body">

                    <h5 class="mb-4">
                        Recent Reservations
                    </h5>


                    <?php if (mysqli_num_rows($recentReservations) > 0): ?>


                        <?php while ($reservation = mysqli_fetch_assoc($recentReservations)): ?>


                            <div class="reservation-item d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">


                                    <div class="reservation-icon">

                                        <i class="fa-solid fa-car"></i>

                                    </div>


                                    <div class="ms-3">

                                        <h6 class="mb-1">

                                            <?= htmlspecialchars(
                                                $reservation['full_name'] ?? '-'
                                            ) ?>

                                        </h6>


                                        <small class="text-muted">

                                            Slot
                                            <?= htmlspecialchars(
                                                $reservation['slot_number'] ?? '-'
                                            ) ?>

                                        </small>

                                    </div>


                                </div>


                                <small class="text-muted">

                                    <?= date(
                                        'h:i A',
                                        strtotime($reservation['start_time'])
                                    ) ?>

                                </small>


                            </div>


                            <hr>


                        <?php endwhile; ?>


                    <?php else: ?>


                        <p class="text-muted text-center">
                            No reservations yet.
                        </p>


                    <?php endif; ?>


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



    <!-- =====================================
         PARKING MANAGEMENT TABLE
    ====================================== -->

    <div class="row mt-3">

        <div class="col-md-12 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">


                    <!-- Header -->

                    <div class="d-flex justify-content-between align-items-center mb-4">

                        <h5 class="mb-0">
                            Parking Management
                        </h5>


                        <a href="add-slot.php"
                           class="btn btn-success">

                            <i class="fa-solid fa-plus"></i>

                            Add Slot

                        </a>

                    </div>



                    <!-- Table -->

                    <div class="table-responsive">

                        <table class="table table-hover align-middle">


                            <thead class="table-light">

                                <tr>

                                    <th>
                                        Slot ID
                                    </th>

                                    <th>
                                        Slot Number
                                    </th>

                                    <th>
                                        Zone
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th>
                                        Vehicle
                                    </th>

                                    <th>
                                        Resident
                                    </th>

                                    <th>
                                        Actions
                                        </th>

                                </tr>

                            </thead>



                            <tbody>


                                <?php while ($slot = mysqli_fetch_assoc($slots)): ?>


                                    <tr>


                                        <!-- Slot ID -->

                                        <td>

                                            <?= $slot['slot_id'] ?>

                                        </td>


                                        <!-- Slot Number -->

                                        <td>

                                            <?= htmlspecialchars(
                                                $slot['slot_number']
                                            ) ?>

                                        </td>


                                        <!-- Zone -->

                                        <td>

                                            Zone
                                            <?= htmlspecialchars(
                                                $slot['zone_id']
                                            ) ?>

                                        </td>


                                        <!-- Status -->

                                        <td>


                                            <?php if ($slot['status'] == 'available'): ?>


                                                <span class="badge bg-success">

                                                    Available

                                                </span>


                                            <?php elseif ($slot['status'] == 'occupied'): ?>


                                                <span class="badge bg-warning text-dark">

                                                    Occupied

                                                </span>


                                            <?php elseif ($slot['status'] == 'reserved'): ?>


                                                <span class="badge bg-danger">

                                                    Reserved

                                                </span>


                                            <?php else: ?>


                                                <span class="badge bg-secondary">

                                                    <?= htmlspecialchars(
                                                        $slot['status']
                                                    ) ?>

                                                </span>


                                            <?php endif; ?>


                                        </td>


                                        <!-- Vehicle -->

                                        <td>

                                            <?php if (!empty($slot['plate_number'])): ?>

                                                <?= htmlspecialchars(
                                                    $slot['plate_number']
                                                ) ?>

                                            <?php else: ?>

                                                -

                                            <?php endif; ?>

                                        </td>


                                        <!-- Resident -->

                                        <td>

                                            <?php if (!empty($slot['full_name'])): ?>

                                                <?= htmlspecialchars(
                                                    $slot['full_name']
                                                ) ?>

                                            <?php else: ?>

                                                -

                                            <?php endif; ?>

                                        </td>


                                        <!-- Actions -->

                                        <td><a href="edit-slot.php?id=<?= $slot['slot_id'] ?>"
                                               class="btn btn-sm btn-primary">

                                                <i class="fa-solid fa-pen"></i>

                                            </a>


                                            <a href="delete-slot.php?id=<?= $slot['slot_id'] ?>"
                                               class="btn btn-sm btn-danger">

                                                <i class="fa-solid fa-trash"></i>

                                            </a>


                                        </td>


                                    </tr>


                                <?php endwhile; ?>


                            </tbody>


                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<?php include '../includes/footer.php'; ?>