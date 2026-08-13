<?php

$current_page = basename($_SERVER['PHP_SELF']);
require_once "../includes/user-auth.php";
require_once "../config/connection.php";

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/user-sidebar.php';

?>

<link rel="stylesheet" href="../assets/css/billing.css">

<style>
    .user-billing-circle {
        width: 170px;
        height: 170px;
        margin: auto;
        border-radius: 50%;

        display: flex;
        justify-content: center;
        align-items: center;
    }

    .user-billing-center {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: white;

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .user-billing-center h4 {
        margin: 0;
        font-weight: bold;
    }

    .user-billing-center small {
        color: #6c757d;
    }

    .user-billing-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
    }

    .user-billing-paid {
        background: #28a745;
    }

    .user-billing-pending {
        background: #ffc107;
    }

    .user-billing-overdue {
        background: #dc3545;
    }
</style>


<?php

// Temporary resident ID
// Login/session will be connected later
$resident_id = 1;


// =====================================
// Amount Due
// =====================================

$sql = "SELECT COALESCE(SUM(amount), 0) AS amount_due
        FROM bills
        WHERE resident_id = $resident_id
        AND status = 'unpaid'
        AND due_date >= CURRENT_DATE()";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$amountDue = (float)$row['amount_due'];


// =====================================
// Last Payment
// =====================================

$sql = "SELECT amount, issue_date
        FROM bills
        WHERE resident_id = $resident_id
        AND status = 'paid'
        ORDER BY issue_date DESC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$lastPayment = mysqli_fetch_assoc($result);


// =====================================
// Next Due Date
// =====================================

$sql = "SELECT due_date
        FROM bills
        WHERE resident_id = $resident_id
        AND status = 'unpaid'
        AND due_date >= CURRENT_DATE()
        ORDER BY due_date ASC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$nextDue = mysqli_fetch_assoc($result);


// =====================================
// Paid
// =====================================

$sql = "SELECT COALESCE(SUM(amount), 0) AS paid
        FROM bills
        WHERE resident_id = $resident_id
        AND status = 'paid'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$paid = (float)$row['paid'];


// =====================================
// Pending
// =====================================

$sql = "SELECT COALESCE(SUM(amount), 0) AS pending
        FROM bills
        WHERE resident_id = $resident_id
        AND status = 'unpaid'
        AND due_date >= CURRENT_DATE()";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$pending = (float)$row['pending'];


// =====================================
// Overdue
// =====================================

$sql = "SELECT COALESCE(SUM(amount), 0) AS overdue
        FROM bills
        WHERE resident_id = $resident_id
        AND status = 'unpaid'
        AND due_date < CURRENT_DATE()";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$overdue = (float)$row['overdue'];


// =====================================
// Circle Percentages
// =====================================

$totalBilling = $paid + $pending + $overdue;

if ($totalBilling > 0) {

    $paidPercent = ($paid / $totalBilling) * 100;

    $pendingPercent = ($pending / $totalBilling) * 100;

} else {

    $paidPercent = 0;
    $pendingPercent = 0;
}

$pendingEnd = $paidPercent + $pendingPercent;


// =====================================
// My Invoices
// =====================================

$sql = "SELECT
            bill_id,
            bill_type,
            amount,
            issue_date,
            due_date,
            status
        FROM bills
        WHERE resident_id = $resident_id
        ORDER BY issue_date DESC";

$billsResult = mysqli_query($conn, $sql);

if (!$billsResult) {
    die("Query failed: " . mysqli_error($conn));
}


// =====================================
// Latest Invoice
// =====================================

$sql = "SELECT bill_id
        FROM bills
        WHERE resident_id = $resident_id
        ORDER BY issue_date DESC
        LIMIT 1";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$latestInvoice = mysqli_fetch_assoc($result);

?>


<div class="main-content">

    <div class="container-fluid py-4">


        <!-- Page Header -->

        <div class="mb-4">

            <h2 class="fw-bold">
                My Billing
            </h2>

            <p class="text-muted">
                Track your payments and invoices.
            </p>

        </div>


        <!-- Summary Cards -->

        <div class="row g-4 mb-4">


            <!-- Amount Due -->

            <div class="col-md-4">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Amount Due
                        </h6>

                        <h3 class="text-danger fw-bold">
                            $<?= number_format($amountDue, 2) ?>
                        </h3>

                    </div>

                </div>

            </div>


            <!-- Last Payment -->

            <div class="col-md-4">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Last Payment
                        </h6>

                        <?php if ($lastPayment): ?>

                            <h3 class="text-success fw-bold">
                                $<?= number_format(
                                    $lastPayment['amount'],
                                    2
                                ) ?>
                            </h3>

                            <small class="text-muted">
                                <?= date(
                                    'd M Y',
                                    strtotime(
                                        $lastPayment['issue_date']
                                    )
                                ) ?>
                            </small>

                        <?php else: ?>

                            <h3 class="text-muted fw-bold">
                                $0.00
                            </h3>

                            <small class="text-muted">
                                No payments yet
                            </small>

                        <?php endif; ?>

                    </div>

                </div>

            </div>


            <!-- Next Due Date -->

            <div class="col-md-4">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body">

                        <h6 class="text-muted">
                            Next Due Date
                        </h6>

                        <?php if ($nextDue): ?>

                            <h3 class="fw-bold">
                                <?= date(
                                    'd M',
                                    strtotime(
                                        $nextDue['due_date']
                                    )
                                ) ?>
                            </h3>

                            <small class="text-muted">
                                <?= date(
                                    'Y',
                                    strtotime(
                                        $nextDue['due_date']
                                    )
                                ) ?>
                            </small>

                        <?php else: ?>

                            <h3 class="fw-bold">
                                No Due Date
                            </h3>

                            <small class="text-muted">
                                No pending invoices
                            </small>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>


        <!-- Main Content -->

        <div class="row">


            <!-- My Invoices -->

            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            My Invoices
                        </h5>

                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>

                                    <tr>
                                        <th>Invoice</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                    </tr>

                                </thead>

                                <tbody>

                                <?php if (
                                    mysqli_num_rows($billsResult) > 0
                                ): ?>

                                    <?php while (
                                        $bill = mysqli_fetch_assoc($billsResult)
                                    ): ?>

                                        <tr>

                                            <td>

                                                <a
                                                    href="invoice-detalis.php?id=<?= $bill['bill_id'] ?>"
                                                    class="text-success text-decoration-none fw-bold"
                                                >
                                                    INV-<?= $bill['bill_id'] ?>
                                                </a>

                                            </td>

                                            <td>
                                                <?= htmlspecialchars(
                                                    $bill['bill_type']
                                                ) ?>
                                            </td>

                                            <td>
                                                $<?= number_format(
                                                    $bill['amount'],
                                                    2
                                                ) ?>
                                            </td>

                                            <td>
                                                <?= date(
                                                    'd M Y',
                                                    strtotime(
                                                        $bill['due_date']
                                                    )
                                                ) ?>
                                            </td>

                                            <td>

                                                <?php if (
                                                    $bill['status'] === 'paid'
                                                ): ?>

                                                    <span class="badge bg-success">
                                                        Paid
                                                    </span>

                                                <?php elseif (
                                                    $bill['status'] === 'unpaid'
                                                    &&
                                                    $bill['due_date'] < date('Y-m-d')
                                                ): ?>

                                                    <span class="badge bg-danger">
                                                        Overdue
                                                    </span>

                                                <?php else: ?>

                                                    <span class="badge bg-warning text-dark">
                                                        Pending
                                                    </span>

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="text-center text-muted"
                                        >
                                            No invoices found.
                                        </td>

                                    </tr>

                                <?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Right Side -->

            <div class="col-lg-4">


                <!-- Payment Summary -->

                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-body text-center">

                        <h5 class="fw-bold mb-4">
                            Payment Summary
                        </h5>


                        <!-- USER THREE COLOR CIRCLE -->

                        <div
                            class="user-billing-circle"
                            style="
                                background: conic-gradient(
                                    #28a745 0% <?= $paidPercent ?>%,
                                    #ffc107 <?= $paidPercent ?>% <?= $pendingEnd ?>%,
                                    #dc3545 <?= $pendingEnd ?>% 100%
                                );
                            "
                        >

                            <div class="user-billing-center">

                                <h4>
                                    $<?= number_format(
                                        $amountDue,
                                        2
                                    ) ?>
                                </h4>

                                <small>
                                    Total Due
                                </small>

                            </div>

                        </div>


                        <!-- Payment Details -->

                        <div class="mt-4">


                            <div class="d-flex justify-content-between mb-2">

                                <span>

                                    <span class="user-billing-dot user-billing-paid"></span>

                                    Paid

                                </span>

                                <strong>
                                    $<?= number_format(
                                        $paid,
                                        2
                                    ) ?>
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between mb-2">

                                <span>

                                    <span class="user-billing-dot user-billing-pending"></span>

                                    Pending

                                </span>

                                <strong>
                                    $<?= number_format(
                                        $pending,
                                        2
                                    ) ?>
                                </strong>

                            </div>


                            <div class="d-flex justify-content-between">

                                <span>

                                    <span class="user-billing-dot user-billing-overdue"></span>

                                    Overdue

                                </span>

                                <strong>
                                    $<?= number_format(
                                        $overdue,
                                        2
                                    ) ?>
                                </strong>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- Payment Method -->

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h5 class="fw-bold mb-3">
                            Payment Method
                        </h5>


                        <div class="border rounded p-3 mb-4">

                            <h6 class="mb-1">
                                Visa **** 4589
                            </h6>

                            <small class="text-muted">
                                Default Payment Method
                            </small>

                        </div>


                        <a
                            href="payment.php"
                            class="btn btn-success w-100 mb-2"
                        >
                            Pay Now
                        </a>


                        <?php if ($latestInvoice): ?>

                            <a
                                href="invoice-detalis.php?id=<?= $latestInvoice['bill_id'] ?>"
                                class="btn btn-outline-success w-100"
                            >
                                Download Invoice
                            </a>

                        <?php else: ?>

                            <button
                                class="btn btn-outline-secondary w-100"
                                disabled
                            >
                                No Invoice Available
                            </button>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<?php include '../includes/footer.php'; ?>