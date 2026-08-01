<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<?php include("../includes/header.php"); ?>
<?php include("../includes/sidebar.php");
 ?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/residents.css">

<div class="main-content">
   <div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="page-title">Residents List</h2>
            <p class="page-subtitle">
                Manage all residents information
            </p>
        </div>

        <button class="btn btn-success add-btn">
            <i class="bi bi-plus-lg"></i>
            Add Resident
        </button>

    </div>

</div>
<div class="resident-tools">
      <div class="search-box">
           <i class="bi bi-search"></i>
           <input type="text" id="searchInput" placeholder="Search residents....">
      </div>
      <div class="filters">
           <select class="form-select">
            <option>All Towers</option>
            <option>Tower A</option>
            <option>Tower B</option>
            <option>Tower C</option>
           </select>
           <select class="form-select" id="statusFilter">
           <option value="all">All Status</option>
           <option value="active">Active</option>
           <option value="inactive">Inactive</option>
           </select>

        <select class="form-select">
            <option>Sort By</option>
            <option>Name</option>
            <option>Apartment</option>
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
    <tr>
    <td>
        <div class="resident-info">
            HA
        </div>
    </td>
    <td>A-204</td>
    <td>+20 100 123 4567</td>
    <td>15 Jan 2025</td>
    <td>
        <span class="status active">
            Active
        </span>
    </td>
    <td>
        <button class="action-btn view">
            <i class="bi bi-eye"></i>
        </button>
        <button class="action-btn edit">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="action-btn delete">
            <i class="bi bi-trash"></i>
        </button>
    </td>
    </tr>
    <tr>
    <td>
        <div class="resident-info">
            KA
        </div>
    </td>
    <td>B-205</td>
    <td>+20 100 123 4567</td>
    <td>1 Aug 2026</td>
    <td>
        <span class="status Passive">
            Passive
        </span>
    </td>
    <td>
        <button class="action-btn view">
            <i class="bi bi-eye"></i>
        </button>
        <button class="action-btn edit">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="action-btn delete">
            <i class="bi bi-trash"></i>
        </button>
    </td>
    </tr>
    <tr>
    <td>
        <div class="resident-info">
            NM
        </div>
    </td>
    <td>A-207</td>
    <td>+20 107 652 3458</td>
    <td>26 july 2025</td>
    <td>
        <span class="status active">
            Active
        </span>
    </td>
    <td>
        <button class="action-btn view">
            <i class="bi bi-eye"></i>
        </button>
        <button class="action-btn edit">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="action-btn delete">
            <i class="bi bi-trash"></i>
        </button>
    </td>
    </tr>
    <tr>
    <td>
        <div class="resident-info">
            BT
        </div>
    </td>
    <td>A-308</td>
    <td>+20 155 123 4567</td>
    <td>6 march 2025</td>
    <td>
        <span class="status Passive">
            Passive
        </span>
    </td>
    <td>
        <button class="action-btn view">
            <i class="bi bi-eye"></i>
        </button>
        <button class="action-btn edit">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="action-btn delete">
            <i class="bi bi-trash"></i>
        </button>
    </td>
    </tr>
    <tr>
    <td>
        <div class="resident-info">
            AS
        </div>
    </td>
    <td>B-200</td>
    <td>+20 100 235 7643</td>
    <td>10 Jan 2026</td>
    <td> 
        <span class="status active">
            Active
        </span>
    </td>
    <td>
        <button class="action-btn view">
            <i class="bi bi-eye"></i>
        </button>
        <button class="action-btn edit">
            <i class="bi bi-pencil"></i>
        </button>
        <button class="action-btn delete">
            <i class="bi bi-trash"></i>
        </button>
    </td>
    </tr>
            </tbody>
     </table>
</div>
</div>
<script src="/GREENNILE-CITY/assets/js/residents.js"></script>

<?php include("../includes/footer.php"); ?>