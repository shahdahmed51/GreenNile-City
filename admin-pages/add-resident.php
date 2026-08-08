<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>
<div class="main-content">
    <div class="container-fluid py-4">
        <!-- page header -->
         <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Add Resident</h2>
                <p class="text-muted">
                    Add a new resident to the system.
                </p>
            </div>
            <a href="resident.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
                Back
            </a>
         </div>
         <!-- form card -->
          <div class="card shadow-sm border-0">
            <div class="card-body">
                <form onsubmit="addResident(event)">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="enter full name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="enter email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" placeholder="enter phone number" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Apartment</label>
                            <input type="text" class="form-control" placeholder="example: A-203" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Building</label>
                            <select class="form-select" required>
                                <option value="">Select Building</option>
                                <option>Building A</option>
                                <option>Building B</option>
                                <option>Building C</option>
                                <option>Building D</option>
                            </select>
                        </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label">Move In Date</label>
                            <input type="date" class="form-control" required>
                         </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label">Vehicle</label>
                            <input type="text" class="form-control" placeholder="example: toyota corolla" required>
                         </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label">Plate Number</label>
                            <input type="text" class="form-control" placeholder="example: ABC-1234" required>
                         </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label">Parking Slot</label>
                            <input type="text" class="form-control" placeholder="example: A-15" required>
                         </div>
                         <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                         </div>
                         
                    </div>

                    <!-- buttons -->
                     <div class="text-end mt-4">
                        <a href="resident.php" class="btn btn-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-person-plus"></i>
                            Add Resident
                        </button>
                     </div>
                </form>
            </div>
          </div>
    </div>
</div>
<script>
    function addResident(event){
        event.preventDefult();
        alert("Resident added successfully!");
        window.location.href="residents.php";
    }
</script>
<?php include '../includes/footer.php'; ?>