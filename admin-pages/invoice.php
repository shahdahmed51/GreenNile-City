<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<div class="main-content">
    <div class="container-fluid py-4">
        <!-- page header -->
         <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Invoice Details</h2>
                <p class="text-muted">View invoice information</p>
            </div>
            <a href="billing.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Back to Billing
            </a>
         </div>
         <!-- invoice card -->
          <div class="card invoice-card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- invoice header -->
                 <div class="invoice-header d-flex justify-content-between mb-4">
                    <div>
                        <h4 class="fw-bold text-success">
                            EcoCity
                        </h4>
                        <p class="text-muted mb-0">
                            EcoCity management System
                        </p>
                    </div>
                    <div class="text-end">
                        <h5 class="fw-bold">
                            INV-2024-01
                        </h5>
                        <span class="badge bg-success">Paid</span>
                    </div>
                 </div>
                 <hr>
                 <!-- resident information -->
                  <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold">
                            Bill To
                        </h6>
                        <p class="mb-1">Ahmed Ali</p>
                        <p class="text-muted mb-1">
                            Apartment A-204
                        </p>
                        <p class="text-muted">
                            +20 100 617 0560
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6 class="fw-bold">
                            Invoice information
                        </h6>
                        <p class="mb-1">
                            <strong>Invoice Date:</strong>
                            10 May 2024
                        </p>
                        <p>
                            <strong>Due Date:</strong>
                            20 May 2024
                        </p>
                    </div>
                  </div>
                  <!-- invoice table -->
                   <div class="table-responsive">

                    <table class="table align-middle">

                        <thead class="table-light">

                            <tr>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Total</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td>Maintenance Fee</td>
                                <td>1</td>
                                <td>$850.00</td>
                                <td>$850.00</td>
                            </tr>

                            <tr>
                                <td>Parking Fee</td>
                                <td>1</td>
                                <td>$120.00</td>
                                <td>$120.00</td>
                            </tr>

                        </tbody>

                    </table>

                </div>
                <!-- total -->
                 <div class="invoice-total">
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong>$970.00</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Tax</span>
                        <strong>$0.00</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <strong>$970.00</strong>
                    </div>
                 </div>
                 <!-- actions -->
                  <div class="text-en mt-4">
                    <button type="button" class="btn btn-outline-secondary"
                    onclick="window.print()">
                  <i class="bi bi-printer"></i>
                  Print Invoice
                </button>
                <a href="billing.php" class="btn btn-success">
                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>
                  </div>


            </div>
          </div>
    </div>
</div>


<?php include '../includes/footer.php'; ?>