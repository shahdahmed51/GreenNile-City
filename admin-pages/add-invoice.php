<?php

require_once "../config/connection.php";


// =====================================
// Add Invoice
// =====================================

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $residentId = $_POST["resident_id"] ?? "";
    $billType   = $_POST["bill_type"] ?? "";
    $amount     = $_POST["amount"] ?? "";
    $issueDate  = $_POST["issue_date"] ?? "";
    $dueDate    = $_POST["due_date"] ?? "";


    // =====================================
    // Validation
    // =====================================

    if (
        empty($residentId) ||
        empty($billType) ||
        empty($amount) ||
        empty($issueDate) ||
        empty($dueDate)
    ) {

        $error = "Please fill in all fields.";

    } elseif (!is_numeric($amount) || $amount <= 0) {

        $error = "Please enter a valid amount.";

    } elseif ($dueDate < $issueDate) {

        $error = "Due date cannot be before issue date.";

    } else {


        // =====================================
        // Insert Invoice
        // =====================================

        $sql = "INSERT INTO bills
                (
                    resident_id,
                    payment_id,
                    bill_type,
                    amount,
                    issue_date,
                    due_date,
                    status
                )
                VALUES
                (?, NULL, ?, ?, ?, ?, 'unpaid')";


        $stmt = mysqli_prepare($conn, $sql);


        if (!$stmt) {

            $error = "Failed to prepare query: "
                   . mysqli_error($conn);

        } else {

            mysqli_stmt_bind_param(
                $stmt,
                "isdss",
                $residentId,
                $billType,
                $amount,
                $issueDate,
                $dueDate
            );


            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                // Go to invoices page
                header("Location: invoices.php");

                exit;

            } else {

                $error = "Failed to add invoice: "
                       . mysqli_stmt_error($stmt);

                mysqli_stmt_close($stmt);

            }

        }

    }

}

?>


<?php include "../includes/header.php"; ?>
<?php include "../includes/navbar.php"; ?>
<?php include "../includes/sidebar.php"; ?>


<div class="main-content">

    <div class="container-fluid py-4">


        <!-- Page Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Add Invoice
                </h2>

                <p class="text-muted">
                    Create a new invoice
                </p>

            </div>


            <a
                href="billing.php"
                class="btn btn-outline-secondary"
            >

                <i class="bi bi-arrow-left"></i>

                Back to Billing

            </a>

        </div>



        <!-- Error -->

        <?php if (isset($error)): ?>

            <div class="alert alert-danger">

                <?= htmlspecialchars($error) ?>

            </div>

        <?php endif; ?>



        <!-- Form -->

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <form method="POST">


                    <!-- Resident -->

                    <div class="mb-3">

                        <label
                            for="resident_id"
                            class="form-label fw-bold"
                        >

                            Resident

                        </label>


                        <select
                            name="resident_id"
                            id="resident_id"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Resident
                            </option>


                            <?php

                            $residentsQuery = "
                                SELECT resident_id, full_name
                                FROM residents
                                ORDER BY full_name ASC
                            ";

                            $residentsResult =
                                mysqli_query(
                                    $conn,
                                    $residentsQuery
                                );


                            while (
                                $resident =
                                mysqli_fetch_assoc(
                                    $residentsResult
                                )
                            ):

                            ?>

                                <option
                                    value="<?= $resident['resident_id'] ?>"
                                    <?= (
                                        isset($_POST['resident_id'])
                                        &&
                                        $_POST['resident_id']
                                        == $resident['resident_id']
                                    )
                                    ? "selected"
                                    : ""
                                    ?>
                                >

                                    <?= htmlspecialchars(
                                        $resident['full_name']
                                    ) ?>

                                </option>

                            <?php endwhile; ?>

                        </select>

                    </div>



                    <!-- Bill Type -->

                    <div class="mb-3">

                        <label
                            for="bill_type"
                            class="form-label fw-bold"
                        >

                            Bill Type

                        </label>


                        <select
                            name="bill_type"
                            id="bill_type"
                            class="form-select"
                            required
                        >

                            <option value="">
                                Select Bill Type
                            </option>

                            <option value="maintenance">
                                Maintenance
                            </option>

                            <option value="parking">
                                Parking
                            </option>

                            <option value="utilities">
                                Utilities
                            </option>

                        </select>

                    </div>



                    <!-- Amount -->

                    <div class="mb-3">

                        <label
                            for="amount"
                            class="form-label fw-bold"
                        >

                            Amount

                        </label>


                        <input
                            type="number"
                            name="amount"
                            id="amount"
                            class="form-control"
                            step="0.01"
                            min="0.01"
                            placeholder="Enter amount"
                            value="<?= isset($_POST['amount'])
                                ? htmlspecialchars($_POST['amount'])
                                : ""
                            ?>"
                            required
                        >

                    </div>



                    <!-- Issue Date -->

                    <div class="mb-3">

                        <label
                            for="issue_date"
                            class="form-label fw-bold"
                        >

                            Issue Date

                        </label>


                        <input
                            type="date"
                            name="issue_date"
                            id="issue_date"
                            class="form-control"
                            value="<?= isset($_POST['issue_date'])
                                ? htmlspecialchars($_POST['issue_date'])
                                : date("Y-m-d")
                            ?>"
                            required
                        >

                    </div>



                    <!-- Due Date -->

                    <div class="mb-4">

                        <label
                            for="due_date"
                            class="form-label fw-bold"
                        >

                            Due Date

                        </label>


                        <input
                            type="date"
                            name="due_date"
                            id="due_date"
                            class="form-control"
                            value="<?= isset($_POST['due_date'])
                                ? htmlspecialchars($_POST['due_date'])
                                : ""
                            ?>"
                            required
                        >

                    </div>



                    <!-- Buttons -->

                    <div class="d-flex gap-2">

                        <button
                            type="submit"
                            class="btn btn-success"
                        >

                            <i class="bi bi-check-circle"></i>

                            Add Invoice

                        </button>


                        <a
                            href="billing.php"
                            class="btn btn-outline-secondary"
                        >

                            Cancel

                        </a>

                    </div>


                </form>

            </div>

        </div>

    </div>

</div>


<?php include "../includes/footer.php"; ?>