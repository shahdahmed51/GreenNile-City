<?php
require_once "../includes/admin-auth.php";
?>
<?php

$current_page = basename($_SERVER['PHP_SELF']);

require_once "../config/connection.php";

include "../includes/header.php";
include "../includes/navbar.php";
include "../includes/sidebar.php";


// Get all invoices
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
        ORDER BY b.issue_date DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<div class="main-content">

    <div class="container-fluid py-4">

        <!-- Page Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Invoices
                </h2>

                <p class="text-muted">
                    View and manage all invoices
                </p>

            </div>


            <div>

                <a href="billing.php"
                   class="btn btn-outline-secondary me-2">

                    <i class="bi bi-arrow-left"></i>

                    Back to Billing

                </a>


                <a href="add-invoice.php"
                   class="btn btn-success">

                    <i class="bi bi-plus-circle"></i>

                    Add Invoice

                </a>

            </div>

        </div>



        <!-- Invoices Card -->

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Invoice
                                </th>

                                <th>
                                    Resident
                                </th>

                                <th>
                                    Type
                                </th>

                                <th>
                                    Issue Date
                                </th>

                                <th>
                                    Due Date
                                </th>

                                <th>
                                    Amount
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Action
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                        <?php if (mysqli_num_rows($result) > 0): ?>


                            <?php while ($invoice = mysqli_fetch_assoc($result)): ?>


                                <tr>


                                    <!-- Invoice Number -->

                                    <td>

                                        <a
                                            href="invoice.php?id=<?= $invoice['bill_id'] ?>"
                                            class="text-success text-decoration-none fw-bold"
                                        >

                                            INV-<?= $invoice['bill_id'] ?>

                                        </a>

                                    </td>



                                    <!-- Resident -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $invoice['full_name']
                                        ) ?>

                                    </td>



                                    <!-- Bill Type -->

                                    <td>

                                        <?= htmlspecialchars(
                                            $invoice['bill_type']
                                        ) ?>

                                    </td>



                                    <!-- Issue Date -->

                                    <td>

                                        <?= date(
                                            'd M Y',
                                            strtotime($invoice['issue_date'])
                                        ) ?>

                                    </td>



                                    <!-- Due Date -->

                                    <td>

                                        <?= date(
                                            'd M Y',
                                            strtotime($invoice['due_date'])
                                        ) ?>

                                    </td>



                                    <!-- Amount -->

                                    <td>

                                        $<?= number_format(
                                            $invoice['amount'],
                                            2
                                        ) ?>

                                    </td>



                                    <!-- Status -->

                                    <td>


                                        <?php if ($invoice['status'] === 'paid'): ?>


                                            <span class="badge bg-success">

                                                Paid

                                            </span>


                                        <?php elseif (
                                            $invoice['status'] === 'unpaid'
                                            &&
                                            $invoice['due_date'] < date('Y-m-d')
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



                                    <!-- Action -->

                                    <td>

                                        <a
                                            href="invoice.php?id=<?= $invoice['bill_id'] ?>"
                                            class="btn btn-sm btn-outline-success"
                                            title="View Invoice"
                                        >

                                            <i class="bi bi-eye"></i>

                                        </a>

                                    </td>


                                </tr>


                            <?php endwhile; ?>


                        <?php else: ?>


                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-4"
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

</div>


<?php include "../includes/footer.php"; ?>
