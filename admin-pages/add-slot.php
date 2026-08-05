<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">
            <h4 class="mb-0">
                <i class="fa-solid fa-square-parking me-2"></i>
                Add Parking Slot
            </h4>
        </div>

        <div class="card-body">

            <form action="" method="POST">

                <div class="row">

                    <!-- Zone -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Parking Zone
                        </label>

                        <select class="form-select" name="zone_id">

                            <option selected disabled>
                                Select Zone
                            </option>

                            <option value="1">
                                Zone A
                            </option>

                            <option value="2">
                                Zone B
                            </option>

                            <option value="3">
                                Zone C
                            </option>

                        </select>

                    </div>

                    <!-- Slot Number -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Slot Number
                        </label>

                        <input
                            type="text"
                            name="slot_number"
                            class="form-control"
                            placeholder="Example: A01">

                    </div>

                </div>

                <div class="row">

                    <!-- Status -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select class="form-select" name="status">

                            <option value="available">
                                Available
                            </option>

                            <option value="occupied">
                                Occupied
                            </option>

                            <option value="reserved">
                                Reserved
                            </option>

                        </select>

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fa-solid fa-plus"></i>
                        Add Slot

                    </button>

                    <a
                        href="parking.php"
                        class="btn btn-secondary">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>