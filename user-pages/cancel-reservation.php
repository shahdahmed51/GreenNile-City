<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<?php include '../includes/sidebar.php'; ?>


<div class="container mt-4">


    <!-- Page Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">


        <h2 class="fw-bold text-danger">
            Cancel Reservation
        </h2>


        <a href="my-reservations.php" class="btn btn-secondary">

            <i class="fa-solid fa-arrow-left"></i>
            Back

        </a>


    </div>





    <!-- Confirmation Card -->

    <div class="card shadow-sm border-0">


        <div class="card-body text-center">


            <div class="mb-4">

                <i class="fa-solid fa-circle-exclamation text-danger"
                   style="font-size:60px;">
                </i>

            </div>



            <h4 class="fw-bold mb-3">

                Are you sure you want to cancel this reservation?

            </h4>




            <p class="text-muted">

                You are about to cancel your parking reservation:

            </p>




            <!-- Reservation Info -->

            <div class="row justify-content-center mt-4">


                <div class="col-md-6">


                    <div class="card bg-light border-0">


                        <div class="card-body">


                            <p class="mb-2">

                                <strong>Slot:</strong>
                                A01

                            </p>



                            <p class="mb-2">

                                <strong>Vehicle:</strong>
                                Toyota Corolla

                            </p>



                            <p class="mb-2">

                                <strong>Date:</strong>
                                14 May 2026

                            </p>



                            <p class="mb-0">

                                <strong>Time:</strong>
                                10:00 AM - 12:00 PM

                            </p>



                        </div>


                    </div>


                </div>


            </div>





            <!-- Buttons -->

            <div class="mt-4">


                <a href="my-reservations.php"
                   class="btn btn-secondary me-2">


                    No, Keep Reservation


                </a>





                <button class="btn btn-danger">


                    <i class="fa-solid fa-xmark"></i>

                    Yes, Cancel Reservation


                </button>



            </div>




        </div>


    </div>




</div>




<?php include '../includes/footer.php'; ?>