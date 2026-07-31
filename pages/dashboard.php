<?php 
include("../includes/header.php");
?>
<?php 
include("../includes/sidebar.php");
?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/dashboard.css">
<body>
    <div class="main-content">

    <div class="page-header">
        <h2>Good Morning, Admin! 👋</h2>
        <p>Here's what's happening today.</p>
    </div>

    <!-- Cards -->
    <div class="cards">

        <!-- Total Residents -->
        <div class="card">
            <div class="card-top">

                <h4>Total Residents</h4>

            </div>

            <h2>1,248</h2>

            <p class="increase">+12.5%</p>

        </div>

        <!-- Maintenance -->
        <div class="card">

            <div class="card-top">

                <h4>Maintenance Requests</h4>

                

            </div>

            <h2>32</h2>

            <p class="increase">+8.2%</p>

        </div>

        <!-- Open Incidents -->
        <div class="card">

            <div class="card-top">

                <h4>Open Incidents</h4>
            </div>

            <h2>18</h2>

            <p class="increase">+6.1%</p>

        </div>

        <!-- Revenue -->
        <div class="card">

            <div class="card-top">
                <h4>Monthly Revenue</h4>
            </div>

            <h2>$45,230</h2>

            <p class="increase">+15.3%</p>

        </div>

    </div>

    <!-- Chart + Activities -->
    <div class="dashboard-grid">

        <div class="chart">

    <div class="chart-header">

        <h3>Requests Overview</h3>

        <select>
            <option>This Month</option>
            <option>Last Month</option>
            <option>This Year</option>
        </select>

    </div>

    <canvas id="myChart"></canvas>

</div>

        <div class="activities">

            <h3>Recent Activities</h3>

            <ul>

                <li>
                    <span class="icon">

                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                        <path d="M16 4.5a4.5 4.5 0 0 1-1.703 3.526L13 5l2.959-1.11q.04.3.041.61" />
                        <path
                            d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.5 4.5 0 0 0 11.5 9" />
                    </svg>

                </span>
                    New maintenance request
                </li>

                <li>
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-cash-coin" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                        <path
                            d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668z" />
                        <path
                            d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                    </svg>
                </span>
                    Payment received
                </li>

                <li>
                    <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-people-fill" viewBox="0 0 16 16">
                        <path
                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                    </svg>
                </span>
                    New resident registered
                </li>
                <li>
                    <span id="carIcon" class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-car-front-fill" viewBox="0 0 16 16"> <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z"/></svg></span>
                    Parking reserved
                </li>

            </ul>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="/GREENNILE-CITY/assets/js/dashboard.js"></script>
</body>
<?php include '../includes/footer.php'; ?>