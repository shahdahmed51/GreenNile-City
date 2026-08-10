<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar.php");?>
<div class="main-content">
    <div class="page-header">
          <div>
            <h1>Add Resident</h1>
            <p>Add a new resident to the system</p>
          </div>
    </div>
    <div class="resident-form-card">
        <form action="" method="POST">
            <div class="form-row">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" placeholder="Enter Full Name">
                </div>
                <div class="form-group">
                    <label for="apartment">Apartment</label>
                    <input type="text" id="apartment" name="apartment" placeholder="e.g. A-204">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" placeholder="Enter phone number">
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter email address">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="moveIn">Move-in Date</label>
                    <input type="date" id="moveIn" name="moveIn">
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="Active">Active</option>
                        <option value="Passive">Passive</option>
                    </select>
                </div>
            </div>
            <div class="form-actions">
                <a href="resident.php" class="cancel-btn">Cancel</a>
                <button type="submit" class="save-btn">
                    <i class="bi bi-check-lg"></i>
                    Add Resident
                </button>
            </div>
        </form>
    </div>
</div>