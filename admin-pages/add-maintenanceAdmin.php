
<?php
require_once "../includes/admin-auth.php";
?><?php

require_once "../config/connection.php";

$error = "";


/* =========================
   Get Residents
========================= */

$residents_sql = "SELECT resident_id, full_name, building, unit_number
                  FROM residents
                  ORDER BY full_name ASC";

$residents_result = $conn->query($residents_sql);

if (!$residents_result) {
    die("Database Error: " . $conn->error);
}


/* =========================
   Handle Form Submit
========================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $resident_id = $_POST["resident_id"] ?? "";
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $priority = $_POST["priority"] ?? "";
    $assigned_to = trim($_POST["technician"] ?? "");


    /* Validation */

    if (
        empty($resident_id) ||
        empty($title) ||
        empty($description) ||
        empty($priority)
    ) {

        $error = "Please fill in all required fields.";

    } else {

        $status = "Pending";


        /* Insert Request */

        $sql = "INSERT INTO maintenance_requests
                (
                    resident_id,
                    title,
                    description,
                    priority,
                    status,
                    created_at,
                    assigned_to
                )
                VALUES (?, ?, ?, ?, ?, NOW(), ?)";


        $stmt = $conn->prepare($sql);


        if (!$stmt) {

            $error = "Database Error: " . $conn->error;

        } else {

            $stmt->bind_param(
                "isssss",
                $resident_id,
                $title,
                $description,
                $priority,
                $status,
                $assigned_to
            );


            if ($stmt->execute()) {

                header("Location: maintenance.php");
                exit;

            } else {

                $error = "Failed to create request: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}


/* =========================
   Header / Sidebar
========================= */

$current_page = basename($_SERVER['PHP_SELF']);

include("../includes/header.php");
include("../includes/sidebar.php");

?>

<link rel="stylesheet" href="/GreenNile-City/assets/css/add-maintenance.css">


<div class="main-content">

    <div class="page-header">

        <h2>New Maintenance Request</h2>

        <p>Create a new maintenance request.</p>

    </div>


    <?php if (!empty($error)): ?>

        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>

    <?php endif; ?>


    <div class="maintenance-form-card">

        <form action="" method="POST">


            <!-- =========================
                 Resident Information
            ========================== -->

            <div class="form-section">

                <h3>Resident Information</h3>


                <div class="form-row">


                    <!-- Resident -->

                    <div class="form-group">

                        <label for="resident">
                            Resident
                        </label>


                        <select
                            name="resident_id"
                            id="resident"
                            required
                        >

                            <option value="">
                                Select Resident
                            </option>


                            <?php while ($resident = $residents_result->fetch_assoc()): ?>

                                <option
                                    value="<?= htmlspecialchars($resident['resident_id']) ?>"
                                    data-building="<?= htmlspecialchars($resident['building']) ?>"
                                    data-unit="<?= htmlspecialchars($resident['unit_number']) ?>"
                                >

                                    <?= htmlspecialchars($resident['full_name']) ?>

                                </option>

                            <?php endwhile; ?>


                        </select>

                    </div>


                    <!-- Apartment -->

                    <div class="form-group">

                        <label for="apartment">
                            Apartment
                        </label>


                        <input
                            type="text"
                            id="apartment"
                            placeholder="Building / Unit"
                            readonly
                        >

                    </div>


                </div>

            </div>



            <!-- =========================
                 Request Information
            ========================== -->

            <div class="form-section">

                <h3>Request Information</h3>


                <!-- Title -->

                <div class="form-group">

                    <label for="title">
                        Request Title
                    </label>


                    <input
                        type="text"
                        name="title"
                        id="title"
                        placeholder="Enter request title"
                        required
                    >

                </div>



                <div class="form-row">
                    <!-- Priority -->

                    <div class="form-group">

                        <label for="priority">
                            Priority
                        </label>


                        <select
                            name="priority"
                            id="priority"
                            required
                        >

                            <option value="">
                                Select Priority
                            </option>

                            <option value="Low">
                                Low
                            </option>

                            <option value="Medium">
                                Medium
                            </option>

                            <option value="High">
                                High
                            </option>

                        </select>

                    </div>


                </div>



                <!-- Technician -->

                <div class="form-group">

                    <label for="technician">
                        Assign Technician
                    </label>


                    <select
                        name="technician"
                        id="technician"
                    >

                        <option value="">
                            Select Technician
                        </option>

                        <option value="Ahmed Hassen">
                            Ahmed Hassen
                        </option>

                        <option value="Habiba Emad">
                            Habiba Emad
                        </option>

                        <option value="Karim Ahmed">
                            Karim Ahmed
                        </option>

                    </select>

                </div>



                <!-- Description -->

                <div class="form-group">

                    <label for="description">
                        Description
                    </label>


                    <textarea
                        name="description"
                        id="description"
                        rows="6"
                        placeholder="Describe the maintenance problem..."
                        required
                    ></textarea>

                </div>



                <!-- Image -->

                <div class="form-group">

                    <label for="image">
                        Request Image
                    </label>


                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/*"
                    >

                </div>


            </div>



            <!-- =========================
                 Buttons
            ========================== -->

            <div class="form-actions">

                <a
                    href="maintenance.php"
                    class="cancel-btn"
                >
                    Cancel
                </a>


                <button
                    type="submit"
                    name="submit"
                    class="submit-btn"
                >

                    <i class="bi bi-check-lg"></i>

                    Create Request

                </button>

            </div>


        </form>

    </div>

</div>



<!-- =========================
     Resident → Apartment
========================== -->

<script>

const residentSelect = document.getElementById("resident");

const apartmentInput = document.getElementById("apartment");


residentSelect.addEventListener("change", function () {

    const selectedOption =
        this.options[this.selectedIndex];


    const building =
        selectedOption.dataset.building || "";


    const unit =
        selectedOption.dataset.unit || "";


    if (building || unit) {

        apartmentInput.value =
            building + " - " + unit;

    } else {

        apartmentInput.value = "";

    }

});

</script>


<?php include("../includes/footer.php"); ?>