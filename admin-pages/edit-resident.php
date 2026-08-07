<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="main-content">

    <div class="container-fluid py-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">Edit Resident</h2>
                <p class="text-muted">
                    Update resident information.
                </p>
            </div>

            <a href="resident-details.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>

        </div>

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <form>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="Ahmed Ali">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="ahmed@gmail.com">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" value="+20 100 123 4567">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apartment</label>
                            <input type="text" class="form-control" value="A-203">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Building</label>
                            <select class="form-select">
                                <option selected>Building A</option>
                                <option>Building B</option>
                                <option>Building C</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Move In Date</label>
                            <input type="date" class="form-control" value="2025-01-10">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vehicle</label>
                            <input type="text" class="form-control" value="Toyota Corolla">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Plate Number</label>
                            <input type="text" class="form-control" value="ABC-1234">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Parking Slot</label>
                            <input type="text" class="form-control" value="A-15">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select class="form-select">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>

                        </div>

                    </div>

                    <div class="text-end mt-4">

                        <a href="resident-details.php"
                           class="btn btn-secondary">
                            Cancel
                        </a>

                        <button
                         type="button"
                         class="btn btn-success"
                        onclick="saveResident()">
                            Save Changes
                            </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<script>
function saveResident(){
    alert("Resident information updated successfully.");
    window.location.href="resident-details.php";
}
</script>
<?php include '../includes/footer.php'; ?>