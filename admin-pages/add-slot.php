<?php 
include "../config/connection.php"; 
$error = ""; 

// ===================================== 
// ADD SLOT 
// ===================================== 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // التأكد من وجود المتغيرات لتجنب الـ Warnings
    $zone_id = isset($_POST['zone_id']) ? intval($_POST['zone_id']) : 0; 
    $slot_number = isset($_POST['slot_number']) ? trim($_POST['slot_number']) : ""; 
    $status = isset($_POST['status']) ? trim($_POST['status']) : ""; 

    // Check fields 
    if ($zone_id <= 0 || empty($slot_number) || empty($status)) { 
        $error = "Please fill in all fields."; 
    } else { 
        // 1. Check if slot number already exists using Prepared Statements
        $check_stmt = mysqli_prepare($conn, "SELECT slot_id FROM parking_slots WHERE slot_number = ?");
        if ($check_stmt) {
            mysqli_stmt_bind_param($check_stmt, "s", $slot_number);
            mysqli_stmt_execute($check_stmt);
            mysqli_stmt_store_result($check_stmt);

            if (mysqli_stmt_num_rows($check_stmt) > 0) { 
                $error = "This slot already exists."; 
                mysqli_stmt_close($check_stmt);
            } else { 
                mysqli_stmt_close($check_stmt);

                // 2. Insert slot using Prepared Statements with Foreign Key Protection
                $insert_stmt = mysqli_prepare($conn, "INSERT INTO parking_slots (zone_id, slot_number, status) VALUES (?, ?, ?)");
                if ($insert_stmt) {
                    mysqli_stmt_bind_param($insert_stmt, "iss", $zone_id, $slot_number, $status);
                    
                    try {
                        if (mysqli_stmt_execute($insert_stmt)) { 
                            mysqli_stmt_close($insert_stmt);
                            header("Location: parking.php"); 
                            exit; 
                        } else { 
                            $error = "Database error: " . mysqli_stmt_error($insert_stmt); 
                        }
                    } catch (mysqli_sql_exception $e) {
                        // رقم الخطأ 1452 في MySQL يخص قيود المفتاح الأجنبي (Foreign Key Constraint)
                        if ($e->getCode() == 1452) {
                            $error = "The selected Parking Zone does not exist. Please check your zones.";
                        } else {
                            $error = "Database error: " . $e->getMessage();
                        }
                    }
                    mysqli_stmt_close($insert_stmt);
                } else {
                    $error = "Preparation failed: " . mysqli_error($conn);
                }
            } 
        } else {
            $error = "Preparation failed: " . mysqli_error($conn);
        }
    } 
} 

// ===================================== 
// GET PARKING ZONES 
// ===================================== 
$zones = mysqli_query($conn, "SELECT zone_id, zone_name FROM parking_zones ORDER BY zone_id"); 
if (!$zones) {
    die("Query Failed: " . mysqli_error($conn));
}
?> 

<?php include '../includes/header.php'; ?> 
<?php include '../includes/navbar.php'; ?> 
<?php include '../includes/sidebar.php'; ?> 

<div class="container mt-4"> 
    <div class="card shadow-sm border-0"> 
        <!-- Header --> 
        <div class="card-header bg-success text-white"> 
            <h4 class="mb-0"> 
                <i class="fa-solid fa-square-parking me-2"></i> Add Parking Slot 
            </h4> 
        </div> 
        <div class="card-body"> 
            <!-- Error --> 
            <?php if (!empty($error)): ?> 
                <div class="alert alert-danger"> 
                    <?= htmlspecialchars($error) ?> 
                </div> 
            <?php endif; ?> 
            
            <form action="" method="POST"> 
                <div class="row"> 
                    <!-- Zone --> 
                    <div class="col-md-6 mb-3"> 
                        <label class="form-label"> Parking Zone </label> 
                        <select class="form-select" name="zone_id" required> 
                            <option value="" selected disabled> Select Zone </option> 
                            <?php while ($zone = mysqli_fetch_assoc($zones)): ?> 
                                <option value="<?= $zone['zone_id'] ?>"> 
                                    <?= htmlspecialchars($zone['zone_name']) ?> 
                                </option> 
                            <?php endwhile; ?> 
                        </select> 
                    </div> 
                    <!-- Slot Number --> 
                    <div class="col-md-6 mb-3"> 
                        <label class="form-label"> Slot Number </label> 
                        <input type="text" name="slot_number" class="form-control" placeholder="Example: A01" required> 
                    </div> 
                </div> 
                <div class="row"> 
                    <!-- Status --> 
                    <div class="col-md-6 mb-3">
                        <label class="form-label"> Status </label> 
                        <select class="form-select" name="status" required> 
                            <option value="available"> Available </option> 
                            <option value="occupied"> Occupied </option> 
                            <option value="reserved"> Reserved </option> 
                        </select> 
                    </div> 
                </div> 
                <!-- Buttons --> 
                <div class="mt-4"> 
                    <button type="submit" class="btn btn-success"> 
                        <i class="fa-solid fa-plus"></i> Add Slot 
                    </button> 
                    <a href="parking.php" class="btn btn-secondary"> Cancel </a> 
                </div> 
            </form> 
        </div> 
    </div> 
</div> 

<?php include '../includes/footer.php'; ?>

