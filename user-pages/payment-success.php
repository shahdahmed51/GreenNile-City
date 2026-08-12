<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/payment-success.css">

<div class="main-content">
    <div class="container-fluid py-5">

        <div class="card shadow-sm border-0 text-center p-5">

            <div class="mb-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size:80px;"></i>
            </div>

            <h2 class="fw-bold text-success">
                Payment Successful
            </h2>

            <p class="text-muted mt-3">
                Your payment has been completed successfully.
            </p>

            <h4 class="fw-bold mt-4">
                Amount Paid: $1,250
            </h4>

            <div class="mt-5">

                <a href="billing.php" class="btn btn-success me-3">
                    Back to Billing
                </a>

                <a href="parking.php" class="btn btn-outline-success">
                    Go to Parking
                </a>

            </div>

        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>