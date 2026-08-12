<?php
$current_page = basename($_SERVER['PHP_SELF']);

include "../config/connection.php";
include("../includes/header.php");
include("../includes/sidebar.php");


// =========================
// Dashboard Statistics
// =========================

// Total Residents
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM residents
");
if (!$result) {
    die("Query error (residents): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$totalResidents = $row['total'];


// Total Maintenance Requests
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM maintenance_requests
");
if (!$result) {
    die("Query error (maintenance total): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$totalMaintenance = $row['total'];


// Open Maintenance Requests
$result = mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM maintenance_requests
    WHERE status = 'Open'
");
if (!$result) {
    die("Query error (open maintenance): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$openMaintenance = $row['total'];


// Monthly Revenue
$result = mysqli_query($conn, "
    SELECT COALESCE(SUM(amount), 0) AS total
    FROM payments
    WHERE status = 'Paid'
    AND MONTH(paid_at) = MONTH(CURDATE())
    AND YEAR(paid_at) = YEAR(CURDATE())
");
if (!$result) {
    die("Query error (monthly revenue): " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);
$monthlyRevenue = $row['total'];


// =========================
// Recent Activities
// =========================

$activities = mysqli_query($conn, "

    SELECT 
        'maintenance' AS type,
        title AS activity,
        created_at
    FROM maintenance_requests

    UNION ALL

    SELECT
        'payment' AS type,
        CONCAT('Payment received: $', amount) AS activity,
        created_at
    FROM payments
    WHERE status = 'Paid'

    UNION ALL

    SELECT
        'resident' AS type,
        CONCAT('New resident registered: ', full_name) AS activity,
        created_at
    FROM residents

    UNION ALL

    SELECT
        'parking' AS type,
        'Parking reservation' AS activity,
        created_at
    FROM parking_reservations

    ORDER BY created_at DESC
    LIMIT 5

");

if (!$activities) {
    die("Query error (activities): " . mysqli_error($conn));
}


// =========================
// Chart Data
// =========================


// Get selected period
$period = $_GET['period'] ?? 'this_month';

// Set date condition
if ($period == 'last_month') {

    $dateCondition = "
        created_at >= DATE_FORMAT(CURRENT_DATE - INTERVAL 1 MONTH, '%Y-%m-01')
        AND created_at < DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
    ";

} elseif ($period == 'this_year') {

    $dateCondition = "
        created_at >= DATE_FORMAT(CURRENT_DATE, '%Y-01-01')
        AND created_at < DATE_FORMAT(CURRENT_DATE + INTERVAL 1 YEAR, '%Y-01-01')
    ";

} else {

    // This Month
    $dateCondition = "
        created_at >= DATE_FORMAT(CURRENT_DATE, '%Y-%m-01')
        AND created_at < DATE_FORMAT(CURRENT_DATE + INTERVAL 1 MONTH, '%Y-%m-01')
    ";
}


// Get maintenance requests for selected period
$chartQuery = mysqli_query($conn, "
    SELECT status, COUNT(*) AS total
    FROM maintenance_requests
    WHERE $dateCondition
    GROUP BY status
");

if (!$chartQuery) {
    die("Query error (chart data): " . mysqli_error($conn));
}


// Default values
$chartData = [
    'Open' => 0,
    'In Progress' => 0,
    'Done' => 0,
    'Canceled' => 0
];

// Lowercase/trimmed lookup map so DB values like 'open', ' Open ', 'OPEN'
// still match the keys above instead of silently staying at 0.
// Also strips underscores (e.g. 'in_progress' -> 'in progress') and
// normalizes 'cancelled' (British) to 'canceled' (American) so both
// spellings match the same chart bucket.
function normalizeStatus($value) {
    $value = strtolower(trim($value));
    $value = str_replace('_', ' ', $value);
    $value = str_replace('cancelled', 'canceled', $value);
    return $value;
}

$statusLookup = [];
foreach ($chartData as $label => $val) {
    $statusLookup[normalizeStatus($label)] = $label;
}


// Put database values into chart
while ($row = mysqli_fetch_assoc($chartQuery)) {

    $status = normalizeStatus($row['status']);

    if (isset($statusLookup[$status])) {
        $label = $statusLookup[$status];
        $chartData[$label] = (int)$row['total'];
    }
}

?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/dashboard.css">

<body>

<div class="main-content">

    <!-- =========================
         Page Header
    ========================== -->

    <div class="page-header">

        <h2>Good Morning, Admin! 👋</h2>

        <p>Here's what's happening today.</p>

    </div>


    <!-- =========================
         Cards
    ========================== -->

    <div class="cards">


        <!-- Total Residents -->

        <div class="card">

            <div class="card-top">

                <h4>Total Residents</h4>

            </div>

            <h2><?= $totalResidents ?></h2>

        </div>


        <!-- Maintenance Requests -->

        <div class="card">

            <div class="card-top">

                <h4>Maintenance Requests</h4>

            </div>

            <h2><?= $totalMaintenance ?></h2>

        </div>


        <!-- Open Incidents -->

        <div class="card">

            <div class="card-top">

                <h4>Open Incidents</h4>

            </div>

            <h2><?= $openMaintenance ?></h2>

        </div>


        <!-- Monthly Revenue -->

        <div class="card">

            <div class="card-top">

                <h4>Monthly Revenue</h4>

            </div>

            <h2>
                $<?= number_format($monthlyRevenue, 2) ?>
            </h2>

        </div>

    </div>


    <!-- =========================
         Chart + Activities
    ========================== -->

    <div class="dashboard-grid">


        <!-- =========================
             Chart
        ========================== -->

        <div class="chart">

            <div class="chart-header">
                <h3>Requests Overview</h3>

                <select id="periodSelect" onchange="changePeriod(this.value)">

    <option value="this_month"
        <?= $period == 'this_month' ? 'selected' : '' ?>>
        This Month
    </option>

    <option value="last_month"
        <?= $period == 'last_month' ? 'selected' : '' ?>>
        Last Month
    </option>

    <option value="this_year"
        <?= $period == 'this_year' ? 'selected' : '' ?>>
        This Year
    </option>

</select>

            </div>


            <canvas id="myChart"></canvas>

        </div>


        <!-- =========================
             Recent Activities
        ========================== -->

        <div class="activities">

            <h3>Recent Activities</h3>

            <ul>

                <?php while ($activity = mysqli_fetch_assoc($activities)): ?>

                    <li>

                        <span class="icon">

                            <?php if ($activity['type'] == 'maintenance'): ?>

                                🔧

                            <?php elseif ($activity['type'] == 'payment'): ?>

                                💰

                            <?php elseif ($activity['type'] == 'resident'): ?>

                                👥

                            <?php elseif ($activity['type'] == 'parking'): ?>

                                🚗

                            <?php endif; ?>

                        </span>

                        <?= htmlspecialchars($activity['activity']) ?>

                    </li>

                <?php endwhile; ?>

            </ul>

        </div>

    </div>

</div>


<!-- =========================
     Chart.js
========================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- Send PHP data to JavaScript -->

<script>

    const chartData = <?= json_encode($chartData) ?>;

</script>


<!-- Dashboard JavaScript -->

<script src="/GREENNILE-CITY/assets/js/dashboard.js"></script>



</body>


<?php include '../includes/footer.php'; ?>