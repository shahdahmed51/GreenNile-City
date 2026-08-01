<?php $current_page = basename($_SERVER['PHP_SELF']);?>
<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php';
 ?>

<div class="main-content">
    <div class="container mt-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Parking Overview</h2>

        <button class="btn btn-success">
            <i class="fa-solid fa-plus"></i>
            Add Parking
        </button>
    </div>

    <!-- Statistics Cards -->
    <div class="row">

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Total Slots</p>
                    <h3 class="fw-bold">320</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Available</p>
                    <h3 class="text-success fw-bold">82</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Occupied</p>
                    <h3 class="text-warning fw-bold">210</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <p class="text-muted mb-1">Reserved</p>
                    <h3 class="text-danger fw-bold">128</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- Second Row -->
    <div class="row mt-3">

        <!-- Parking Usage -->
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    <h5 class="mb-4">Parking Usage</h5>
                              
                    <div class="d-flex justify-content-center align-items-center" style="height:250px;">

                        <div class="rounded-circle border border-4 border-success"
                             style="width:180px;height:180px;">
                            

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Recent Reservations -->
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">

                    <h5 class="mb-4">Recent Reservations</h5>

                    <p class="text-muted">
                        No reservations yet.
                    </p>

                </div>
            </div>
        </div>

    </div>

</div>


    </div>

</div>
</div>



<?php include '../includes/footer.php'; ?>