<?php
require_once "../includes/user-auth.php";
$current_page = basename($_SERVER['PHP_SELF']);

include("../includes/header.php");
include("../includes/user-sidebar.php");
?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/add-maintenance.css">
<div class="main-content">
    <div class="page-header">
        <h2>New Maintenance Request</h2>
        <p>Submit a new maintenance request.</p>
    </div>
    <div class="maintenance-form-card">
        <form action="" method="POST" enctype="multipart/form-data">
            <!-- Resident Information -->
            <div class="form-section">
                <h3>Resident Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="resident">Resident</label>
                        <input type="text" id="resident" value="Habiba" readonly>
                    </div>
                    <div class="form-group">
                        <label for="apartment">Apartment</label>
                        <input type="text" id="apartment" value="A-2004" readonly>
                    </div>
                </div>
            </div>
            <!-- Request Information -->
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
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="6" placeholder="Describe the maintenance problem..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Request Image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>
            </div>
            <!-- Buttons -->
            <div class="form-actions">
                <a href="maintenance-user.php" class="cancel-btn">
                    Cancel
                </a>
                <button type="submit" name="submit" class="submit-btn">
                <i class="bi bi-check-lg"></i>
                    Submit Request
                </button>
            </div>
        </form>
    </div>
</div>
<?php include("../includes/footer.php"); ?>