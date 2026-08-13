<?php

require_once "../config/connection.php";

$requestId = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$requestId || !is_numeric($requestId)) {
    die("Invalid maintenance request ID.");
}


/* =========================
   Get Request Information
========================= */

$sql = "SELECT
            request_id,
            title,
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
   Delete Request
========================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $deleteSql = "DELETE FROM maintenance_requests
                  WHERE request_id = ?";

    $deleteStmt = $conn->prepare($deleteSql);

    if (!$deleteStmt) {
        die("Database Error: " . $conn->error);
    }

    $deleteStmt->bind_param("i", $requestId);

    if ($deleteStmt->execute()) {

        $deleteStmt->close();

        header("Location: maintenance.php");
        exit;

    } else {

        $error = "Failed to delete request: " . $deleteStmt->error;

        $deleteStmt->close();
    }
}


include("../includes/header.php");
include("../includes/sidebar.php");

?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/delete-resident.css">


<div class="delete-container">

    <div class="delete-card">


        <div class="delete-header">

            <i class="bi bi-trash"></i>

            <h2>Delete Request</h2>

        </div>


        <div class="delete-content">


            <i class="bi bi-exclamation-triangle warning-icon"></i>


            <h3>
                Are you sure you want to delete this Request?
            </h3>


            <?php if (!empty($error)): ?>

                <p style="color: #dc3545; margin-bottom: 15px;">
                    <?= htmlspecialchars($error) ?>
                </p>

            <?php endif; ?>


            <p class="resident-details">

                Request:
                <strong>
                    #<?= htmlspecialchars($request['request_id']) ?>
                </strong>

                <br>

                Title:
                <strong>
                    <?= htmlspecialchars($request['title']) ?>
                </strong>

                <br>

                Assigned:
                <strong>
                    <?= !empty($request['assigned_to'])
                        ? htmlspecialchars($request['assigned_to'])
                        : '-'
                    ?>
                </strong>

            </p>


            <div class="delete-actions">


                <form action="" method="POST">

                    <input
                        type="hidden"
                        name="id"
                        value="<?= htmlspecialchars($requestId) ?>"
                    >


                    <button
                        type="submit"
                        class="delete-confirm-btn"
                    >

                        <i class="bi bi-trash"></i>

                        Delete

                    </button>

                </form>


                <a
                    href="maintenance.php"
                    class="cancel-delete-btn"
                >

                    Cancel

                </a>


            </div>


        </div>

    </div>

</div>


<?php include("../includes/footer.php"); ?>