<?php
$current_page = basename($_SERVER['PHP_SELF']);
include("../includes/header.php");
include("../includes/sidebar.php");
?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/noDataFound.css">

<div class="main-content">

    <section class="eco-empty-state">

        <div class="empty-icon">
            <i class="fa-solid fa-circle-exclamation"></i>
        </div>

        <h2>No Data Found</h2>

        <p>There is no data to display at the moment.</p>

        <button class="btn-primary" id="noDataBtn">
            Go Back
        </button>

    </section>

</div>
<script src="/GREENNILE-CITY/assets/js/noDataFound.js"></script>

<?php include("../includes/footer.php"); ?>