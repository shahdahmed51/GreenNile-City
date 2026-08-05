<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<div class="container mt-4">


    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">
            My Reservations
        </h2>


        <a href="reserve-parking.php" class="btn btn-success">

            <i class="fa-solid fa-square-parking"></i>
            Reserve Parking

        </a>


    </div>



    <!-- Reservations Table -->

    <div class="card shadow-sm border-0">


        <div class="card-body">


            <div class="table-responsive">


                <table class="table table-hover align-middle">


                    <thead class="table-light">

                        <tr>

                            <th>Slot</th>

                            <th>Vehicle</th>

                            <th>Date</th>

                            <th>Time</th>

                            <th>Status</th>

                            <th>Actions</th>

                        </tr>


                    </thead>



                    <tbody>


                        <tr>


                            <td>
                                A01
                            </td>


                            <td>
                                Toyota Corolla
                            </td>


                            <td>
                                14 May 2026
                            </td>


                            <td>
                                10:00 AM - 12:00 PM
                            </td>



                            <td>

                                <span class="badge bg-success">
                                    Confirmed
                                </span>

                            </td>



                            <td>


                                <a href="view-reservation.php"
                                   class="btn btn-sm btn-primary">

                                    <i class="fa-solid fa-eye"></i>

                                </a>



                                <a href="cancel-reservation.php"
                                   class="btn btn-sm btn-danger">

                                    <i class="fa-solid fa-xmark"></i>

                                </a>


                            </td>



                        </tr>





                        <tr>


                            <td>
                                B05
                            </td>


                            <td>
                                Hyundai Elantra
                            </td>


                            <td>
                                16 May 2026
                            </td>


                            <td>
                                02:00 PM - 04:00 PM
                            </td>



                            <td>

                                <span class="badge bg-warning text-dark">
                                    Pending
                                </span>

                            </td>



                            <td>


                                <a href="view-reservation.php"
                                   class="btn btn-sm btn-primary">

                                    <i class="fa-solid fa-eye"></i>

                                </a>



                                <a href="cancel-reservation.php"
                                   class="btn btn-sm btn-danger">

                                    <i class="fa-solid fa-xmark"></i>

                                </a>


                            </td>


                        </tr>





                    </tbody>



                </table>


            </div>


        </div>


    </div>



</div>


<?php include '../includes/footer.php'; ?>