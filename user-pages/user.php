<?php
require_once "../includes/user-auth.php";
session_start();

require_once "../config/connection.php";


// ========================================
// CHECK LOGIN
// ========================================

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");
    exit();
}


// ========================================
// GET LOGGED-IN USER ID
// ========================================

$user_id = (int) $_SESSION["user_id"];


// ========================================
// GET USER + RESIDENT DATA
// ========================================

$sql = "
    SELECT
        u.user_id,
        u.username,
        u.email AS user_email,
        u.role,
        u.status,

        r.resident_id,
        r.full_name,
        r.phone,
        r.email AS resident_email,
        r.address,
        r.building,
        r.unit_number,
        r.created_at

    FROM users u

    LEFT JOIN residents r
        ON u.resident_id = r.resident_id

    WHERE u.user_id = ?

    LIMIT 1
";


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    die("Database error.");
}


mysqli_stmt_bind_param(
    $stmt,
    "i",
    $user_id
);


mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($result);


mysqli_stmt_close($stmt);


// ========================================
// CHECK USER
// ========================================

if (!$user) {

    session_destroy();

    header("Location: login.php");
    exit();
}


// ========================================
// DATA
// ========================================

$fullname = $user["full_name"] ?? $user["username"] ?? "User";

$email = $user["resident_email"]
    ?? $user["user_email"]
    ?? "";

$phone = $user["phone"] ?? "";

$building = $user["building"] ?? "";

$unit_number = $user["unit_number"] ?? "";

$address = $user["address"] ?? "";

$role = $user["role"] ?? "resident";

$created_at = $user["created_at"] ?? "";


// ========================================
// FORMAT ROLE
// ========================================

$display_role = ucfirst($role);


// ========================================
// MEMBER SINCE
// ========================================

if (!empty($created_at)) {

    $member_since = date(
        "M Y",
        strtotime($created_at)
    );

} else {

    $member_since = "N/A";
}


// ========================================
// UNIT / BLOCK
// ========================================

$unit_block = "";

if (!empty($building) && !empty($unit_number)) {

    $unit_block =
        htmlspecialchars($building)
        . " - "
        . htmlspecialchars($unit_number);

} elseif (!empty($building)) {

    $unit_block =
        htmlspecialchars($building);

} elseif (!empty($unit_number)) {

    $unit_block =
        htmlspecialchars($unit_number);

} else {

    $unit_block = "Not provided";
}


// ========================================
// CURRENT PAGE
// ========================================

$current_page = basename($_SERVER["PHP_SELF"]);


// ========================================
// HEADER + SIDEBAR
// ========================================

include("../includes/header.php");
include("../includes/user-sidebar.php");

?>

<link
    rel="stylesheet"
    href="/GREENNILE-CITY/assets/css/user.css"
>

<body>

<div class="main-content">

    <div class="profile-container">


        <!-- ========================================
             LEFT
        ========================================= -->

        <div class="profile-card">

            <img
                src="../assets/images/profileimg.jfif"
                alt="Profile"
            >


            <h3>
                <?= htmlspecialchars($fullname) ?>
            </h3>


            <p class="role">
                <?= htmlspecialchars($display_role) ?>
            </p>


            <span class="member">
                Member since <?= htmlspecialchars($member_since) ?>
            </span>


            <button type="button">
                Edit Profile
            </button>

        </div>


        <!-- ========================================
             MIDDLE
        ========================================= -->

        <div class="profile-form">


            <!-- FULL NAME -->

            <div class="input-group">

                <label for="fullname">
                    Full Name
                </label>

                <input
                    type="text"
                    id="fullname"
                    value="<?= htmlspecialchars($fullname) ?>"
                    readonly
                >

            </div>


            <!-- EMAIL -->

            <div class="input-group">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    id="email"
                    value="<?= htmlspecialchars($email) ?>"
                    readonly
                >

            </div>


            <!-- PHONE -->

            <div class="input-group">

                <label for="phone">
                    Phone
                </label>

                <input
                    type="text"
                    id="phone"
                    value="<?= htmlspecialchars($phone) ?>"
                    readonly
                >

            </div>


            <!-- UNIT / BLOCK -->

            <div class="input-group">

                <label for="unit">
                    Unit / Block
                </label>

                <input
                    type="text"
                    id="unit"
                    value="<?= $unit_block ?>"
                    readonly
                >

            </div>


            <!-- ADDRESS -->

            <div class="input-group">

                <label for="address">
                    Address
                </label>

                <input
                    type="text"
                    id="address"
                    value="<?= htmlspecialchars($address ?: "Not provided") ?>"
                    readonly
                >

            </div>


            <!-- USERNAME -->

            <div class="input-group">

                <label for="username">
                    Username
                </label>

                <input
                    type="text"
                    id="username"
                    value="<?= htmlspecialchars($user["username"]) ?>"
                    readonly
                >

            </div>


        </div>


        <!-- ========================================
             RIGHT SIDE
        ========================================= -->

        <div class="right-side">


            <!-- ========================================
                 STATISTICS
            ========================================= -->

            <div class="statistics-card">

                <h3>
                    Profile Statistics
                </h3>


                <div class="stat-item">

                    <span>
                        Account Status
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            ucfirst($user["status"])
                        ) ?>
                    </strong>

                </div>


                <div class="stat-item">

                    <span>
                        Role
                    </span>

                    <strong>
                        <?= htmlspecialchars($display_role) ?>
                    </strong>

                </div>


                <div class="stat-item">

                    <span>
                        Resident ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $user["resident_id"] ?? "N/A"
                        ) ?>
                    </strong>

                </div>


                <div class="stat-item">

                    <span>
                        User ID
                    </span>

                    <strong>
                        <?= htmlspecialchars(
                            $user["user_id"]
                        ) ?>
                    </strong>

                </div>

            </div>


            <!-- ========================================
                 RECENT ACTIVITY
            ========================================= -->

            <div class="activity-card">

                <h3>
                    Recent Activity
                </h3>


                <div class="activity-item">

                    <span>
                        Account Created
                    </span>

                    <small>
                        <?= !empty($created_at)
                            ? htmlspecialchars(
                                date(
                                    "d M Y",
                                    strtotime($created_at)
                                )
                            )
                            : "N/A"
                        ?>
                    </small>

                </div>


                <div class="activity-item">

                    <span>
                        Account Status
                    </span>

                    <small>
                        <?= htmlspecialchars(
                            ucfirst($user["status"])
                        ) ?>
                    </small>

                </div>


                <div class="activity-item">

                    <span>
                        Role
                    </span>

                    <small>
                        <?= htmlspecialchars($display_role) ?>
                    </small>

                </div>


                <a href="#">
                    View All Activity
                </a>

            </div>


        </div>

    </div>

</div>


<script src="/GREENNILE-CITY/assets/js/user.js"></script>

</body>

<?php include "../includes/footer.php"; ?>