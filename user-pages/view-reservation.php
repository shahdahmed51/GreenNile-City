<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/user-sidebar.php'; ?>


<div class="container mt-4">


    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">


        <h2 class="fw-bold">
            Reservation Details
        </h2>


        <a href="my-reservations.php" class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Back

        </a>


    </div>




    <!-- Reservation Details Card -->

    <div class="card shadow-sm border-0">


        <div class="card-body">



            <div class="row">


                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        Parking Slot
                    </p>


                    <h5 class="fw-bold">
                        A01
                    </h5>


                </div>




                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        Vehicle
                    </p>


                    <h5 class="fw-bold">
                        Toyota Corolla
                    </h5>


                </div>





                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        Reservation Date
                    </p>


                    <h5 class="fw-bold">
                        14 May 2026
                    </h5>


                </div>





                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        Status
                    </p>



                    <span class="badge bg-success fs-6">
                        Confirmed
                    </span>


                </div>





                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        Start Time
                    </p>


                    <h5 class="fw-bold">
                        10:00 AM
                    </h5>


                </div>





                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        End Time
                    </p>


                    <h5 class="fw-bold">
                        12:00 PM
                    </h5>


                </div>





                <div class="col-md-6 mb-3">


                    <p class="text-muted mb-1">
                        Reservation Created
                    </p>


                    <h5 class="fw-bold">
                        10 May 2026
                    </h5>


                </div>




            </div>




            <hr>



            <div class="text-end">


                <a href="cancel-reservation.php"
                   class="btn btn-danger">


                    <i class="fa-solid fa-xmark"></i>

                    Cancel Reservation


                </a>


            </div>



        </div>


    </div>



</div>



<?php include '../includes/footer.php'; ?>