<?php
require_once "../includes/admin-auth.php";
?>
<?php 
$current_page = basename($_SERVER['PHP_SELF']);
include("../includes/header.php"); 
include("../includes/sidebar.php"); 
require_once("../config/connection.php"); // تأكدي من مسار ملف الاتصال بالداتابيز

// افترضي أن رقم المستخدم الحالي مخزن في الجلسة
$recipient_id = $_SESSION['user_id'] ?? 1; 

// جلب الإشعارات الخاصة بالمستخدم مرتبة من الأحدث للأقدم
$query = "SELECT * FROM notifications WHERE recipient_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $recipient_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<link rel="stylesheet" href="/GREENNILE-CITY/assets/css/notification.css">

<div class="main-content">

    <div class="page-header">
        <h2>Notifications</h2>

        <div class="notification-tabs">
            <button class="active" data-filter="all">All</button>
            <button data-filter="0">Unread</button>
            <button data-filter="1">Read</button>
        </div>

        <a href="#" class="mark-read" id="markread">Mark all as read</a>
    </div>

    <div class="notifications-list">

        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php 
                    $is_read_class = ($row['is_read'] == 0) ? 'unread' : '';
                    
                    // اختيار الأيقونة المناسبة بناءً على عنوان الإشعار
                    $icon = "bi-bell-fill";
                    $title_lower = strtolower($row['title']);
                    if (strpos($title_lower, 'payment') !== false || strpos($title_lower, 'bill') !== false) {
                        $icon = "bi-credit-card-fill";
                    } elseif (strpos($title_lower, 'parking') !== false) {
                        $icon = "bi-p-circle-fill";
                    } elseif (strpos($title_lower, 'maintenance') !== false) {
                        $icon = "bi-tools";
                    } elseif (strpos($title_lower, 'resident') !== false) {
                        $icon = "bi-people-fill";
                    } elseif (strpos($title_lower, 'announcement') !== false) {
                        $icon = "bi-megaphone-fill";
                    }
                ?>

                <div class="notification-card <?php echo $is_read_class; ?>" data-status="<?php echo $row['is_read']; ?>" data-id="<?php echo $row['notification_id']; ?>">
                    <div class="icon">
                        <i class="bi <?php echo $icon; ?>"></i>
                    </div>
                    <div class="notification-content">
                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                        <p><?php echo htmlspecialchars($row['message']); ?></p>
                    </div>
                    <span class="time"><?php echo date("Y-m-d H:i", strtotime($row['created_at'])); ?></span>
                </div>

            <?php endwhile; ?>
        <?php else: ?>
            <p>No notifications found.</p>
        <?php endif; ?>

    </div> 
</div> 

<script src="/GREENNILE-CITY/assets/js/notifications.js"></script>

<?php include("../includes/footer.php"); ?>