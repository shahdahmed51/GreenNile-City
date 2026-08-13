<?php 
$current_page = basename($_SERVER['PHP_SELF']);
include '../includes/header.php'; 
include '../includes/navbar.php'; 
require_once "../includes/user-auth.php";
include '../includes/user-sidebar.php'; 
require_once '../config/connection.php'; 

$user_id = $_SESSION['user_id'] ?? 1;
$message = "";

// معالجة التحديث عند الضغط على Save Changes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $unit_number = $_POST['unit_number'] ?? '';

    // تحديث جدول users
    $stmt1 = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
    $stmt1->bind_param("ssi", $full_name, $email, $user_id);
    $stmt1->execute();

    // تحديث جدول residents المرتبط
    $stmt2 = $conn->prepare("UPDATE residents SET full_name = ?, email = ?, phone = ?, address = ?, unit_number = ? WHERE resident_id = (SELECT resident_id FROM users WHERE user_id = ?)");
    $stmt2->bind_param("sssssi", $full_name, $email, $phone, $address, $unit_number, $user_id);
    $stmt2->execute();

    $message = "Settings updated successfully!";
}

// جلب البيانات الحالية للمستخدم
$query = "SELECT u.username, u.email, r.full_name, r.phone, r.address, r.unit_number 
          FROM users u 
          LEFT JOIN residents r ON u.resident_id = r.resident_id 
          WHERE u.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$userData = $stmt->get_result()->fetch_assoc();
?>

<div class="container mt-4">

    <h2 class="page-title">Settings</h2>

    <div class="settings-tabs">
        <a href="settings.php" class="settings-tab active">General</a>
        <a href="../user-pages/user-security.php" class="settings-tab">Security</a>
        <a href="../user-pages/user-notification-settings.php" class="settings-tab">Notifications</a>
        <a href="../user-pages/user-appearance.php" class="settings-tab">Appearance</a>
    </div>

    <div class="settings-card">

        <div class="left-side">
            <div class="settings-icon">
                <i class="fa-solid fa-gear"></i>
            </div>
            <h3>General Settings</h3>
            <p>Manage your system account settings.</p>
        </div>

        <div class="right-side">

            <?php if (!empty($message)): ?>
                <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="">

                <label>Full Name</label>
                <input type="text" name="full_name" value="<?php echo htmlspecialchars($userData['full_name'] ?? $userData['username'] ?? ''); ?>">

                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email'] ?? ''); ?>">

                <label>Phone Number</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($userData['phone'] ?? ''); ?>">

                <label>Address</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($userData['address'] ?? ''); ?>">

                <label>Apartment / Unit</label>
                <select name="unit_number">
                    <option value="">Select Apartment</option>
                    <?php 
                    $units = ['A-101', 'A-102', 'B-201', 'B-202'];
                    foreach ($units as $unit) {
                        $selected = ($userData['unit_number'] ?? '') === $unit ? 'selected' : '';
                        echo "<option value='$unit' $selected>$unit</option>";
                    }
                    ?>
                </select>

                <div class="double-input">
                    <div>
                        <label>Language</label>
                        <select name="language">
                            <option value="English">English</option>
                            <option value="Arabic">Arabic</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="save-btn">Save Changes</button>

            </form>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>