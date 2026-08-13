<?php
require_once "../includes/admin-auth.php";
?>
<?php

$current_page = basename($_SERVER['PHP_SELF']);

require_once "../config/connection.php";

include "../includes/header.php";
include "../includes/navbar.php";
include "../includes/sidebar.php";


// =====================================
// Billing Statistics
// =====================================

// Total Revenue
$sql = "SELECT COALESCE(SUM(amount), 0) AS total_revenue
        FROM bills
        WHERE status = 'paid'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$totalRevenue = $row['total_revenue'];


// Paid This Month
$sql = "SELECT COALESCE(SUM(amount), 0) AS paid_this_month
        FROM bills
        WHERE status = 'paid'
        AND MONTH(issue_date) = MONTH(CURRENT_DATE())
        AND YEAR(issue_date) = YEAR(CURRENT_DATE())";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$paidThisMonth = $row['paid_this_month'];


// Pending
$sql = "SELECT COALESCE(SUM(amount), 0) AS pending
        FROM bills
        WHERE status = 'unpaid'
        AND due_date >= CURRENT_DATE()";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$pending = $row['pending'];


// Overdue
$sql = "SELECT COALESCE(SUM(amount), 0) AS overdue
        FROM bills
        WHERE status = 'unpaid'
        AND due_date < CURRENT_DATE()";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
$overdue = $row['overdue'];


// Total Due
$totalDue = $pending + $overdue;


// =====================================
// Payment History
// =====================================

$sql = "SELECT 
            b.bill_id,
            b.resident_id,
            b.payment_id,
            b.bill_type,
            b.amount,
            b.issue_date,
            b.due_date,
            b.status,
            r.full_name
        FROM bills b
        JOIN residents r
        ON b.resident_id = r.resident_id
        ORDER BY b.issue_date DESC";

$billsResult = mysqli_query($conn, $sql);

if (!$billsResult) {
    die("Query failed: " . mysqli_error($conn));
}

?>



<div class="main-content">

    <div class="container-fluid py-4">


        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">Billing</h2>
                <p class="text-muted">Billing Overview</p>
            </div>

            <a href="add-invoice.php" class="btn btn-success">

                <i class="bi bi-plus-circle"></i>

                Add Invoice

            </a>

        </div>



        <!-- Statistics Cards -->

        <div class="row g-4 mb-4">


            <!-- Total Revenue -->

            <div class="col-md-3">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body text-center">

                        <p class="text-muted mb-2">
                            Total Revenue
                        </p>

                        <h3 class="text-success fw-bold">

                            $<?= number_format($totalRevenue, 2) ?>

                        </h3>

                    </div>

                </div>

            </div>



            <!-- Paid This Month -->

            <div class="col-md-3">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body text-center">

                        <p class="text-muted mb-2">
                            Paid This Month
                        </p>

                        <h3 class="text-primary fw-bold">

                            $<?= number_format($paidThisMonth, 2) ?>

                        </h3>

                    </div>

                </div>

            </div>



            <!-- Pending -->

            <div class="col-md-3">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body text-center">

                        <p class="text-muted mb-2">
                            Pending
                        </p>

                        <h3 class="text-warning fw-bold">

                            $<?= number_format($pending, 2) ?>

                        </h3>

                    </div>

                </div>

            </div>



            <!-- Overdue -->

            <div class="col-md-3">

                <div class="card billing-card shadow-sm border-0">

                    <div class="card-body text-center">

                        <p class="text-muted mb-2">
                            Overdue
                        </p>

                        <h3 class="text-danger fw-bold">

                            $<?= number_format($overdue, 2) ?>

                        </h3>

                    </div>

                </div>

            </div>


        </div>



        <!-- Second Row -->

        <div class="row">


            <!-- Payment History -->

            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">
                            Payment History
                        </h5>


                        <div class="table-responsive">

                            <table class="table align-middle">

                                <thead>

                                    <tr>

                                        <th>Invoice</th>

                                        <th>Date</th>

                                        <th>Description</th>

                                        <th>Amount</th>

                                        <th>Status</th>

                                    </tr>

                                </thead>


                                <tbody>


                                <?php if (mysqli_num_rows($billsResult) > 0): ?>


                                    <?php while ($bill = mysqli_fetch_assoc($billsResult)): ?>


                                        <tr>


                                            <!-- Invoice -->

                                            <td>

                                                <a
                                                    href="invoice.php?id=<?= $bill['bill_id'] ?>"
                                                    class="text-success text-decoration-none fw-bold"
                                                >

                                                    INV-<?= $bill['bill_id'] ?>

                                                </a>

                                            </td>



                                            <!-- Date -->

                                            <td>

                                                <?= date(
                                                    'd M Y',
                                                    strtotime($bill['issue_date'])
                                                ) ?>

                                            </td>



                                            <!-- Description -->

                                            <td>

                                                <?= htmlspecialchars(
                                                    $bill['bill_type']
                                                ) ?>

                                            </td>



                                            <!-- Amount -->

                                            <td>

                                                $<?= number_format(
                                                    $bill['amount'],
                                                    2
                                                ) ?>

                                            </td>



                                            <!-- Status -->

                                            <td>


                                                <?php if ($bill['status'] === 'paid'): ?>


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

                                        <td colspan="5" class="text-center text-muted">

                                            No invoices found.

                                        </td>

                                    </tr>


                                <?php endif; ?>


                                </tbody>

                            </table>

                        </div>



                        <div class="text-center mt-3">

                            <a
                                href="invoices.php"
                                class="text-success fw-bold text-decoration-none"
                            >

                                View All Invoices

                            </a>

                        </div>


                    </div>

                </div>

            </div>



            <!-- Billing Summary -->

            <div class="col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body text-center">


                        <h5 class="fw-bold mb-4">

                            Billing Summary

                        </h5>



                        <!-- Circle -->

                        <div class="billing-circle">

                            <div class="billing-center">

                                <h4>

                                    $<?= number_format($totalDue, 2) ?>

                                </h4>

                                <small>

                                    Total Due

                                </small>

                            </div>

                        </div>



                        <!-- Summary -->

                        <div class="mt-4">


                            <!-- Paid -->

                            <div class="d-flex justify-content-between mb-2">

                                <span>

                                    <span class="dot paid"></span>

                                    Paid

                                </span>

                                <strong>

                                    $<?= number_format($totalRevenue, 2) ?>

                                </strong>

                            </div>



                            <!-- Pending -->

                            <div class="d-flex justify-content-between mb-2">

                                <span>

                                    <span class="dot pending"></span>

                                    Pending

                                </span>

                                <strong>

                                    $<?= number_format($pending, 2) ?>

                                </strong>

                            </div>



                            <!-- Overdue -->

                            <div class="d-flex justify-content-between">

                                <span>

                                    <span class="dot overdue"></span>

                                    Overdue

                                </span>

                                <strong>

                                    $<?= number_format($overdue, 2) ?>

                                </strong>

                            </div>


                        </div>



                        <!-- Pay Now -->

                        <a
                            href="../user-pages/payment.php"
                            class="btn btn-success w-100 mb-2 mt-4"
                        >

                            Pay Now

                        </a>


                    </div>

                </div>

            </div>


        </div>


    </div>

</div>



<?php include "../includes/footer.php"; ?>