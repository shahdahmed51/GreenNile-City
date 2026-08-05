<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<div class="main-content">
    <div class="container-fluid py-4">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Billing</h2>
                <p class="text-muted">Billing Overview</p>
            </div>

            <button class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add Invoice
            </button>
        </div>

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">

            <div class="col-md-3">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body text-center">
                        <p class="text-muted mb-2">Total Revenue</p>
                        <h3 class="text-success fw-bold">$12,540</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body text-center">
                        <p class="text-muted mb-2">Paid This Month</p>
                        <h3 class="text-primary fw-bold">$3,230</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body text-center">
                        <p class="text-muted mb-2">Pending</p>
                        <h3 class="text-warning fw-bold">$4,310</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card billing-card shadow-sm border-0">
                    <div class="card-body text-center">
                        <p class="text-muted mb-2">Overdue</p>
                        <h3 class="text-danger fw-bold">$1,250</h3>
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

                        <h5 class="fw-bold mb-4">Payment History</h5>

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

                                <tr>
                                    <td>INV-2024-01</td>
                                    <td>10 May 2024</td>
                                    <td>Maintenance Fee</td>
                                    <td>$850.00</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>

                                <tr>
                                    <td>INV-2024-02</td>
                                    <td>9 May 2024</td>
                                    <td>Parking Fee</td>
                                    <td>$120.00</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>

                                <tr>
                                    <td>INV-2024-03</td>
                                    <td>12 Apr 2024</td>
                                    <td>Utilities</td>
                                    <td>$780.00</td>
                                    <td><span class="badge bg-warning text-dark">Pending</span></td>
                                </tr>

                                <tr>
                                    <td>INV-2024-04</td>
                                    <td>6 Apr 2024</td>
                                    <td>Maintenance Fee</td>
                                    <td>$850.00</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>

                                <tr>
                                    <td>INV-2024-05</td>
                                    <td>4 Jan 2024</td>
                                    <td>Parking Fee</td>
                                    <td>$120.00</td>
                                    <td><span class="badge bg-danger">Overdue</span></td>
                                </tr>

                            </tbody>
                        </table>

                        <div class="text-center mt-3">
                            <a href="#" class="text-success fw-bold text-decoration-none">
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

                        <h5 class="fw-bold mb-4">Billing Summary</h5>

                        <div class="billing-circle">
                            <div class="billing-center">
                                <h4>$7,790</h4>
                                <small>Total Due</small>
                            </div>
                        </div>

                        <div class="mt-4">

                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="dot paid"></span> Paid</span>
                                <strong>$4,770</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span><span class="dot pending"></span> Pending</span>
                                <strong>$1,830</strong>
                            </div>

                            <div class="d-flex justify-content-between">
                                <span><span class="dot overdue"></span> Overdue</span>
                                <strong>$1,190</strong>
                            </div>

                        </div>

                        <button class="btn btn-success w-100 mt-4">
                            Pay Now
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
<?php include '../includes/footer.php'; ?>