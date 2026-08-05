<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm border-0">

                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">
                        <i class="fa-solid fa-trash me-2"></i>
                        Delete Parking Slot
                    </h4>
                </div>

                <div class="card-body text-center">

                    <i class="fa-solid fa-triangle-exclamation text-danger mb-3"
                        style="font-size:70px;"></i>

                    <h5 class="mb-3">
                        Are you sure you want to delete this parking slot?
                    </h5>

                    <p class="text-muted">
                        Slot Number:
                        <strong>A01</strong>
                    </p>

                    <form action="" method="POST">

                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-trash me-2"></i>
                            Delete
                        </button>

                        <a href="parking.php" class="btn btn-secondary">
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>