<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/user-billing.css">

<div class="main-content">
    <div class="container-fluid py-4">

        <!-- Page Header -->
        <div class="mb-4">
            <h2 class="fw-bold">My Billing</h2>
            <p class="text-muted">Track your payments and invoices.</p>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Amount Due</h6>
                        <h3 class="text-danger fw-bold">$1,250</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Last Payment</h6>
                        <h3 class="text-success fw-bold">$850</h3>
                        <small class="text-muted">10 Jul 2026</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted">Next Due Date</h6>
                        <h3 class="fw-bold">15 Aug</h3>
                        <small class="text-muted">2026</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <!-- My Invoices -->
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">My Invoices</h5>

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

                                <tr>
                                    <td>INV-101</td>
                                    <td>Maintenance Fee</td>
                                    <td>$850</td>
                                    <td>10 Jul 2026</td>
                                    <td>
                                        <span class="badge bg-success">Paid</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>INV-102</td>
                                    <td>Parking Fee</td>
                                    <td>$120</td>
                                    <td>15 Aug 2026</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>INV-103</td>
                                    <td>Utilities</td>
                                    <td>$280</td>
                                    <td>20 Aug 2026</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    </td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <!-- Right Side -->
            <div class="col-lg-4">

                <!-- Payment Summary -->
                <div class="card shadow-sm border-0 mb-4">

                    <div class="card-body text-center">

                        <h5 class="fw-bold mb-4">Payment Summary</h5>

                        <div class="billing-circle">

                            <div class="billing-center">

                                <h4>$1,250</h4>
                                <small>Total Due</small>

                            </div>

                        </div>

                        <div class="mt-4">

                            <div class="d-flex justify-content-between mb-2">
                                <span>
                                    <span class="dot paid"></span>
                                    Paid
                                </span>

                                <strong>$850</strong>
                            </div>

                            <div class="d-flex justify-content-between">

                                <span>
                                    <span class="dot pending"></span>
                                    Pending
                                </span>

                                <strong>$400</strong>

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

                        <a href="payment.php" class="btn btn-success w-100 mb-2">
                            Pay Now
                        </a>

                        <a href="invoice-detalis.php" class="btn btn-outline-success w-100">
                            Download Invoice
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>