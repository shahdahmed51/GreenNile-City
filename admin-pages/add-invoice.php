<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<link rel="stylesheet" href="../assets/css/add-invoice.css">

<div class="main-content">
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">Add Invoice</h2>
                <p class="text-muted">
                    Create a new invoice
                </p>
            </div>

            <a href="billing.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body p-4">

                <form onsubmit="addInvoice(event)">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Resident
                            </label>

                            <select class="form-select" required>

                                <option value="">
                                    Select Resident
                                </option>

                                <option>
                                    Ahmed Ali - A-204
                                </option>

                                <option>
                                    Sara Mohamed - B-205
                                </option>

                                <option>
                                    Omar Hassan - C-108
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Invoice Date
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Due Date
                            </label>

                            <input
                                type="date"
                                class="form-control"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Example: Maintenance Fee"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Amount
                            </label>

                            <input
                                type="number"
                                class="form-control"
                                placeholder="Enter amount"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select class="form-select">

                                <option>Paid</option>
                                <option>Pending</option>
                                <option>Overdue</option>

                            </select>

                        </div>

                    </div>

                    <div class="text-end mt-4">

                        <a href="billing.php"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-success">

                            <i class="bi bi-plus-circle"></i>
                            Add Invoice

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>

<script>
function addInvoice(event) {

    event.preventDefault();

    alert("Invoice added successfully!");

    window.location.href = "billing.php";
}
</script>

<?php include '../includes/footer.php'; ?>