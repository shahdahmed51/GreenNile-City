<?php
require_once "../includes/user-auth.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/connection.php";

if (!isset($_SESSION["user_id"]) || !isset($_SESSION["resident_id"])) {
    header("Location: login.php");
    exit();
}

$resident_id = $_SESSION["resident_id"];
$current_page = basename($_SERVER['PHP_SELF']);

$error = "";
$success = "";

// ---------- تحديث بيانات المقيم ----------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_resident"])) {

    $full_name = trim($_POST["full_name"]);
    $building = trim($_POST["building"]);
    $unit_number = trim($_POST["unit_number"]);

    $stmt = $conn->prepare("UPDATE residents SET full_name = ?, building = ?, unit_number = ? WHERE resident_id = ?");
    $stmt->bind_param("sssi", $full_name, $building, $unit_number, $resident_id);

    if ($stmt->execute()) {
        $success = "تم تحديث بيانات المقيم بنجاح.";
    } else {
        $error = "حصل خطأ أثناء تحديث البيانات: " . $stmt->error;
    }
    $stmt->close();
}

// ---------- إضافة طلب صيانة جديد ----------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {

    $title = trim($_POST["title"]);
    $category = trim($_POST["category"]);
    $priority = trim($_POST["priority"]);
    $description = trim($_POST["description"]);
    $image_path = null;

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === 0) {
        $upload_dir = "../uploads/maintenance/";

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . "_" . basename($_FILES["image"]["name"]);
        $target_file = $upload_dir . $file_name;

        $allowed_types = ["jpg", "jpeg", "png", "gif", "webp"];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = "uploads/maintenance/" . $file_name;
            } else {
                $error = "حصل خطأ أثناء رفع الصورة.";
            }
        } else {
            $error = "نوع الملف غير مسموح به. الرجاء اختيار صورة (jpg, jpeg, png, gif, webp).";
        }
    }

    if (empty($error)) {
        $sql = "INSERT INTO maintenance_requests 
                    (resident_id, title, category, priority, description, image_path, status, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, 'Pending', NOW())";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Database Error: " . $conn->error);
        }

        $stmt->bind_param("isssss", $resident_id, $title, $category, $priority, $description, $image_path);

        if ($stmt->execute()) {
            header("Location: maintenance-user.php");
            exit();
        } else {
            $error = "حصل خطأ أثناء حفظ الطلب: " . $stmt->error;
        }

        $stmt->close();
    }
}

// ---------- جلب بيانات المقيم الحالية لعرضها ----------
$stmt = $conn->prepare("SELECT full_name, building, unit_number FROM residents WHERE resident_id = ?");
$stmt->bind_param("i", $resident_id);
$stmt->execute();
$resident_result = $stmt->get_result();
$resident = $resident_result->fetch_assoc();
$stmt->close();

if (!$resident) {
    die("Resident data not found.");
}

include("../includes/header.php");
include("../includes/user-sidebar.php");
?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/add-maintenance.css">
<div class="main-content">
    <div class="page-header">
        <h2>New Maintenance Request</h2>
        <p>Submit a new maintenance request.</p>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if (!empty($success)): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <div class="maintenance-form-card">

        <!-- فورم تعديل بيانات المقيم -->
        <form action="" method="POST">
            <div class="form-section">
                <h3>Resident Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="full_name">Resident</label>
                        <input type="text" name="full_name" id="full_name" value="<?= htmlspecialchars($resident["full_name"]) ?>">
                    </div>
                    <div class="form-group">
                        <label for="building">Building</label>
                        <input type="text" name="building" id="building" value="<?= htmlspecialchars($resident["building"]) ?>">
                    </div>
                    <div class="form-group">
                        <label for="unit_number">Unit Number</label>
                        <input type="text" name="unit_number" id="unit_number" value="<?= htmlspecialchars($resident["unit_number"]) ?>">
                    </div>
                </div>
                <button type="submit" name="update_resident" class="submit-btn">
                    <i class="bi bi-save"></i> Save Resident Info
                </button>
            </div>
        </form>

        <hr>

        <!-- فورم إضافة طلب صيانة -->
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-section">
                <h3>Request Information</h3>
                <div class="form-group">
                    <label for="title">Request Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter request title" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="">Select Category</option>
                            <option value="Plumbing">Plumbing</option>
                            <option value="Electrical">Electrical</option>
                            <option value="Mechanical">Mechanical</option>
                            <option value="General">General</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" required>
                            <option value="">Select Priority</option>
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="6" placeholder="Describe the maintenance problem..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Request Image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>
            </div>
            <div class="form-actions">
                <a href="maintenance-user.php" class="cancel-btn">Cancel</a>
                <button type="submit" name="submit" class="submit-btn">
                    <i class="bi bi-check-lg"></i> Submit Request
                </button>
            </div>
        </form>

    </div>
</div>
<?php include("../includes/footer.php"); ?>