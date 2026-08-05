<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>

<div class="container mt-4">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-success text-white">
            <h4 class="mb-0">
                <i class="fa-solid fa-square-parking me-2"></i>
                Reserve Parking
            </h4>
        </div>

        <div class="card-body">

            <form action="" method="POST">

                <div class="row">

                    <!-- Vehicle -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Select Vehicle
                        </label>

                        <select class="form-select" name="vehicle">

                            <option selected disabled>
                                Choose Vehicle
                            </option>

                            <option>Toyota Corolla</option>
                            <option>Hyundai Elantra</option>

                        </select>

                    </div>

                    <!-- Zone -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Parking Zone
                        </label>

                        <select class="form-select" name="zone">

                            <option selected disabled>
                                Choose Zone
                            </option>

                            <option>Zone A</option>
                            <option>Zone B</option>
                            <option>Zone C</option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <!-- Slot -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Parking Slot
                        </label>

                        <select class="form-select" name="slot">

                            <option selected disabled>
                                Choose Slot
                            </option>

                            <option>A01</option>
                            <option>A02</option>
                            <option>B05</option>

                        </select>

                    </div>

                    <!-- Date -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Reservation Date
                        </label>

                        <input
                            type="date"
                            class="form-control"
                            name="date">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Start Time
                        </label>

                        <input
                            type="time"
                            class="form-control"
                            name="start_time">

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            End Time
                        </label>

                        <input
                            type="time"
                            class="form-control"
                            name="end_time">

                    </div>

                </div>

                <div class="mt-4">

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fa-solid fa-check me-2"></i>
                        Confirm Reservation

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