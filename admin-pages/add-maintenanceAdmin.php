<?php
$current_page = basename($_SERVER['PHP_SELF']);
include("../includes/header.php");
include("../includes/sidebar.php");
?>

<link rel="stylesheet" href="/GreenNile-city/assets/css/add-maintenance.css">
<div class="main-content">
    <div class="page-header">
        <h2>New Maintenance Request</h2>
        <p>Create a new maintenance request.</p>
    </div>
    <div class="maintenance-form-card">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Resident Information -->
            <div class="form-section">
                <h3>Resident Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="resident">Resident</label>
                        <select name="resident" id="resident" required>
                            <option value="">Select Resident</option>
                            <option value="Habiba AbdAlghany">
                                Habiba AbdAlghany
                            </option>
                            <option value="Ahmed Hassan">
                                Ahmed Hassan
                            </option>
                            <option value="Nour Ali">
                                Nour Ali
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="apartment">Apartment</label>
                        <input type="text" name="apartment" id="apartment" placeholder="e.g. A-204" required>
                    </div>
                </div>
            </div>
            <div class="form-section">
                <h3>Request Information</h3>
                <div class="form-group">
                    <label for="title">Request Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter request title" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="">Select Category</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="General">General</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="technician">Assign Technician</label>
                    <select name="technician" id="technician">
                        <option value="">Select Technician</option>
                        <option value="Ahmed Hassen">
                            Ahmed Hassen
                        </option>
                        <option value="Habiba Emad">
                            Habiba Emad
                        </option>
                        <option value="Karim Ahmed">
                            Karim Ahmed
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textare  name="description" id="description"rows="6" placeholder="Describe the maintenance problem..." required></textare>
                </div>
                <div class="form-group">
                    <label for="image">Request Image</label>
                    <input type="file" name="image" id="image" accept="image/*" >
                </div>
            </div>
            <!-- Buttons -->
            <div class="form-actions">
                <a href="maintenance.php" class="cancel-btn">
                    Cancel
                </a>
                <button type="submit" name="submit" class="submit-btn">
                    <i class="bi bi-check-lg"></i>
                    Create Request
                </button>
            </div>
        </form>
</div>
</div>
<?php include("../includes/footer.php"); ?>