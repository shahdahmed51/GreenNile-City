<?php

require_once "../config/connection.php";

// Get bill ID from URL
$billId = $_GET['id'] ?? null;

if (!$billId || !is_numeric($billId)) {
    die("Invalid invoice ID.");
}


// Get invoice + resident information
$sql = "SELECT
            b.bill_id,
            b.resident_id,
            b.payment_id,
            b.bill_type,
            b.amount,
            b.issue_date,
            b.due_date,
            b.status,
            r.full_name,
            r.phone,
            r.email,
            r.address,
            r.building,
            r.unit_number
        FROM bills b
        JOIN residents r
        ON b.resident_id = r.resident_id
        WHERE b.bill_id = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Query preparation failed: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $billId);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$invoice = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);


// Check if invoice exists
if (!$invoice) {
    die("Invoice not found.");
}


// Determine invoice status
if ($invoice['status'] === 'paid') {

    $statusText = "Paid";
    $statusClass = "success";

} elseif (
    $invoice['status'] === 'unpaid'
    && $invoice['due_date'] < date('Y-m-d')
) {

    $statusText = "Overdue";
    $statusClass = "danger";

} else {

    $statusText = "Pending";
    $statusClass = "warning";
}


// Format amount
$amount = (float) $invoice['amount'];

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<div class="main-content">

    <div class="container-fluid py-4">


        <!-- Page Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Invoice Details
                </h2>

                <p class="text-muted">
                    View invoice information
                </p>

            </div>


            <a href="billing.php"
               class="btn btn-outline-secondary">

                <i class="bi bi-arrow-left"></i>

                Back to Billing

            </a>

        </div>



        <!-- Invoice Card -->

        <div class="card invoice-card shadow-sm border-0">

            <div class="card-body p-4">


                <!-- Invoice Header -->

                <div class="invoice-header d-flex justify-content-between mb-4">

                    <div>

                        <h4 class="fw-bold text-success">
                            EcoCity
                        </h4>

                        <p class="text-muted mb-0">
                            EcoCity Management System
                        </p>

                    </div>


                    <div class="text-end">

                        <h5 class="fw-bold">

                            INV-<?= htmlspecialchars($invoice['bill_id']) ?>

                        </h5>


                        <span class="badge bg-<?= $statusClass ?>">

                            <?= $statusText ?>

                        </span>

                    </div>

                </div>


                <hr>



                <!-- Resident Information -->

                <div class="row mb-4">


                    <!-- Bill To -->

                    <div class="col-md-6">

                        <h6 class="fw-bold">
                            Bill To
                        </h6>


                        <p class="mb-1">

                            <?= htmlspecialchars(
                                $invoice['full_name']
                            ) ?>

                        </p>


                        <p class="text-muted mb-1">

                            Building:
                            <?= htmlspecialchars(
                                $invoice['building']
                            ) ?>

                        </p>


                        <p class="text-muted mb-1">

                            Unit:
                            <?= htmlspecialchars(
                                $invoice['unit_number']
                            ) ?>

                        </p>


                        <p class="text-muted">

                            <?= htmlspecialchars(
                                $invoice['phone']
                            ) ?>

                        </p>

                    </div>



                    <!-- Invoice Information -->

                    <div class="col-md-6 text-md-end">

                        <h6 class="fw-bold">
                            Invoice Information
                        </h6>


                        <p class="mb-1">

                            <strong>
                                Invoice Date:
                            </strong>

                            <?= date(
                                'd M Y',
                                strtotime($invoice['issue_date'])
                            ) ?>

                        </p>


                        <p class="mb-1">

                            <strong>
                                Due Date:
                            </strong>

                            <?= date(
                                'd M Y',
                                strtotime($invoice['due_date'])
                            ) ?>

                        </p>


                        <p>

                            <strong>
                                Payment ID:
                            </strong>

                            <?= $invoice['payment_id']
                                ? htmlspecialchars($invoice['payment_id'])
                                : 'N/A'
                            ?>

                        </p>

                    </div>

                </div>



                <!-- Invoice Table -->

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead class="table-light">

                            <tr>

                                <th>
                                    Description
                                </th>

                                <th>
                                    Quantity
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                    Total
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
                                    1
                                </td>

                                <td>

                                    $<?= number_format(
                                        $amount,
                                        2
                                    ) ?>

                                </td>

                                <td>

                                    $<?= number_format(
                                        $amount,
                                        2
                                    ) ?>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>



                <!-- Total -->

                <div class="invoice-total">

                    <div class="d-flex justify-content-between">

                        <span>
                            Subtotal
                        </span>

                        <strong>

                            $<?= number_format(
                                $amount,
                                2
                            ) ?>

                        </strong>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span>
                            Tax
                        </span>

                        <strong>
                            $0.00
                        </strong>

                    </div>


                    <div class="d-flex justify-content-between">

                        <span>
                            Total
                        </span>

                        <strong>

                            $<?= number_format(
                                $amount,
                                2
                            ) ?>

                        </strong>

                    </div>

                </div>



                <!-- Actions -->

                <div class="text-end mt-4">


                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="window.print()"
                    >

                        <i class="bi bi-printer"></i>

                        Print Invoice

                    </button>


                    <a
                        href="billing.php"
                        class="btn btn-success"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Back

                    </a>


                </div>


            </div>

        </div>


    </div>

</div>



<?php include '../includes/footer.php'; ?>