<?php

require_once "../config/connection.php";


// =====================================
// Add Resident
// =====================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $fullName   = trim($_POST["full_name"] ?? "");
    $phone      = trim($_POST["phone"] ?? "");
    $email      = trim($_POST["email"] ?? "");
    $address    = trim($_POST["address"] ?? "");
    $building   = trim($_POST["building"] ?? "");
    $unitNumber = trim($_POST["unit_number"] ?? "");


    // Validation

    if (
        empty($fullName) ||
        empty($phone) ||
        empty($email) ||
        empty($address) ||
        empty($building) ||
        empty($unitNumber)
    ) {

        $error = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    } else {


        // =====================================
        // Insert Resident
        // =====================================

        $sql = "INSERT INTO residents
                (
                    full_name,
                    phone,
                    email,
                    address,
                    building,
                    unit_number
                )
                VALUES (?, ?, ?, ?, ?, ?)";


        $stmt = mysqli_prepare($conn, $sql);


        if (!$stmt) {

            $error = "Failed to prepare query: "
                   . mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param(
                $stmt,
                "ssssss",
                $fullName,
                $phone,
                $email,
                $address,
                $building,
                $unitNumber
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                // Go back to residents page
                header("Location: resident.php");

                exit;

            } else {

                $error = "Failed to add resident: "
                       . mysqli_stmt_error($stmt);

                mysqli_stmt_close($stmt);

            }

        }

    }

}

?>


<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar.php"); ?>


<div class="main-content">

    <div class="page-header">

        <div>

            <h1>
                Add Resident
            </h1>

            <p>
                Add a new resident to the system
            </p>

        </div>

    </div>



    <!-- Error Message -->

    <?php if (isset($error)): ?>

        <div class="alert alert-danger">

            <?= htmlspecialchars($error) ?>

        </div>

    <?php endif; ?>



    <div class="resident-form-card">

        <form action="" method="POST">


            <!-- Full Name + Apartment -->

            <div class="form-row">

                <div class="form-group">

                    <label for="name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="full_name"
                        placeholder="Enter Full Name"
                        value="<?= isset($_POST['full_name'])
                            ? htmlspecialchars($_POST['full_name'])
                            : ''
                        ?>"
                        required
                    >

                </div>



                <div class="form-group">

                    <label for="apartment">
                        Apartment
                    </label>

                    <input
                        type="text"
                        id="apartment"
                        name="unit_number"
                        placeholder="e.g. A-204"
                        value="<?= isset($_POST['unit_number'])
                            ? htmlspecialchars($_POST['unit_number'])
                            : ''
                        ?>"
                        required
                    >

                </div>

            </div>



            <!-- Phone + Email -->

            <div class="form-row">

                <div class="form-group">

                    <label for="phone">
                        Phone Number
                    </label>

                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        placeholder="Enter phone number"
                        value="<?= isset($_POST['phone'])
                            ? htmlspecialchars($_POST['phone'])
                            : ''
                        ?>"
                        required
                    >

                </div>



                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter email address"
                        value="<?= isset($_POST['email'])
                            ? htmlspecialchars($_POST['email'])
                            : ''
                        ?>"
                        required
                    >

                </div>

            </div>



            <!-- Address + Building -->

            <div class="form-row">

                <div class="form-group">

                    <label for="address">
                        Address
                    </label>

                    <input
                        type="text"
                        id="address"
                        name="address"
                        placeholder="Enter address"
                        value="<?= isset($_POST['address'])
                            ? htmlspecialchars($_POST['address'])
                            : ''
                        ?>"
                        required
                    >

                </div>



                <div class="form-group">

                    <label for="building">
                        Building
                    </label>

                    <input
                        type="text"
                        id="building"
                        name="building"
                        placeholder="e.g. Building A"
                        value="<?= isset($_POST['building'])
                            ? htmlspecialchars($_POST['building'])
                            : ''
                        ?>"
                        required
                    >

                </div>

            </div>



            <!-- Buttons -->

            <div class="form-actions">

                <a
                    href="resident.php"
                    class="cancel-btn"
                >

                    Cancel

                </a>


                <button
                    type="submit"
                    class="save-btn"
                >

                    <i class="bi bi-check-lg"></i>

                    Add Resident

                </button>

            </div>


        </form>

    </div>

</div>