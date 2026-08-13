<?php

require_once "../config/connection.php";

$current_page = basename($_SERVER['PHP_SELF']);


/* =========================
   Get Request ID
========================= */

$requestId = $_GET['id'] ?? null;

if (!$requestId) {
    die("Maintenance request ID is missing.");
}


/* =========================
   Get Request + Resident
========================= */

$sql = "SELECT
            mr.request_id,
            mr.resident_id,
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

        LEFT JOIN residents r
            ON mr.resident_id = r.resident_id

        WHERE mr.request_id = ?";


$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Database Error: " . $conn->error);
}


$stmt->bind_param("i", $requestId);

$stmt->execute();

$result = $stmt->get_result();


if ($result->num_rows === 0) {
    die("Maintenance request not found.");
}


$request = $result->fetch_assoc();

$stmt->close();


/* =========================
   Header / Sidebar
========================= */

include("../includes/header.php");

?>

<link rel="stylesheet" href="/GreenNile-City/assets/css/maintenanceReq.css">


<div class="main-content-full">


    <!-- =========================
         Page Header
    ========================== -->

    <div class="page-header">

        <h2>Maintenance Request Details</h2>

        <p>
            View maintenance request information.
        </p>

        <a href="maintenance.php" class="back-btn">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>



    <!-- =========================
         Main Details Container
    ========================== -->

    <div class="details-container">


        <!-- =========================
             LEFT SIDE
        ========================== -->

        <div class="left-side">


            <!-- Request Card -->

            <div class="request-card">

                <div class="card-title">

                    <h3>
                        Request #<?= htmlspecialchars($request['request_id']) ?>
                    </h3>

                </div>


                <h3 style="margin-bottom: 25px;">

                    <?= htmlspecialchars($request['title']) ?>

                </h3>


                <!-- Request Info -->

                <div class="request-info">


                    <!-- Priority -->

                    <div class="info-box">

                        <span>Priority</span>

                        <span
                            class="priority <?= strtolower(
                                htmlspecialchars($request['priority'])
                            ) ?>"
                        >

                            <?= htmlspecialchars($request['priority']) ?>

                        </span>

                    </div>


                    <!-- Status -->

                    <div class="info-box">

                        <span>Status</span>

                        <span
                            class="status <?= strtolower(
                                str_replace(
                                    ' ',
                                    '-',
                                    htmlspecialchars($request['status'])
                                )
                            ) ?>"
                        >

                            <?= htmlspecialchars($request['status']) ?>

                        </span>

                    </div>


                    <!-- Created Date -->

                    <div class="info-box">

                        <span>Created Date</span>

                        <p>

                            <?= htmlspecialchars(
                                $request['created_at']
                            ) ?>

                        </p>

                    </div>


                    <!-- Assigned To -->

                    <div class="info-box">

                        <span>Assigned To</span>

                        <p>

                            <?= !empty($request['assigned_to'])
                                ? htmlspecialchars($request['assigned_to'])
                                : '-'
                            ?>

                        </p>

                    </div>


                </div>


                <!-- Description -->

                <div class="description">

                    <h4>
                        Description
                    </h4>

                    <p>

                        <?= nl2br(
                            htmlspecialchars(
                                $request['description']
                            )
                        ) ?>

                    </p>

                </div>

            </div>



            <!-- Update Card -->

            <div class="update-card">

                <div class="card-title">

                    <h3>
                        Request Information
                    </h3>

                </div>


                <div class="request-info">


                    <div class="info-box">

                        <span>Request ID</span>

                        <p>
                            #<?= htmlspecialchars(
                                $request['request_id']
                            ) ?>
                        </p>

                    </div>


                    <div class="info-box">

                        <span>Resident ID</span>

                        <p>
                            <?= htmlspecialchars(
                                $request['resident_id']
                            ) ?>
                        </p>

                    </div>


                    <div class="info-box">

                        <span>Category</span>

                        <p>-</p>

                    </div>


                    <div class="info-box">

                        <span>Apartment</span>

                        <p>

                            <?php

                            $building = $request['building'] ?? '';
                            $unit = $request['unit_number'] ?? '';

                            if ($building || $unit) {

                                echo htmlspecialchars(
                                    $building . " - " . $unit
                                );

                            } else {

                                echo "-";

                            }

                            ?>

                        </p>

                    </div>


                </div>

            </div>


        </div>



        <!-- =========================
             MIDDLE SIDE
        ========================== -->

        <div class="middle-side">


            <div class="card-title">

                <h3>
                    Resident Information
                </h3>

            </div>


            <div class="technician-info">


                <div class="tech-avatar">

                    <i class="bi bi-person"></i>

                </div>


                <h4>

                    <?= !empty($request['full_name'])
                        ? htmlspecialchars($request['full_name'])
                        : '-'
                    ?>

                </h4>


                <p class="job-title">
                    Resident
                </p>


                <div class="tech-details">


                    <div class="detail-row">

                        <i class="bi bi-telephone"></i>

                        <span>

                            <?= !empty($request['phone'])
                                ? htmlspecialchars($request['phone'])
                                : '-'
                            ?>

                        </span>

                    </div>


                    <div class="detail-row">

                        <i class="bi bi-envelope"></i>

                        <span>

                            <?= !empty($request['email'])
                                ? htmlspecialchars($request['email'])
                                : '-'
                            ?>

                        </span>

                    </div>


                    <div class="detail-row">

                        <i class="bi bi-building"></i>

                        <span>

                            <?php

                            if ($building || $unit) {

                                echo "Building "
                                    . htmlspecialchars($building)
                                    . " - "
                                    . htmlspecialchars($unit);

                            } else {

                                echo "-";

                            }

                            ?>

                        </span>

                    </div>


                    <div class="detail-row">

                        <i class="bi bi-geo-alt"></i>

                        <span>

                            <?= !empty($request['address'])
                                ? htmlspecialchars($request['address'])
                                : '-'
                            ?>

                        </span>

                    </div>


                </div>


            </div>


        </div>



        <!-- =========================
             RIGHT SIDE
        ========================== -->

        <div class="right-side">


            <!-- Technician Card -->

            <div class="middle-side technician-card">

                <div class="card-title">

                    <h3>
                        Assigned Technician
                    </h3>

                </div>


                <div class="technician-info">


                    <div class="tech-avatar">

                        <i class="bi bi-person-gear"></i>

                    </div>


                    <h4>

                        <?= !empty($request['assigned_to'])
                            ? htmlspecialchars($request['assigned_to'])
                            : 'Not Assigned'
                        ?>

                    </h4>


                    <p class="job-title">
                        Maintenance Technician
                    </p>


                </div>

            </div>



            <!-- Timeline -->

            <div class="middle-side timeline-card">

                <div class="card-title">

                    <h3>
                        Request Timeline
                    </h3>

                </div>


                <div class="timeline">


                    <div class="timeline-item">

                        <div class="timeline-dot active"></div>


                        <div class="timeline-content">

                            <h5>
                                Request Created
                            </h5>

                            <small>

                                <?= htmlspecialchars(
                                    $request['created_at']
                                ) ?>

                            </small>

                        </div>

                    </div>


                    <div class="timeline-item">

                        <div class="timeline-dot
                            <?= strtolower($request['status']) !== 'pending'
                                ? 'active'
                                : ''
                            ?>">
                        </div>


                        <div class="timeline-content">

                            <h5>
                                <?= htmlspecialchars(
                                    $request['status']
                                ) ?>
                            </h5>

                            <small>
                                Current Status
                            </small>

                        </div>

                    </div>


                </div>

            </div>


        </div>


    </div>


</div>


<?php include("../includes/footer.php"); ?>