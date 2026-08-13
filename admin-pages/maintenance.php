<?php
$current_page = basename($_SERVER['PHP_SELF']);

include("../includes/header.php");
include("../includes/sidebar.php");
require_once "../config/connection.php";

// Get maintenance requests from database
$sql = "SELECT 
            request_id,
            resident_id,
            title,
            description,
            priority,
            status,
            created_at,
            assigned_to
        FROM maintenance_requests
        ORDER BY created_at DESC";

$result = $conn->query($sql);

if (!$result) {
    die("Database Error: " . $conn->error);
}

$requests = $result->fetch_all(MYSQLI_ASSOC);
?>

<link rel="stylesheet" href="/GreenNile-City/assets/css/maintenance.css">

<div class="main-content">

    <div class="page-header">
        <h2>Maintenance Requests</h2>
        <p>View and manage maintenance requests.</p>
    </div>

    <div class="maintenance-card">

        <div class="top-bar">

            <div class="search-box">
                <i class="bi bi-search"></i>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search requests..."
                >
            </div>

            <select id="statusFilter">
                <option value="all">All Status</option>
                <option value="pending">Pending</option>
                <option value="in progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>

            <a href="add-maintenanceAdmin.php" class="new-btn">
                <i class="bi bi-plus-lg"></i>
                New Request
            </a>

        </div>


        <table class="table table-hover align-middle text-center">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Assigned To</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php if (count($requests) > 0): ?>

                    <?php foreach ($requests as $request): ?>

                        <tr>

                            <!-- ID -->
                            <td>
                                <?= htmlspecialchars($request['request_id']) ?>
                            </td>


                            <!-- Title -->
                            <td>
                                <?= htmlspecialchars($request['title']) ?>
                            </td>

                            <!-- Priority -->
                            <td>
                                <span class="priority <?= strtolower(htmlspecialchars($request['priority'])) ?>">
                                    <?= htmlspecialchars($request['priority']) ?>
                                </span>
                            </td>


                            <!-- Status -->
                            <td>
                                <span class="status <?= strtolower(str_replace(' ', '-', htmlspecialchars($request['status']))) ?>">
                                    <?= htmlspecialchars($request['status']) ?>
                                </span>
                            </td>


                            <!-- Date -->
                            <td>
                                <?= htmlspecialchars($request['created_at']) ?>
                            </td>


                            <!-- Assigned To -->
                            <td>
                                <?= htmlspecialchars($request['assigned_to'] ?? '-') ?>
                            </td>


                            <!-- Actions -->
                            <td>

                                <a
                                    href="maintenanceReq.php?id=<?= urlencode($request['request_id']) ?>"
                                    class="action-btn view"
                                >
                                    <i class="bi bi-eye"></i>
                                </a>

                                 <a
    href="edit-maintenance.php?id=<?= urlencode($request['request_id']) ?>"
    class="action-btn edit"
>
    <i class="bi bi-pencil"></i>
</a>
                                <a
                                    href="delete-maintenance.php?id=<?= urlencode($request['request_id']) ?>"
                                    class="action-btn delete"
                                    onclick="return confirm('Are you sure you want to delete this request?');"
                                >
                                    <i class="bi bi-trash"></i>
                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8">
                            No maintenance requests found.
                        </td>
                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>


<script src="/GreenNile-City/assets/js/maintenance.js"></script>

<?php include("../includes/footer.php"); ?>