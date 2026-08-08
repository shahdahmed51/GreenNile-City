<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<?php include("../includes/header.php"); ?>
<?php
$residents = [
    [
        "id" => 1,
        "name" => "HA",
        "apartment" => "A-204",
        "phone" => "+20 100 123 4567",
        "moveIn" => "15 Jan 2025",
        "status" => "Active"
    ],
    [
        "id" => 2,
        "name" => "KA",
        "apartment" => "B-205",
        "phone" => "+20 100 123 4567",
        "moveIn" => "1 Aug 2026",
        "status" => "Passive"
    ],
    [
        "id" => 3,
        "name" => "NM",
        "apartment" => "A-207",
        "phone" => "+20 107 652 3458",
        "moveIn" => "26 Jul 2025",
        "status" => "Active"
    ],
    [
        "id" => 4,
        "name" => "BT",
        "apartment" => "A-308",
        "phone" => "+20 155 123 4567",
        "moveIn" => "6 Mar 2025",
        "status" => "Passive"
    ],
    [
        "id" => 5,
        "name" => "AS",
        "apartment" => "B-200",
        "phone" => "+20 100 235 7643",
        "moveIn" => "10 Jan 2026",
        "status" => "Active"
    ]
]; ?>
<?php include("../includes/sidebar.php");
 ?>
<link rel="stylesheet" href="/GreenNile-city/assets/css/residents.css">

<div class="main-content">
   <div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">Residents List</h2>
            <p class="page-subtitle">
                Manage all residents information
            </p>
        </div>
        <a href="add-Resident.php" class="btn btn-success add-btn">
            <i class="bi bi-plus-lg"></i>
            Add Resident
        </a>
    </div>

</div>
<div class="resident-tools">
      <div class="search-box">
           <i class="bi bi-search"></i>
           <input type="text" id="searchInput" placeholder="Search residents....">
      </div>
      <div class="filters">
           <select class="form-select" id="statusFilter">
           <option value="all">All Status</option>
           <option value="active">Active</option>
           <option value="passive">Passive</option>
           </select>
      </div>
</div>
<div class="table-card">
     <table class="table align-middle" id="residentTable">
            <thead>
                <tr>
                    <th>Resident</th>
                    <th>Apartment</th>
                    <th>Contact</th>
                    <th>Move In</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($residents as $resident) { ?>
                <tr>
                   <td>
                     <div class="resident-info">
                       <?= $resident["name"] ?>
                     </div>
                   </td>
                    <td>
                       <?= $resident["apartment"] ?>
                    </td>
                    <td>
                       <?= $resident["phone"] ?>
                    </td>
                    <td>
                       <?= $resident["moveIn"] ?>
                   </td>
                    <td>
                       <span class="status <?= strtolower($resident["status"]) ?>">
                         <?= $resident["status"] ?>
                      </span>
                      
                   </td>
                    <td>
                       <a href="resident-details.php?id=<?= $resident['id'] ?>" class="action-btn view">
                          <i class="bi bi-eye"></i>
                      </a>
                      <a href="edit-Resident.php?id=<?= $resident['id'] ?>" class="action-btn edit">
                         <i class="bi bi-pencil"></i>
                      </a>
                      <a href="delete-Resident.php?id=<?= $resident['id'] ?>" class="action-btn delete">
                         <i class="bi bi-trash"></i>
                     </a>
                    </td>
              </tr>
       <?php } ?>
       </tbody>
     </table>
</div>
</div>
<script src="/GreenNile-City/assets/js/residents.js"></script>
<?php include("../includes/footer.php"); ?>