<?php

require_once "../config/connection.php";


// Get resident ID from URL
$residentId = $_GET['id'] ?? null;

if (!$residentId || !is_numeric($residentId)) {
    die("Invalid resident ID.");
}


// Get resident from database

$sql = "SELECT
            resident_id,
            full_name,
            phone,
            email,
            address,
            building,
            unit_number,
            created_at
        FROM residents
        WHERE resident_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Query failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $residentId
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$resident = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Check resident exists

if (!$resident) {
    die("Resident not found.");
}


// Initials for avatar

$nameParts = explode(
    " ",
    trim($resident['full_name'])
);

$initials = "";

foreach ($nameParts as $part) {

    if ($part !== "") {

        $initials .= strtoupper(
            substr($part, 0, 1)
        );

    }

    if (strlen($initials) >= 2) {
        break;
    }
}

?>


<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<div class="main-content">

    <div class="container-fluid py-4">


        <!-- Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Resident Details
                </h2>

                <p class="text-muted">
                    View resident information
                </p>

            </div>


            <a
                href="resident.php"
                class="btn btn-outline-secondary"
            >

                <i class="bi bi-arrow-left"></i>

                Back to Residents

            </a>

        </div>



        <!-- Resident Card -->

        <div class="card shadow-sm border-0 resident-card">

            <div class="card-body p-4">


                <!-- Profile -->

                <div class="profile-section">


                    <div class="resident-avatar">

                        <?= htmlspecialchars($initials) ?>

                    </div>


                    <div>

                        <h3 class="fw-bold mb-1">

                            <?= htmlspecialchars(
                                $resident['full_name']
                            ) ?>

                        </h3>


                        <p class="text-muted mb-2">

                            Apartment
                            <?= htmlspecialchars(
                                $resident['unit_number']
                            ) ?>

                        </p>

                    </div>


                </div>


                <hr class="my-4">



                <!-- Personal Information -->

                <h5 class="fw-bold mb-3">

                    Personal Information

                </h5>


                <div class="row">


                    <!-- Full Name -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Full Name
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $resident['full_name']
                                ) ?>

                            </strong>

                        </div>

                    </div>



                    <!-- Email -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Email
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $resident['email']
                                ) ?>

                            </strong>

                        </div>

                    </div>



                    <!-- Phone -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Phone Number
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $resident['phone']
                                ) ?>

                            </strong>

                        </div>

                    </div>



                    <!-- Apartment -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Apartment
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $resident['unit_number']
                                ) ?>

                            </strong>

                        </div>

                    </div>



                    <!-- Building -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Building
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $resident['building']
                                ) ?>

                            </strong>

                        </div>

                    </div>



                    <!-- Address -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Address
                            </span>

                            <strong>

                                <?= htmlspecialchars(
                                    $resident['address']
                                ) ?>

                            </strong>

                        </div>

                    </div>



                    <!-- Created At -->

                    <div class="col-md-6 mb-3">

                        <div class="info-box">

                            <span>
                                Created At
                            </span>

                            <strong>

                                <?= date(
                                    'd F Y',
                                    strtotime(
                                        $resident['created_at']
                                    )
                                ) ?>

                            </strong>

                        </div>

                    </div>


                </div>



                <hr class="my-4">



                <!-- Actions -->

                <div class="actions mt-4">


                    <!-- Edit -->

                    <a
                        href="edit-resident.php?id=<?= $resident['resident_id'] ?>"
                        class="btn btn-success"
                    >

                        <i class="bi bi-pencil"></i>

                        Edit Resident

                    </a>



                    <!-- Billing -->

                    <a
                        href="billing.php"
                        class="btn btn-outline-success"
                    >

                        <i class="bi bi-receipt"></i>

                        View Billing

                    </a>



                    <!-- Delete -->

                    <a
                        href="delete-Resident.php?id=<?= $resident['resident_id'] ?>"
                        class="btn btn-danger"
                    >

                        <i class="bi bi-trash"></i>

                        Delete Resident

                    </a>


                </div>


            </div>

        </div>


    </div>

</div>



<?php include '../includes/footer.php'; ?>