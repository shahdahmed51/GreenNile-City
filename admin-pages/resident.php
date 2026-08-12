<?php

$current_page = basename($_SERVER['PHP_SELF']);

require_once "../config/connection.php";

include("../includes/header.php");


// =====================================
// Get Residents From Database
// =====================================

$sql = "SELECT
            resident_id,
            full_name,
            phone,
            email,
            address,
            building,
            unit_number,
            created_at
        FROM residents
        ORDER BY resident_id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>

<?php include("../includes/sidebar.php"); ?>

<link rel="stylesheet" href="/GreenNile-City/assets/css/residents.css">


<div class="main-content">

    <div class="container-fluid py-4">


        <!-- Page Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="page-title">
                    Residents List
                </h2>

                <p class="page-subtitle">
                    Manage all residents information
                </p>

            </div>


            <a
                href="add-resident.php"
                class="btn btn-success add-btn"
            >

                <i class="bi bi-plus-lg"></i>

                Add Resident

            </a>

        </div>



        <!-- Search -->

        <div class="resident-tools">

            <div class="search-box">

                <i class="bi bi-search"></i>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search residents...."
                >

            </div>

        </div>



        <!-- Residents Table -->

        <div class="table-card">

            <div class="table-responsive">

                <table
                    class="table align-middle"
                    id="residentTable"
                >

                    <thead>

                        <tr>

                            <th>Resident</th>

                            <th>Apartment</th>

                            <th>Contact</th>

                            <th>Building</th>

                            <th>Created At</th>

                            <th>Actions</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php if (mysqli_num_rows($result) > 0): ?>


                        <?php while (
                            $resident = mysqli_fetch_assoc($result)
                        ): ?>


                            <tr>


                                <!-- Resident -->

                                <td>

                                    <div class="resident-info">

                                        <?= htmlspecialchars(
                                            $resident['full_name']
                                        ) ?>

                                    </div>

                                </td>



                                <!-- Apartment -->

                                <td>

                                    <?= htmlspecialchars(
                                        $resident['unit_number']
                                    ) ?>

                                </td>



                                <!-- Contact -->

                                <td>

                                    <?= htmlspecialchars(
                                        $resident['phone']
                                    ) ?>

                                </td>



                                <!-- Building -->

                                <td>

                                    <?= htmlspecialchars(
                                        $resident['building']
                                    ) ?>

                                </td>



                                <!-- Created At -->

                                <td>

                                    <?= date(
                                        'd M Y',
                                        strtotime(
                                            $resident['created_at']
                                        )
                                    ) ?>

                                </td>



                                <!-- Actions -->

                                <td>

                                    <!-- View -->

                                    <a
                                        href="resident-details.php?id=<?= $resident['resident_id'] ?>"
                                        class="action-btn view"
                                        title="View Resident"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    <!-- Edit -->

                                    <a
                                        href="edit-resident.php?id=<?= $resident['resident_id'] ?>"
                                        class="action-btn edit"
                                        title="Edit Resident"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <!-- Delete -->

                                    <a
                                        href="delete-Resident.php?id=<?= $resident['resident_id'] ?>"
                                        class="action-btn delete"
                                        title="Delete Resident"
                                    >

                                        <i class="bi bi-trash"></i>

                                    </a>

                                </td>


                            </tr>


                        <?php endwhile; ?>


                    <?php else: ?>


                        <tr>

                            <td
                                colspan="6"
                                class="text-center text-muted py-4"
                            >

                                No residents found.

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>


    </div>

</div>



<script src="/GreenNile-City/assets/js/residents.js"></script>

<?php include("../includes/footer.php"); ?>