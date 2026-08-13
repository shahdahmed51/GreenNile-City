<?php
require_once "../includes/user-auth.php";

// session_start();

$current_page = basename($_SERVER['PHP_SELF']);

require_once "../config/connection.php";

/* =========================
   Check Login
========================= */

if (
    !isset($_SESSION["user_id"]) ||
    !isset($_SESSION["resident_id"])
) {
    header("Location: login.php");
    exit();
}

$resident_id = $_SESSION["resident_id"];


/* =========================
   Get Request ID
========================= */

$requestId = $_GET["id"] ?? "";

if (!is_numeric($requestId) || empty($requestId)) {
    die("Invalid maintenance request.");
}


/* =========================
   Get Request
   Only for logged-in resident
========================= */

$sql = "SELECT
            mr.request_id,
            mr.title,
            mr.description,
            mr.priority,
            mr.status,
            mr.created_at,
            mr.assigned_to,

            r.full_name,
            r.phone,
            r.email,
            r.address,
            r.building,
            r.unit_number

        FROM maintenance_requests mr

        INNER JOIN residents r
            ON mr.resident_id = r.resident_id

        WHERE mr.request_id = ?
        AND mr.resident_id = ?

        LIMIT 1";


$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database Error: " . $conn->error);
}


$stmt->bind_param(
    "ii",
    $requestId,
    $resident_id
);

$stmt->execute();

$result = $stmt->get_result();


/* =========================
   Request Not Found
========================= */

if ($result->num_rows === 0) {
    die("Maintenance request not found.");
}


$request = $result->fetch_assoc();

$stmt->close();


/* =========================
   Prepare Display Values
========================= */

$requestCode =
    "MR" .
    str_pad(
        $request["request_id"],
        3,
        "0",
        STR_PAD_LEFT
    );


$date = date(
    "d M Y",
    strtotime($request["created_at"])
);

?>

<?php include("../includes/header.php"); ?>




<link
    rel="stylesheet"
    href="/GREENNILE-CITY/assets/css/maintenanceReq.css"
>


<div class="main-content-full">


    <!-- Page Header -->

    <div class="page-header">

        <a
            href="maintenance-user.php"
            class="back-btn"
        >

            <i class="bi bi-arrow-left"></i>

            Back to Maintenance Requests

        </a>


        <h2>
            Maintenance Request Details
        </h2>


        <p>
            View and track your maintenance request.
        </p>

    </div>



    <div class="details-container">


        <!-- =========================
             LEFT SIDE
        ========================== -->

        <div class="left-side">


            <div class="request-card">


                <div class="card-title">

                    <h3>
                        Request Information
                    </h3>

                </div>



                <div class="request-info">


                    <!-- Request ID -->

                    <div class="info-box">

                        <span>
                            Request ID
                        </span>

                        <p>
                            <?= htmlspecialchars($requestCode) ?>
                        </p>

                    </div>



                    <!-- Title -->

                    <div class="info-box">

                        <span>
                            Title
                        </span>

                        <p>
                            <?= htmlspecialchars($request["title"]) ?>
                        </p>

                    </div>



                    <!-- Resident -->

                    <div class="info-box">

                        <span>
                            Resident
                        </span>

                        <p>
                            <?= htmlspecialchars($request["full_name"]) ?>
                        </p>

                    </div>



                    <!-- Apartment -->

                    <div class="info-box">

                        <span>
                            Apartment
                        </span>

                        <p>
                            <?= htmlspecialchars($request["building"]) ?>
                            -
                            <?= htmlspecialchars($request["unit_number"]) ?>
                        </p>

                    </div>



                    <!-- Priority -->

                    <div class="info-box">

                        <span>
                            Priority
                        </span>

                        <span
                            class="priority <?= strtolower($request["priority"]) ?>"
                        >

                            <?= htmlspecialchars($request["priority"]) ?>

                        </span>

                    </div>



                    <!-- Status -->

                    <div class="info-box">

                        <span>
                            Status
                        </span>

                        <span
                            class="status <?= strtolower(
                                str_replace(
                                    " ",
                                    "-",
                                    $request["status"]
                                )
                            ) ?>"
                        >

                            <?= htmlspecialchars($request["status"]) ?>

                        </span>

                    </div>



                    <!-- Date -->

                    <div class="info-box">

                        <span>
                            Date
                        </span>

                        <p>
                            <?= htmlspecialchars($date) ?>
                        </p>

                    </div>


                </div>



                <!-- =========================
                     Description
                ========================== -->

                <div class="description">

                    <h4>
                        Description
                    </h4>

                    <p>
                        <?= htmlspecialchars($request["description"]) ?>
                    </p>

                </div>


            </div>

        </div>



        <!-- =========================
             MIDDLE SIDE
        ========================== -->

        <div class="middle-side">


            <!-- Technician -->

            <div class="technician-card">


                <div class="card-title">

                    <h3>
                        Assigned Technician
                    </h3>

                </div>



                <div class="technician-info">


                    <div class="tech-avatar">

                        <i class="bi bi-person"></i>

                    </div>


                    <?php if (!empty($request["assigned_to"])): ?>

                        <h4>

                            <?= htmlspecialchars(
                                $request["assigned_to"]
                            ) ?>

                        </h4>


                        <p class="job-title">
                            Maintenance Technician
                        </p>


                        <div class="tech-details">

                            <div class="detail-row">

                                <i class="bi bi-person"></i>

                                <span>
                                    Assigned to your request
                                </span>

                            </div>

                        </div>


                    <?php else: ?>

                        <h4>
                            Not Assigned
                        </h4>


                        <p class="job-title">
                            Waiting for technician assignment
                        </p>

                    <?php endif; ?>


                </div>

            </div>



            <!-- =========================
                 Timeline
            ========================== -->

            <div class="timeline-card">


                <div class="card-title">

                    <h3>
                        Request Timeline
                    </h3>

                </div>



                <div class="timeline">


                    <!-- Submitted -->

                    <div class="timeline-item">

                        <div class="timeline-dot active"></div>

                        <div class="timeline-content">

                            <h5>
                                Request Submitted
                            </h5>

                            <small>
                                <?= htmlspecialchars($date) ?>
                            </small>

                        </div>

                    </div>



                    <!-- Technician Assigned -->

                    <div class="timeline-item">

                        <div
                            class="timeline-dot
                            <?= !empty($request["assigned_to"])
                                ? "active"
                                : "" ?>"
                        ></div>

                        <div class="timeline-content">

                            <h5>
                                Technician Assigned
                            </h5>

                            <small>

                                <?php if (!empty($request["assigned_to"])): ?>

                                    <?= htmlspecialchars(
                                        $request["assigned_to"]
                                    ) ?>

                                    assigned to this request.

                                <?php else: ?>

                                    Waiting for technician assignment.

                                <?php endif; ?>

                            </small>

                        </div>

                    </div>



                    <!-- Current Status -->

                    <div class="timeline-item">

                        <div class="timeline-dot active"></div>

                        <div class="timeline-content">

                            <h5>
                                <?= htmlspecialchars(
                                    $request["status"]
                                ) ?>
                            </h5>

                            <small>
                                Current request status
                            </small>

                        </div>

                    </div>


                </div>

            </div>


        </div>


    </div>

</div>


<?php include("../includes/footer.php"); ?>