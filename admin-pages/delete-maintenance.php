<?php
$requestId = $_GET['id'] ?? 'MR001';
$requests = [
    "MR001" => [
        "id"=>"MR001",
        "assigned"=>"Ahmed Hassen"
    ],
     "MR002" => [
        "id" => "MR002",
        "assigned" => "Habiba Emad"
    ],
    "MR003" => [
        "id" => "MR003",
        "assigned" => "Karim Ahmed"
    ],
    "MR004"  => [
        "id" => "MR004",
        "assigned" => "Nour Ali"
    ],
    "MR005" => [
        "id" => "MR005",
        "assigned" => "Nada Mohmed"
    ]
];
$request = $requests[$requestId] ?? $requests['MR001'];
include("../includes/header.php");
?>
<?php include("../includes/sidebar.php");
 ?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/delete-resident.css">
<div class="delete-container">
    <div class="delete-card">
        <div class="delete-header">
            <i class="bi bi-trash"></i>
            <h2>Delete Request</h2>
        </div>
        <div class="delete-content">
            <i class="bi bi-exclamation-triangle warning-icon"></i>
            <h3>
                Are you sure you want to delete this Request?
            </h3>
            <p class="resident-details">
                Request:
                <strong><?= $request['id'] ?></strong>
                <br>
                Assigned:
                <strong><?= $request['assigned'] ?></strong>
            </p>
            <div class="delete-actions">
                <form action="" method="POST">
                    <input
                        type="hidden" name="id" value="<?= $requestId ?>">
                    <button type="submit" class="delete-confirm-btn">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </form>
                <a href="maintenance.php" class="cancel-delete-btn">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.php"); ?>