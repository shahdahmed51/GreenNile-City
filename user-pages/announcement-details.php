<?php

$id = $_GET['id'] ?? 1;

$announcements = [

    1 => [
        "title" => "Water Maintenance",
        "category" => "Maintenance",
        "date" => "May 30, 2026",
        "icon" => "bi-droplet-fill",
        "color" => "green",
        "text" => "Water maintenance will take place tomorrow from 10:00 AM to 2:00 PM.",
        "details" => "During this period, water service may be temporarily unavailable in some buildings. We apologize for any inconvenience and appreciate your understanding."
    ],

    2 => [
        "title" => "Community Meeting",
        "category" => "General",
        "date" => "May 25, 2026",
        "icon" => "bi-people-fill",
        "color" => "purple",
        "text" => "A community meeting will be held on May 25 at 4:00 PM in the main hall.",
        "details" => "Residents are welcome to attend the meeting and discuss community topics, suggestions, and upcoming activities."
    ],

    3 => [
        "title" => "New Facility Opening",
        "category" => "Events",
        "date" => "May 18, 2026",
        "icon" => "bi-building",
        "color" => "blue",
        "text" => "We are excited to announce the opening of our new facility.",
        "details" => "The new facility is now available for residents. More information about the available services and opening hours will be provided by the management."
    ],

    4 => [
        "title" => "Emergency Drill",
        "category" => "Events",
        "date" => "May 17, 2026",
        "icon" => "bi-calendar-event-fill",
        "color" => "orange",
        "text" => "Fire drill will be conducted on May 17 at 4:00 PM.",
        "details" => "All residents are requested to follow the safety instructions during the drill and cooperate with the management team."
    ]

];

if (isset($announcements[$id])) {
    $announcement = $announcements[$id];
} else {
    $announcement = $announcements[1];
}

include '../includes/header.php';
include '../includes/navbar.php';
include '../includes/sidebar.php';

?>

<link rel="stylesheet" href="../assets/css/announcement-details.css">

<div class="main-content">

    <div class="container-fluid py-4">

        <a href="user-announcements.php" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Announcements
        </a>


        <div class="details-card">

            <div class="details-icon <?php echo $announcement['color']; ?>">
                <i class="bi <?php echo $announcement['icon']; ?>"></i>
            </div>


            <span class="details-category <?php echo $announcement['color']; ?>">
                <?php echo $announcement['category']; ?>
            </span>


            <h2>
                <?php echo $announcement['title']; ?>
            </h2>


            <div class="details-date">
                <i class="bi bi-calendar3"></i>
                <?php echo $announcement['date']; ?>
            </div>


            <hr>


            <p class="details-text">
                <?php echo $announcement['text']; ?>
            </p>


            <p class="details-text">
                <?php echo $announcement['details']; ?>
            </p>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>