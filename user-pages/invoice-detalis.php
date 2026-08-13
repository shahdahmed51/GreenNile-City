
<?php
require_once "../includes/user-auth.php";

$current_page = basename($_SERVER['PHP_SELF']);
require_once "../config/connection.php";

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/user-sidebar.php';

?>

<link rel="stylesheet" href="../assets/css/invoice.css">

<?php

// Get invoice ID from URL
$bill_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;


// Get invoice details
$sql = "SELECT
            b.bill_id,
            b.resident_id,
            b.bill_type,
            b.amount,
            b.issue_date,
            b.due_date,
            b.status,
            r.full_name
        FROM bills b
        JOIN residents r
        ON b.resident_id = r.resident_id
        WHERE b.bill_id = $bill_id
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$invoice = mysqli_fetch_assoc($result);


// Check if invoice exists
if (!$invoice) {
    die("Invoice not found.");
}


// Status
if ($invoice['status'] === 'paid') {

    $statusText = "Paid";
    $statusClass = "bg-success";

} elseif (
    $invoice['status'] === 'unpaid'
    && $invoice['due_date'] < date('Y-m-d')
) {

    $statusText = "Overdue";
    $statusClass = "bg-danger";

} else {

    $statusText = "Pending";
    $statusClass = "bg-warning text-dark";
}

?>

<div class="main-content">

    <div class="container-fluid py-4">

        <!-- Page Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Invoice Details
                </h2>

                <p class="text-muted">
                    View your invoice information.
                </p>

            </div>

            <a
                href="billing.php"
                class="btn btn-outline-success"
            >
                Back
            </a>

        </div>


        <!-- Invoice Card -->

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <!-- Invoice & Resident Information -->

                <div class="row mb-4">

                    <!-- Invoice Information -->

                    <div class="col-md-6">

                        <h5 class="fw-bold mb-3">
                            Invoice Information
                        </h5>

                        <p>
                            <strong>Invoice No:</strong>
                            INV-<?= $invoice['bill_id'] ?>
                        </p>

                        <p>
                            <strong>Date:</strong>
                            <?= date(
                                'd M Y',
                                strtotime($invoice['issue_date'])
                            ) ?>
                        </p>

                        <p>
                            <strong>Due Date:</strong>
                            <?= date(
                                'd M Y',
                                strtotime($invoice['due_date'])
                            ) ?>
                        </p>

                        <p>

                            <strong>Status:</strong>

                            <span class="badge <?= $statusClass ?>">
                                <?= $statusText ?>
                            </span>

                        </p>

                    </div>


                    <!-- Resident -->

                    <div class="col-md-6">

                        <h5 class="fw-bold mb-3">
                            Resident
                        </h5>

                        <p>
                            <strong>Name:</strong>
                            <?= htmlspecialchars(
                                $invoice['full_name']
                            ) ?>
                        </p>

                        <p>
                            <strong>Resident ID:</strong>
                            <?= $invoice['resident_id'] ?>
                        </p>

                    </div>

                </div>


                <!-- Invoice Table -->

                <table class="table">

                    <thead>

                        <tr>

                            <th>
                                Description
                            </th>

                            <th>
                                Amount
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        <tr>

                            <td>
                                <?= htmlspecialchars(
                                    $invoice['bill_type']
                                ) ?>
                            </td>

                            <td>
                                $<?= number_format(
                                    $invoice['amount'],
                                    2
                                ) ?>
                            </td>

                        </tr>

                    </tbody>

                </table>


                <hr>


                <!-- Total -->

                <div class="d-flex justify-content-between">

                    <h4>
                        Total
                    </h4>

                    <h4 class="text-success">

                        $<?= number_format(
                            $invoice['amount'],
                            2
                        ) ?>

                    </h4>

                </div>


                <!-- Download -->

                <div class="mt-4">

                    <button
                        class="btn btn-success"
                        onclick="window.print()"
                    >
                        Download PDF
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>


<?php include '../includes/footer.php'; ?>
