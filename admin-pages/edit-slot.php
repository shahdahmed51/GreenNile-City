<?php
require_once "../includes/admin-auth.php";
?>
<?php

include "../config/connection.php";

$error = "";


// ===============================
// GET SLOT ID
// ===============================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: parking.php");
    exit;

}

$slot_id = intval($_GET['id']);


// ===============================
// GET CURRENT SLOT
// ===============================

$result = mysqli_query($conn, "
    SELECT slot_id, zone_id, slot_number, status
    FROM parking_slots
    WHERE slot_id = $slot_id
");

if (mysqli_num_rows($result) == 0) {

    header("Location: parking.php");
    exit;

}

$slot = mysqli_fetch_assoc($result);


// ===============================
// UPDATE SLOT
// ===============================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $zone_id = intval($_POST['zone_id']);
    $slot_number = trim($_POST['slot_number']);
    $status = $_POST['status'];


    if ($zone_id <= 0 || empty($slot_number) || empty($status)) {

        $error = "Please fill in all fields.";

    } else {


        // Check duplicate slot number

        $check = mysqli_query($conn, "
            SELECT slot_id
            FROM parking_slots
            WHERE slot_number = '$slot_number'
            AND slot_id != $slot_id
        ");


        if (mysqli_num_rows($check) > 0) {

            $error = "This slot number already exists.";

        } else {


            // Update

            $sql = "
                UPDATE parking_slots
                SET
                    zone_id = '$zone_id',
                    slot_number = '$slot_number',
                    status = '$status'
                WHERE slot_id = $slot_id
            ";


            if (mysqli_query($conn, $sql)) {

                header("Location: parking.php");
                exit;

            } else {

                $error = mysqli_error($conn);

            }

        }

    }

}


// ===============================
// GET PARKING ZONES
// ===============================

$zones = mysqli_query($conn, "
    SELECT zone_id, zone_name
    FROM parking_zones
    ORDER BY zone_id
");

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <h4 class="mb-0">

                <i class="fa-solid fa-pen-to-square me-2"></i>

                Edit Parking Slot

            </h4>

        </div>


        <div class="card-body">


            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>


            <form action="" method="POST">

                <div class="row">


                    <!-- Parking Zone -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Parking Zone
                        </label>


                        <select
                            class="form-select"
                            name="zone_id"
                            required>


                            <option value="" disabled>
                                Select Zone
                            </option>


                            <?php while ($zone = mysqli_fetch_assoc($zones)): ?>

                                <option
                                    value="<?= $zone['zone_id'] ?>"
                                    <?= ($zone['zone_id'] == $slot['zone_id'])
                                        ? 'selected'
                                        : '' ?>>

                                    <?= htmlspecialchars($zone['zone_name']) ?>

                                </option>

                            <?php endwhile; ?>


                        </select>

                    </div>



                    <!-- Slot Number -->

                    <div class="col-md-6 mb-3"><label class="form-label">
                            Slot Number
                        </label>


                        <input
                            type="text"
                            class="form-control"
                            name="slot_number"
                            value="<?= htmlspecialchars($slot['slot_number']) ?>"
                            required>

                    </div>

                </div>


                <div class="row">


                    <!-- Status -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>


                        <select
                            class="form-select"
                            name="status"
                            required>


                            <option
                                value="available"
                                <?= $slot['status'] == 'available'
                                    ? 'selected'
                                    : '' ?>>

                                Available

                            </option>


                            <option
                                value="occupied"
                                <?= $slot['status'] == 'occupied'
                                    ? 'selected'
                                    : '' ?>>

                                Occupied

                            </option>


                            <option
                                value="reserved"
                                <?= $slot['status'] == 'reserved'
                                    ? 'selected'
                                    : '' ?>>

                                Reserved

                            </option>


                        </select>

                    </div>

                </div>


                <div class="mt-4">


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="fa-solid fa-floppy-disk me-2"></i>

                        Update Slot

                    </button>


                    <a
                        href="parking.php"
                        class="btn btn-secondary">

                        Cancel

                    </a>


                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>