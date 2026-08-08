<?php
$residentId = $_GET['id'] ?? 1;
$residents = [
    1 => [
        "name" => "HA",
        "apartment" => "A-204"
    ],
    2 => [
        "name" => "KA",
        "apartment" => "B-205"
    ],
    3 => [
        "name" => "NM",
        "apartment" => "A-207"
    ],
    4 => [
        "name" => "BT",
        "apartment" => "A-308"
    ],
    5 => [
        "name" => "AS",
        "apartment" => "B-200"
    ]
];
$resident = $residents[$residentId] ?? $residents[1];
include("../includes/header.php");
?>
<?php include("../includes/sidebar.php");
 ?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/delete-resident.css">
<div class="delete-container">
    <div class="delete-card">
        <div class="delete-header">
            <i class="bi bi-trash"></i>
            <h2>Delete Resident</h2>
        </div>
        <div class="delete-content">
            <i class="bi bi-exclamation-triangle warning-icon"></i>
            <h3>
                Are you sure you want to delete this resident?
            </h3>
            <p class="resident-details">
                Resident:
                <strong><?= $resident['name'] ?></strong>
                <br>
                Apartment:
                <strong><?= $resident['apartment'] ?></strong>
            </p>
            <div class="delete-actions">
                <form action="" method="POST">
                    <input
                        type="hidden" name="id" value="<?= $residentId ?>">
                    <button type="submit" class="delete-confirm-btn">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </form>
                <a href="residents.php" class="cancel-delete-btn">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.php"); ?>