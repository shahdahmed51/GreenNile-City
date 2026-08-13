<?php
require_once "../includes/admin-auth.php";
?>
<?php

require_once "../config/connection.php";

$current_page = basename($_SERVER['PHP_SELF']);


/* =========================
   Get Request ID
========================= */

$requestId = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$requestId || !is_numeric($requestId)) {
    die("Invalid maintenance request ID.");
}


/* =========================
   Get Request
========================= */

$sql = "SELECT
            request_id,
            title,
            description,
            priority,
            status,
            assigned_to
        FROM maintenance_requests
        WHERE request_id = ?";

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
   Update Request
========================= */

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $priority = $_POST["priority"] ?? "";
    $status = $_POST["status"] ?? "";
    $assigned_to = trim($_POST["assigned_to"] ?? "");


    /* Validation */

    if (
        empty($title) ||
        empty($description) ||
        empty($priority) ||
        empty($status)
    ) {

        $error = "Please fill in all required fields.";

    } else {

        $updateSql = "UPDATE maintenance_requests
                      SET
                          title = ?,
                          description = ?,
                          priority = ?,
                          status = ?,
                          assigned_to = ?
                      WHERE request_id = ?";

        $updateStmt = $conn->prepare($updateSql);

        if (!$updateStmt) {

            $error = "Database Error: " . $conn->error;

        } else {

            $updateStmt->bind_param(
                "sssssi",
                $title,
                $description,
                $priority,
                $status,
                $assigned_to,
                $requestId
            );


            if ($updateStmt->execute()) {

                $updateStmt->close();

                header(
                    "Location: maintenanceReq.php?id=" . $requestId
                );

                exit;

            } else {

                $error = "Failed to update request: "
                       . $updateStmt->error;

                $updateStmt->close();
            }
        }
    }
}


/* =========================
   Header / Sidebar
========================= */

include("../includes/header.php");
include("../includes/sidebar.php");

?>

<link
    rel="stylesheet"
    href="/GreenNile-City/assets/css/edit-maintenance.css"
>


<div class="edit-main">


    <!-- =========================
         Page Header
    ========================== -->

    <div class="edit-page-header">

        <h2>
            Edit Maintenance Request
        </h2>

        <p>
            Update maintenance request information.
        </p>

        <a
            href="maintenanceReq.php?id=<?= urlencode($requestId) ?>"
            class="edit-back-btn"
        >

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>



    <!-- =========================
         Error Message
    ========================== -->

    <?php if (!empty($error)): ?>

        <div class="edit-error">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>



    <!-- =========================
         Edit Card
    ========================== -->

    <div class="edit-card">


        <div class="edit-card-header">

            <h3>

                Edit Request
                #<?= htmlspecialchars($request['request_id']) ?>

            </h3>

        </div>



        <form
            action=""
            method="POST"
            class="edit-form"
        >

            <input
                type="hidden"
                name="id"
                value="<?= htmlspecialchars($requestId) ?>"
            >


            <!-- =========================
                 Request Title
            ========================== -->

            <div class="edit-form-group">

                <label for="title">
                    Request Title
                </label>

                <input
                    type="text"
                    name="title"
                    id="title"
                    class="edit-input"
                    value="<?= htmlspecialchars($request['title']) ?>"
                    required
                >

            </div>



            <!-- =========================
                 Priority
            ========================== -->

            <div class="edit-form-group">

                <label for="priority">
                    Priority
                </label>

                <select
                    name="priority"
                    id="priority"
                    class="edit-input"
                    required
                >

                    <option value="Low"
                        <?= $request['priority'] === 'Low'
                            ? 'selected'
                            : '' ?>>
                        Low
                    </option>

                    <option value="Medium"
                        <?= $request['priority'] === 'Medium'
                            ? 'selected'
                            : '' ?>>
                        Medium
                    </option>

                    <option value="High"
                        <?= $request['priority'] === 'High'
                            ? 'selected'
                            : '' ?>>
                        High
                    </option>

                </select>

            </div>



            <!-- =========================
                 Status
            ========================== -->

            <div class="edit-form-group">

                <label for="status">
                    Status
                </label>

                <select
                    name="status"
                    id="status"
                    class="edit-input"
                    required
                >

                    <option value="Pending"
                        <?= $request['status'] === 'Pending'
                            ? 'selected'
                            : '' ?>>
                        Pending
                    </option>

                    <option value="In Progress"
                        <?= $request['status'] === 'In Progress'
                            ? 'selected'
                            : '' ?>>
                        In Progress
                    </option>

                    <option value="Completed"
                        <?= $request['status'] === 'Completed'
                            ? 'selected'
                            : '' ?>>
                        Completed
                    </option>

                </select>

            </div>



            <!-- =========================
                 Assigned Technician
            ========================== -->

            <div class="edit-form-group">

                <label for="assigned_to">
                    Assigned Technician
                </label>

                <select
                    name="assigned_to"
                    id="assigned_to"
                    class="edit-input"
                >

                    <option value="">
                        Not Assigned
                    </option>

                    <option value="Ahmed Hassen"
                        <?= $request['assigned_to'] === 'Ahmed Hassen'
                            ? 'selected'
                            : '' ?>>
                        Ahmed Hassen
                    </option>

                    <option value="Habiba Emad"
                        <?= $request['assigned_to'] === 'Habiba Emad'
                            ? 'selected'
                            : '' ?>>
                        Habiba Emad
                    </option>

                    <option value="Karim Ahmed"
                        <?= $request['assigned_to'] === 'Karim Ahmed'
                            ? 'selected'
                            : '' ?>>
                        Karim Ahmed
                    </option>

                </select>

            </div>



            <!-- =========================
                 Description
            ========================== -->

            <div class="edit-form-group">

                <label for="description">
                    Description
                </label>

                <textarea
                    name="description"
                    id="description"
                    class="edit-input edit-textarea"
                    rows="6"
                    required
                ><?= htmlspecialchars($request['description']) ?></textarea>

            </div>



            <!-- =========================
                 Buttons
            ========================== -->

            <div class="edit-actions">

                <a
                    href="maintenanceReq.php?id=<?= urlencode($requestId) ?>"
                    class="edit-cancel-btn"
                >

                    Cancel

                </a>


                <button
                    type="submit"
                    class="edit-save-btn"
                >

                    <i class="bi bi-check-lg"></i>

                    Save Changes

                </button>

            </div>


        </form>

    </div>

</div>


<?php include("../includes/footer.php"); ?>