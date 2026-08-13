<?php
session_start();

$current_page = basename($_SERVER['PHP_SELF']);

include("../includes/header.php");
include("../includes/user-sidebar.php");
require_once "../config/connection.php";


/* =========================
   Check Login
========================= */

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["resident_id"])) {

    header("Location: login.php");
    exit();

}

$resident_id = $_SESSION["resident_id"];


/* =========================
   Get User Maintenance Requests
========================= */

$sql = "SELECT
            mr.request_id,
            mr.title,
            mr.priority,
            mr.status,
            mr.created_at,
            mr.assigned_to
        FROM maintenance_requests mr
        WHERE mr.resident_id = ?
        ORDER BY mr.created_at DESC";


$stmt = $conn->prepare($sql);

if (!$stmt) {

    die("Database Error: " . $conn->error);

}

$stmt->bind_param("i", $resident_id);

$stmt->execute();

$result = $stmt->get_result();

?>

<link
    rel="stylesheet"
    href="/GREENNILE-CITY/assets/css/maintenance.css"
>


<div class="main-content">


    <!-- =========================
         Page Header
    ========================== -->

    <div class="page-header">

        <h2>
            My Maintenance Requests
        </h2>

        <p>
            View and track your maintenance requests.
        </p>

    </div>



    <div class="maintenance-card">


        <!-- =========================
             Top Bar
        ========================== -->

        <!-- =========================
             Requests Table
        ========================== -->

        <table
            class="table table-hover align-middle text-center"
        >

            <thead>

                <tr>

                    <th>ID</th>

                    <th>Title</th>

                    <th>Priority</th>

                    <th>Status</th>

                    <th>Date</th>

                    <th>Assigned To</th>

                    <th>Action</th>

                </tr>

            </thead>


            <tbody>


            <?php if ($result->num_rows > 0): ?>


                <?php while ($request = $result->fetch_assoc()): ?>


                    <tr>


                        <!-- ID -->

                        <td>

                            MR<?= str_pad(
                                $request["request_id"],
                                3,
                                "0",
                                STR_PAD_LEFT
                            ) ?>

                        </td>



                        <!-- Title -->

                        <td>

                            <?= htmlspecialchars(
                                $request["title"]
                            ) ?>

                        </td>



                        <!-- Priority -->

                        <td>

                            <span
                                class="priority <?= strtolower(
                                    $request["priority"]
                                ) ?>"
                            >

                                <?= htmlspecialchars(
                                    $request["priority"]
                                ) ?>

                            </span>

                        </td>



                        <!-- Status -->

                        <td>

                            <span
                                class="status <?= strtolower(
                                    str_replace(
                                        " ",
                                        "-",
                                        $request["status"]
                                    )
                                ) ?>"
                            >

                                <?= htmlspecialchars(
                                    $request["status"]
                                ) ?>

                            </span>

                        </td>



                        <!-- Date -->

                        <td>

                            <?= date(
                                "d M Y",
                                strtotime(
                                    $request["created_at"]
                                )
                            ) ?>

                        </td>



                        <!-- Assigned -->

                        <td>

                            <?php if (!empty($request["assigned_to"])): ?>

                                <?= htmlspecialchars(
                                    $request["assigned_to"]
                                ) ?>

                            <?php else: ?>

                                <span style="color:#999;">
                                    Not Assigned
                                </span>

                            <?php endif; ?>

                        </td>



                        <!-- Action -->

                        <td>

                            <a
                                href="maintenanceReq-user.php?id=<?= $request["request_id"] ?>"
                                class="action-btn view"
                            >

                                <i class="bi bi-eye"></i>

                            </a>

                        </td>


                    </tr>


                <?php endwhile; ?>


            <?php else: ?>


                <tr>

                    <td
                        colspan="7"
                        style="padding:40px; color:#777;"
                    >

                        <i
                            class="bi bi-tools"
                            style="font-size:30px;"
                        ></i>

                        <br><br>

                        You don't have any maintenance requests yet.

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>

        </table>


    </div>

</div>


<script src="/GREENNILE-CITY/assets/js/maintenance.js"></script>


<?php

$stmt->close();

include("../includes/footer.php");

?>