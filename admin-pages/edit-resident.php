<?php
$residentId = $_GET['id'] ?? 1;
$residents = [
    1 => [
        "name" => "HA",
        "apartment" => "A-204",
        "phone" => "+20 100 123 4567",
        "moveIn" => "15 Jan 2025",
        "status" => "Active"
    ],
    2 => [
        "name" => "KA",
        "apartment" => "B-205",
        "phone" => "+20 100 123 4567",
        "moveIn" => "1 Aug 2026",
        "status" => "Passive"
    ],
    3 => [
        "name" => "NM",
        "apartment" => "A-207",
        "phone" => "+20 107 652 3458",
        "moveIn" => "26 Jul 2025",
        "status" => "Active"
    ],
    4 => [
        "name" => "BT",
        "apartment" => "A-308",
        "phone" => "+20 155 123 4567",
        "moveIn" => "6 Mar 2025",
        "status" => "Passive"
    ],
    5 => [
        "name" => "AS",
        "apartment" => "B-200",
        "phone" => "+20 100 235 7643",
        "moveIn" => "10 Jan 2026",
        "status" => "Active"
    ]
];
$resident = $residents[$residentId] ?? $residents[1];
?>
<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar.php");
 ?>
<link rel="stylesheet" href="/GreenNile-City/assets/css/edit-resident.css">
<div class="edit-container">
    <div class="edit-card">
         <h2>Edit Resident</h2>
         <p class="subtitle">
            Update resident information
         </p>
         <form action="" method="POST">
            <div class="form-row">
                 <div class="form-group">
                      <label>Resident Name</label>
                      <input type="text" name="name" value="<?= $resident['name']?>">
                 </div>
                 <div class="form-group">
                      <label>Apartment</label>
                      <input type="text" name="apartment" value="<?= $resident['apartment']?>">
                 </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                     <label>Phone</label>
                     <input type="text" name="phone" value="<?= $resident['phone']?>">
                </div>
                <div class="form-group">
                    <label>Move In</label>
                    <input type="text" name="moveIn" value="<?= $resident['moveIn']?>">
                </div>
            </div>
            <div class="form-group">
                 <label>Status</label>
                 <select name="status">
                    <option value="Active" <?= $resident['status']=='Active'?'selected':' '?>>
                        Active
                    </option>
                    <option value="Passive" <?= $resident['status']=='Passive'?'selected':' '?>>
                        Passive
                    </option>
                 </select>
            </div>
            <div class="form-actions">
                <button type="submit" class="update-btn">
                    Update Resident
                </button>
                <a href="resident.php" class="cancel-btn">
                    Cancel
                </a>
            </div>
         </form>
    </div>
</div>
<?php include("../includes/footer.php");
 ?>