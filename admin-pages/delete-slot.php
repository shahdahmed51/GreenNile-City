<?php
require_once "../includes/admin-auth.php";
?>
<?php

include "../config/connection.php";


// =====================================
// GET SLOT ID
// =====================================

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {

    header("Location: parking.php");
    exit;

}

$slot_id = intval($_GET['id']);


// =====================================
// GET SLOT DATA
// =====================================

$result = mysqli_query($conn, "
    SELECT slot_id, slot_number
    FROM parking_slots
    WHERE slot_id = $slot_id
");


if (mysqli_num_rows($result) == 0) {

    header("Location: parking.php");
    exit;

}


$slot = mysqli_fetch_assoc($result);


// =====================================
// DELETE SLOT
// =====================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $delete = mysqli_query($conn, "
        DELETE FROM parking_slots
        WHERE slot_id = $slot_id
    ");


    if ($delete) {

        header("Location: parking.php");
        exit;

    } else {

        $error = mysqli_error($conn);

    }

}

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm border-0">


                <!-- Header -->

                <div class="card-header bg-danger text-white">

                    <h4 class="mb-0">

                        <i class="fa-solid fa-trash me-2"></i>

                        Delete Parking Slot

                    </h4>

                </div>


                <div class="card-body text-center">


                    <?php if (isset($error)): ?>

                        <div class="alert alert-danger">

                            <?= htmlspecialchars($error) ?>

                        </div>

                    <?php endif; ?>


                    <i
                        class="fa-solid fa-triangle-exclamation text-danger mb-3"
                        style="font-size:70px;">
                    </i>


                    <h5 class="mb-3">

                        Are you sure you want to delete
                        this parking slot?

                    </h5>


                    <p class="text-muted">

                        Slot Number:

                        <strong>
                            <?= htmlspecialchars($slot['slot_number']) ?>
                        </strong>

                    </p>


                    <form action="" method="POST">


                        <button
                            type="submit"
                            class="btn btn-danger">

                            <i class="fa-solid fa-trash me-2"></i>

                            Delete

                        </button>


                        <a
                            href="parking.php"
                            class="btn btn-secondary">

                            Cancel

                        </a>


                    </form>


                </div>

            </div>

        </div>

    </div>

</div>


<?php include '../includes/footer.php'; ?>