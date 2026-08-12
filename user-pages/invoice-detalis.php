<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/invoice.css">

<div class="main-content">

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">Invoice Details</h2>
                <p class="text-muted">
                    View your invoice information.
                </p>
            </div>

            <a href="billing.php" class="btn btn-outline-success">
                Back
            </a>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <div class="row mb-4">

                    <div class="col-md-6">

                        <h5 class="fw-bold mb-3">
                            Invoice Information
                        </h5>

                        <p><strong>Invoice No:</strong> INV-101</p>

                        <p><strong>Date:</strong> 10 Jul 2026</p>

                        <p><strong>Status:</strong>

                            <span class="badge bg-success">
                                Paid
                            </span>

                        </p>

                    </div>

                    <div class="col-md-6">

                        <h5 class="fw-bold mb-3">
                            Resident
                        </h5>

                        <p><strong>Name:</strong> Ahmed Ali</p>

                        <p><strong>Unit:</strong> A-101</p>

                        <p><strong>Email:</strong> ahmed@gmail.com</p>

                    </div>

                </div>

                <table class="table">

                    <thead>

                        <tr>

                            <th>Description</th>

                            <th>Amount</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>Maintenance Fee</td>

                            <td>$850</td>

                        </tr>

                        <tr>

                            <td>Parking Fee</td>

                            <td>$120</td>

                        </tr>

                        <tr>

                            <td>Utilities</td>

                            <td>$280</td>

                        </tr>

                    </tbody>

                </table>

                <hr>

                <div class="d-flex justify-content-between">

                    <h4>Total</h4>

                    <h4 class="text-success">
                        $1,250
                    </h4>

                </div>

                <div class="mt-4">

                    <button class="btn btn-success">
                        Download PDF
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>