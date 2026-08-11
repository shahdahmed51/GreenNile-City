<?php

$current_page = basename($_SERVER['PHP_SELF']);

include("../includes/header.php");

$requestId = $_GET['id'] ?? '';

$requests = [
    [
        "id" => "MR001",
        "title" => "Water leakage in kitchen",
        "category" => "Plumbing",
        "priority" => "High",
        "status" => "In Progress",
        "date" => "12 May 2026",
        "apartment" => "A-204",
        "assigned" => "Ahmed Hassen",
        "description" => "There is a water leakage in the kitchen.",
        "image" => "/GREENNILE-CITY/assets/images/waterReq.jpeg"
    ],

    [
        "id" => "MR002",
        "title" => "AC not cooling",
        "category" => "Electrical",
        "priority" => "Medium",
        "status" => "Pending",
        "date" => "11 May 2026",
        "apartment" => "A-205",
        "assigned" => "Habiba Emad",
        "description" => "The AC is not cooling properly.",
        "image" => "/GREENNILE-CITY/assets/images/conditionerReq.jpeg"
    ],

    [
        "id" => "MR003",
        "title" => "Parking gate not working",
        "category" => "General",
        "priority" => "High",
        "status" => "In Progress",
        "date" => "11 May 2026",
        "apartment" => "B-102",
        "assigned" => "Karim Ahmed",
        "description" => "The parking gate is not working properly.",
        "image" => "/GREENNILE-CITY/assets/images/parkingReq.jpeg"
    ],
    [
        "id"=>"MR004",
        "title"=>"Light flickering",
        "resident"=>"Nour Ali",
        "apartment"=>"A-102",
        "category"=>"Electrical",
        "priority"=>"Low",
        "status"=>"Completed",
        "date"=>"10 May 2026",
        "assigned"=>"Youssef Samir",
        "phone"=>"+20 100 912 345 6789",
        "email"=>"youssef@greennile.com",
        "description"=>"Bedroom light keeps flickering.",
        "image" =>"/GREENNILE-CITY/assets/images/lightReq.jpeg"
    ],
    [
        "id"=>"MR005",
        "title"=>"Elevator not working",
        "resident"=>"Nada Mohamed",
        "apartment"=>"D-402",
        "category"=>"Mechanical",
        "priority"=>"High",
        "status"=>"Pending",
        "date"=>"13 May 2026",
        "assigned"=>"Ahmed Mostafa",
        "phone"=>"+20 100 125 378 9647",
        "email"=>"ahmed@greennile.com",
        "description"=>"Elevator has stopped working since morning.",
        "image" =>"/GREENNILE-CITY/assets/images/elevatorReq.jpeg"
    ]

];
$request = null;
foreach ($requests as $item) {
    if ($item["id"] === $requestId) {
        $request = $item;
        break;
    }

}
if (!$request){
    die("Maintenance request not found.");
}
?>
<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/maintenanceReq.css">
<div class="main-content-full">
    <!-- Page Header -->
    <div class="page-header">
        <a href="maintenance-user.php" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Maintenance Requests
        </a>
        <h2>Maintenance Request Details</h2>
        <p>View and track your maintenance request.</p>
    </div>
    <div class="details-container">
        <!-- LEFT SIDE -->
        <div class="left-side">
            <!-- Request Card -->
            <div class="request-card">
                <div class="card-title">
                    <h3>Request Information</h3>
                </div>
                <div class="request-info">
                    <div class="info-box">
                        <span>Request ID</span>
                        <p>
                            <?= htmlspecialchars($request["id"]) ?>
                        </p>
                    </div>
                    <div class="info-box">
                        <span>Title</span>
                        <p>
                            <?= htmlspecialchars($request["title"]) ?>
                        </p>
                    </div>
                    <div class="info-box">
                        <span>Category</span>
                        <p>
                            <?= htmlspecialchars($request["category"]) ?>
                        </p>
                    </div>
                    <div class="info-box">
                        <span>Apartment</span>
                        <p>
                            <?= htmlspecialchars($request["apartment"]) ?>
                        </p>
                    </div>
                    <div class="info-box">
                        <span>Priority</span>
                        <span class="priority <?= strtolower($request["priority"]) ?>">
                            <?= htmlspecialchars($request["priority"]) ?>
                        </span>
                    </div>
                    <div class="info-box">
                        <span>Status</span>
                        <span class="status <?= strtolower(str_replace(' ', '-', $request["status"])) ?>">
                            <?= htmlspecialchars($request["status"]) ?>
                        </span>
                    </div>
                    <div class="info-box">
                        <span>Date</span>
                        <p>
                            <?= htmlspecialchars($request["date"]) ?>
                        </p>
                    </div>
                </div>
                <!-- Description -->
                <div class="description">
                    <h4>Description</h4>
                    <p>
                        <?= htmlspecialchars($request["description"]) ?>
                    </p>
                </div>
                <!-- Image -->
                <div class="description">
                    <h4>Request Image</h4>
                    <div class="images-grid">
                        <img src="<?= htmlspecialchars($request["image"]) ?>"alt="Maintenance Request">
                    </div>
                </div>
            </div>
        </div>
        <!-- MIDDLE SIDE -->
        <div class="middle-side">
            <!-- Technician -->
            <div class="technician-card">
                <div class="card-title">
                    <h3>Assigned Technician</h3>
                </div>
                <div class="technician-info">
                    <div class="tech-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <h4>
                        <?= htmlspecialchars($request["assigned"]) ?>
                    </h4>
                    <p class="job-title">
                        Maintenance Technician
                    </p>
                    <div class="tech-details">
                        <div class="detail-row">
                            <i class="bi bi-telephone"></i>
                            <span>
                                +20 100 123 4567
                            </span>
                        </div>
                        <div class="detail-row">
                            <i class="bi bi-envelope"></i>
                            <span>
                                technician@example.com
                            </span>
                        </div>
                    </div>
                    <button class="contact-btn">
                        <i class="bi bi-chat"></i>
                        Contact Technician
                    </button>
                </div>
            </div>
            <!-- Timeline -->
            <div class="timeline-card">
                <div class="card-title">
                    <h3>Request Timeline</h3>
                </div>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <div class="timeline-content">
                            <h5>Request Submitted</h5>
                            <small>
                                <?= htmlspecialchars($request["date"]) ?>
                            </small>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <div class="timeline-content">
                            <h5>Technician Assigned</h5>
                            <small>
                                Technician assigned to request
                            </small>
                        </div>
                    </div>

                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <div class="timeline-content">
                            <h5>
                                <?= htmlspecialchars($request["status"]) ?>
                            </h5>
                            <small>
                                Current request status
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../includes/footer.php"); ?>