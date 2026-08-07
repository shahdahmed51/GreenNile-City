<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="main-content">
    <div class="container-fluid py-4">

        <!-- Page Header -->
        <div class="mb-4">
            <h2 class="fw-bold">Payment</h2>
            <p class="text-muted">Complete your payment securely.</p>
        </div>

        <div class="row">

            <!-- Payment Form -->
            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h4 class="fw-bold mb-4">Payment Details</h4>

                        <div class="mb-3">
                            <label class="form-label">Amount</label>
                            <input type="text" class="form-control" value="$1,250" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>

                            <select class="form-select">
                                <option>Visa</option>
                                <option>MasterCard</option>
                                <option>Cash</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Card Holder Name</label>
                            <input type="text" class="form-control" placeholder="Enter card holder name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Card Number</label>
                            <input type="text" class="form-control" placeholder="**** **** **** ****">
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Expiry Date</label>
                                <input type="month" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">CVV</label>
                                <input type="password" class="form-control" placeholder="***">
                            </div>

                        </div>

                        <a href="payment-success.php" class="btn btn-success w-100">
                            Confirm Payment
                        </a>

                    </div>

                </div>

            </div>

            <!-- Summary -->
            <div class="col-lg-4">

                <div class="card shadow-sm border-0">

                    <div class="card-body">

                        <h5 class="fw-bold mb-4">Payment Summary</h5>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Maintenance</span>
                            <strong>$850</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Parking</span>
                            <strong>$120</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Utilities</span>
                            <strong>$280</strong>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5>Total</h5>
                            <h5 class="text-success">$1,250</h5>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<?php include '../includes/footer.php'; ?>